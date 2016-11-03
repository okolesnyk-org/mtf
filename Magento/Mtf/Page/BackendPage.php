<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Mtf\Page;

/**
 * Application backend page.
 *
 * @api
 */
class BackendPage extends Page
{
    /**
     * Get page url.
     *
     * @return void
     */
    protected function getUrl()
    {
        $this->url = $_ENV['app_backend_url'] . static::MCA;
    }
}
