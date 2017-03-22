<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Mtf\Report\Statistic;

/**
 * Report component interface.
 */
interface ComponentInterface
{
    /**
     * Returns data retrieved for dedicated variation.
     *
     * @param array $variationData
     * @return array
     */
    public function getData(array $variationData);
}
