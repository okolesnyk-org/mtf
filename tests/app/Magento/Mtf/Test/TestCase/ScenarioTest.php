<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Mtf\Test\TestCase;

use Magento\Mtf\TestCase\Scenario;

/**
 *
 */
class ScenarioTest extends Scenario
{
    /**
     * @return void
     */
    public function test()
    {
        $this->executeScenario();
    }
}
