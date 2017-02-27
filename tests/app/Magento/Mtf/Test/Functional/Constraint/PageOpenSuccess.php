<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Mtf\Test\Functional\Constraint;

use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\BlockRender\Test\Functional\Page\Area\TestPage;
use Magento\Mtf\Test\Functional\Fixture\Test;

/**
 * Fake assertion, just to test constraint functionality.
 */
class PageOpenSuccess extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'low';
    /* end tags */

    /**
     * Assert that page has been opened
     *
     * @param TestPage $page
     * @param Test $fixture
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function processAssert(TestPage $page, Test $fixture)
    {
        //
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        //
    }
}
