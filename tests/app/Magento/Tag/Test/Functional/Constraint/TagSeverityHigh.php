<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Tag\Test\Functional\Constraint;

use Magento\Mtf\Fixture\FixtureFactory;
use Magento\Mtf\Test\Functional\Fixture\Test;
use Magento\Mtf\Constraint\AbstractConstraint;
use Magento\BlockRender\Test\Functional\Page\Area\TestPage;

/**
 * Test filtering constraint by tags.
 */
class TagSeverityHigh extends AbstractConstraint
{
    /* tags */
    const SEVERITY = 'high';
    /* end tags */

    /**
     * Test filtering constraint by tags.
     *
     * @param TestPage $page
     * @param Test $fixture
     * @param FixtureFactory $fixtureFactory
     * @return void
     */
    public function processAssert(TestPage $page, Test $fixture, FixtureFactory $fixtureFactory)
    {
        $data = $fixture->getData();

        $data['search'] .= sprintf(' constraint:severity:%s', self::SEVERITY);
        $reinitedFixture = $fixtureFactory->create('Magento\Mtf\Test\Functional\Fixture\Test', ['data' => $data]);

        $page->open();
        $page->getTestBlock()->fill($reinitedFixture);
        sleep(3);
    }

    /**
     * Text run constraint.
     *
     * @return string
     */
    public function toString()
    {
        return 'Run constraint with high severity.';
    }
}
