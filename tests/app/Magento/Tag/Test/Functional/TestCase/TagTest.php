<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Tag\Test\Functional\TestCase;

use Magento\Mtf\TestCase\Injectable;
use Magento\Mtf\Test\Functional\Fixture\Test;
use Magento\BlockRender\Test\Functional\Page\Area\TestPage;

/**
 * Test for check tagging functional.
 */
class TagTest extends Injectable
{
    /* tags */
    const SEVERITY = 'middle';
    /* end tags */

    /**
     * Run test.
     *
     * @param TestPage $page
     * @param Test $fixture
     * @return void
     */
    public function test(TestPage $page, Test $fixture)
    {
        $page->open();
        $page->getTestBlock()->search($fixture);
        sleep(2);
    }
}
