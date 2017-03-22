<?php
/**
 * Copyright © 2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Mtf\Report\Statistic;

use Magento\Mtf\ObjectManagerInterface;
use Magento\Mtf\Util\Iterator\TestCase;

class Manager
{
    /**
     * List of components for report preparation.
     *
     * @var \Magento\Mtf\Report\Statistic\ComponentInterface[]
     */
    private $componentList;

    /**
     * Test data storage.
     *
     * @var array
     */
    private $data = [];

    /**
     * Test case iterator.
     *
     * @var TestCase
     */
    private $testCaseIterator;

    /**
     * Object manager.
     *
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @param array $componentList
     * @param TestCase $testCaseIterator
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        array $componentList,
        TestCase $testCaseIterator,
        ObjectManagerInterface $objectManager
    ) {
        $this->componentList = $componentList;
        $this->testCaseIterator = $testCaseIterator;
        $this->objectManager = $objectManager;
    }

    /**
     * Entry point for report manager.
     *
     * @return void
     */
    public function run()
    {
        for (; $this->testCaseIterator->valid(); $this->testCaseIterator->next()) {
            $arguments = $this->testCaseIterator->current();
            $test = $this->objectManager->create($arguments['class']);
            $testVariationIterator = $this->objectManager->create(
                \Magento\Mtf\Util\Iterator\TestCaseVariation::class,
                ['testCase' => $test]
            );
            for (; $testVariationIterator->valid(); $testVariationIterator->next()) {
                $variationId = $testVariationIterator->current()['arguments']['variation_name'];
                foreach ($this->componentList as $component) {
                    $variationData = $testVariationIterator->current();
                    $variationData['test_case_class'] = $arguments['class'];
                    $variationData['test_case_tags'] = (new \ReflectionClass($arguments['class']))->getConstants();
                    $data = $component->getData($variationData);
                    $this->addEntry($variationId, $data);
                }
            }
        }
        $this->retrieveTestSuites();
        unset($this->data["Default"]);
    }

    /**
     * Retrieve test suite for particular variation.
     *
     * @return void
     */
    private function retrieveTestSuites()
    {
        $testSuitesDir = 'testsuites/Magento/Mtf/TestSuite/InjectableTests';
        /** @var \Magento\Mtf\Config\FileResolver\Primary $fileResolver */
        $fileResolver = $this->objectManager->create(
            \Magento\Mtf\Config\FileResolver\Primary::class
        );
        /** @var \Magento\Mtf\Util\Iterator\File $testSuites */
        $testSuites = $fileResolver->get('*', $testSuitesDir);
        for (; $testSuites->valid(); $testSuites->next()) {
            $explodedFilePath = explode(DIRECTORY_SEPARATOR, $testSuites->key());
            $testSuiteFileName = end($explodedFilePath);
            $objectManagerFactory = new \Magento\Mtf\ObjectManagerFactory();
            $objectManager = $objectManagerFactory->getObjectManager();
            /** @var \Magento\Mtf\Config\DataInterface $configData */
            $configData = $objectManager->create('Magento\Mtf\Config\TestRunner');
            $configData->setFileName($testSuiteFileName);
            $configData->load('testsuites/Magento/Mtf/TestSuite/InjectableTests');
            $objectManager = $objectManagerFactory->create(
                ['Magento\Mtf\Config\TestRunner' => $configData]
            );
            /** @var $testIterator \Magento\Mtf\Util\Iterator\TestCase */
            $testIterator = $objectManager->create('Magento\Mtf\Util\Iterator\TestCase');
            for (; $testIterator->valid(); $testIterator->next()) {
                $arguments = $testIterator->current();
                $test = $objectManager->create($arguments['class']);
                /** @var $testVariationIterator \Magento\Mtf\Util\Iterator\TestCaseVariation */
                $testVariationIterator = $objectManager->create(
                    'Magento\Mtf\Util\Iterator\TestCaseVariation',
                    ['testCase' => $test]
                );
                for (; $testVariationIterator->valid(); $testVariationIterator->next()) {
                    $variationId = $testVariationIterator->current()['arguments']['variation_name'];
                    $testSuiteName = str_replace('.xml', '', $testSuiteFileName);
                    if (empty($this->data[$variationId]['test_suites'])) {
                        $this->data[$variationId]['test_suites'] = [];
                    }
                    if (!in_array($testSuiteName, $this->data[$variationId]['test_suites'])) {
                        $this->data[$variationId]['test_suites'][] = $testSuiteName;
                    }
                }
            }
        }
    }

    /**
     * Add fetched data to test storage.
     *
     * @param $variationId
     * @param $data
     */
    private function addEntry($variationId, $data)
    {
        if (isset($this->data[$variationId])) {
            $this->data[$variationId] = array_merge($this->data[$variationId], $data);
        } else {
            $this->data[$variationId] = $data;
        }
    }

    /**
     * Returns retrieved data.
     *
     * @return array
     */
    public function getData() {
        if (empty($this->data)) {
            $this->run();
        }

        return $this->data;
    }
}
