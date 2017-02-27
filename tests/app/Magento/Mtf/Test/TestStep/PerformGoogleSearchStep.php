<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Mtf\Test\TestStep;

use Magento\Mtf\Client\BrowserInterface;
use Magento\Mtf\TestStep\TestStepInterface;

/**
 * Perform search.
 */
class PerformGoogleSearchStep implements TestStepInterface
{
    /**
     * @var BrowserInterface
     */
    private $browser;

    /**
     * @var
     */
    private $search;

    /**
     * @param BrowserInterface $browser
     * @param $search
     */
    public function __construct(BrowserInterface $browser, $search)
    {
        $this->browser = $browser;
        $this->search = $search;
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->browser->find('input.gsfi')->setValue($this->search);
    }
}
