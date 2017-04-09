<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Mtf\Report\Statistic\Component;

use Magento\Mtf\Report\Statistic\ComponentInterface;

/**
 * Variation data resolver.
 */
class VariationData implements ComponentInterface
{
    /**
     * Returns required data from variation.
     *
     * @param array $variationData
     * @return array
     */
    public function getData(array $variationData)
    {
        $arguments = $variationData['arguments'];
        $data['variation_name'] = isset($arguments['variation_name']) ? $arguments['variation_name'] : '';
        $data['summary'] = isset($arguments['summary']) ? $arguments['summary'] : '';
        $data['test_case_class'] = $variationData['test_case_class'];
        $class = explode('\\', $variationData['test_case_class']);
        $data['module'] = $class[0] . '_' . $class[1];
        $data['test_case_tags'] = $variationData['test_case_tags'];
        $data['tags'] = [];
        if (isset($arguments['tag'])) {
            $tags = explode(',', $arguments['tag']);
            foreach ($tags as $tag) {
                list($tagName, $tagValue) = explode(':', trim($tag));
                if (isset($data['tags'][$tagName])) {
                    $data['tags'][$tagName] = [$data['tags'][$tagName]];
                    $data['tags'][$tagName] = array_merge($data['tags'][$tagName], [$tagValue]);
                } else {
                    $data['tags'][$tagName] = $tagValue;
                }
            }
        }
        $data['issue'] = isset($arguments['issue']) ? $arguments['issue'] : '';

        return $data;
    }
}
