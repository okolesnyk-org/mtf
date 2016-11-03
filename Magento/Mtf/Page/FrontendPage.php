<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Mtf\Page;

/**
 * Application frontend page.
 *
 * @api
 */
class FrontendPage extends Page
{
    /**
     * Get page url.
     *
     * @return void
     */
    protected function getUrl()
    {
        $this->url = $_ENV['app_frontend_url'] . static::MCA;
    }
}
