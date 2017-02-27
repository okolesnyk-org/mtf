<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Mtf\Test\TestStep;

use Magento\Mtf\Client\BrowserInterface;
use Magento\Mtf\TestStep\TestStepInterface;

/**
 * Open google.com
 */
class OpenGooglePageStep implements TestStepInterface
{
    /**
     * @var BrowserInterface
     */
    private $browser;

    /**
     * @param BrowserInterface $browser
     */
    public function __construct(BrowserInterface $browser)
    {
        $this->browser = $browser;
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->browser->open('https://google.com/');
    }
}
