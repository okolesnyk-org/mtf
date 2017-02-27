<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Mtf\Config\FileResolver;

use Magento\Mtf\Config\FileResolverInterface;
use Magento\Mtf\Util\ModuleResolver;
use Magento\Mtf\Util\Iterator\File;

/**
 * Class Mask
 * @package Magento\Mtf\Config\FileResolver
 */
class Mask implements FileResolverInterface
{
    /**
     * @var ModuleResolver
     */
    protected $moduleResolver;

    /**
     * Constructor
     *
     * @param ModuleResolver|null $moduleResolver
     */
    public function __construct(ModuleResolver $moduleResolver = null)
    {
        if ($moduleResolver) {
            $this->moduleResolver = $moduleResolver;
        } else {
            $this->moduleResolver = ModuleResolver::getInstance();
        }
    }

    /**
     * Retrieve the list of configuration files with given name that relate to specified scope
     *
     * @param string $filename
     * @param string $scope
     * @return array|\Iterator,\Countable
     */
    public function get($filename, $scope)
    {
        $paths = $this->getFileCollection($filename, $scope);

        return new File($paths);
    }

    /**
     * Get scope of paths.
     *
     * @param string $filename
     * @param string $scope
     * @return array
     */
    protected function getFileCollection($filename, $scope)
    {
        $paths = [];
        $modulesPath = $this->moduleResolver->getModulesPath();

        foreach ($modulesPath as $modulePath) {
            $path = $modulePath . '/Test/Functional/' . $scope . '/';
            if (is_readable($path)) {
                $directoryIterator = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator(
                        $path,
                        \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::FOLLOW_SYMLINKS
                    )
                );
                $regexpIterator = new \RegexIterator($directoryIterator, $filename);
                /** @var \SplFileInfo $file */
                foreach ($regexpIterator as $file) {
                    if ($file->isFile() && $file->isReadable()) {
                        $paths[] = $file->getRealPath();
                    }
                }
            }
        }

        return $this->moduleResolver->sortFilesByModuleSequence($paths);
    }
}
