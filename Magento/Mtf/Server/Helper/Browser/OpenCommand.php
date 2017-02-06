<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Mtf\Server\Helper\Browser;

/**
 * Command opens browser with specified URL.
 */
class OpenCommand
{
    /**
     * Open browser window from console.
     *
     * @param string $url
     * @param null|string $browserName
     * @return string
     */
    public function execute($url, $browserName = null) {
        switch (PHP_OS) {
            case 'Darwin':
                $opener = $browserName ? 'open -a "' . trim($browserName) . '"' : 'open';
                break;
            case 'WINNT':
                $opener = $browserName ? 'start "" "' . trim($browserName) . '"' : 'start ""';
                break;
            default:
                $opener = $browserName ? 'xdg-open  "' . trim($browserName) . '"' : 'open';
                break;
        }
        return exec($opener . ' "' . trim($url) . '"');
    }
}
