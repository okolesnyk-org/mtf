<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Mtf\Test\Functional\TestCase;

use Magento\Mtf\TestCase\Functional;

/**
 * Default PHPUnit test case.
 */
class RegularTest extends Functional
{
    /**
     * @depends Magento\Mtf\Test\Functional\TestCase\InjectableTestCase::test1
     * @return void
     */
    public function test1()
    {
        /** @var $fixture \Magento\Mtf\Test\Functional\Fixture\Test */
        $fixture = $this->objectManager->create('Magento\Mtf\Test\Functional\Fixture\Test');

        /** @var $page \Magento\BlockRender\Test\Functional\Page\Area\TestPage */
        $page = $this->objectManager->create('Magento\BlockRender\Test\Functional\Page\Area\TestPage');

        $page->open();
        $page->getTestBlock()->click($fixture);
        sleep(1);
    }

    /**
     * @dataProvider dataProvider
     * @param string $fromDataProvider
     * @return void
     */
    public function test2($fromDataProvider)
    {
        var_dump($fromDataProvider . " works well!");
        /** @var $fixture \Magento\Mtf\Test\Functional\Fixture\Test */
        $fixture = $this->objectManager->create('Magento\Mtf\Test\Functional\Fixture\Test');

        /** @var $page \Magento\BlockRender\Test\Functional\Page\Area\TestPage */
        $page = $this->objectManager->create('Magento\BlockRender\Test\Functional\Page\Area\TestPage');

        $page->open();
        $page->getTestBlock()->click($fixture);
        sleep(1);
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            'Variation #1' => ['Data Provider (1) for Regular Test Case'],
            'Variation #2' => ['Data Provider (2) for Regular Test Case']
        ];
    }
}
