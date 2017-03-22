<?php
/**
 * Copyright © 2017 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Mtf\Report\Converter\Csv;

/**
 * Converter of any array data to an csv representation with no data loss
 */
class Basic
{
    /**
     * CSV file delimiter.
     *
     * @var string
     */
    private $delimiter;

    /**
     * Configuration for converter.
     *
     * @var array
     */
    private $config;

    /**
     * @param array $config
     * @param string $delimiter
     */
    public function __construct(array $config, $delimiter = ',')
    {
        $this->config = $config;
        $this->delimiter = $delimiter;
    }

    /**
     * Performs conversion to array applicable for CSV file saving.
     *
     * @param array $data
     * @return array
     */
    public function convert(array $data)
    {
        $result = [];
        $header = [];

        $fields = $this->prepareFieldsConfig();
        foreach ($fields as $field) {
            $header[] = $field['field_name'];
        }
        $result[] = $header;

        foreach ($data as $key => $value) {
            $zephyrsQty = count($value['zephyr_data']);
            for ($i = $zephyrsQty - 1; $i >= 0; $i--) {
                $row = [];
                foreach ($fields as $field) {
                    $fieldKey = str_replace('*', $i, $field['field_key']);
                    $data = $this->retrieveVariationData($value, $fieldKey);
                    $row[] = is_array($data) ? implode('; ', $data) : $data;
                }
                $result[] = $row;
            }
        }

        return $result;
    }

    /**
     * Save data to specified path.
     *
     * @param array $data
     * @param string $path
     * @return void
     */
    public function saveTo(array $data, $path = 'var/log')
    {
        $convertedData = $this->convert($data);
        if (!file_exists($path)){
            touch($path);
        }
        $file = fopen(realpath($path), 'w');
        foreach ($convertedData as $row) {
            fputcsv($file, $row, $this->delimiter);
        }
        fclose($file);
    }

    /**
     * Retrieve variation data by key.
     *
     * @param array $variation
     * @param null $path
     * @return array|mixed|null
     */
    private function retrieveVariationData(array $variation, $path = null) {
        if ($path === null) {
            return null;
        }
        $keys = explode('/', $path);
        $data = $variation;
        foreach ($keys as $key) {
            if (is_array($data) && array_key_exists($key, $data)) {
                $data = $data[$key];
            } else {
                $data = null;
            }
        }

        return $data;
    }

    /**
     * Prepare fields configuration.
     *
     * @return array
     */
    private function prepareFieldsConfig()
    {
        $result = [];
        $fields = $this->config['fields'];

        foreach ($fields as $field) {
            $result[$field['sort_order']] = $field;
        }
        ksort($result);

        return $result;
    }
}
