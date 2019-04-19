<?php


namespace Long\Staff\Model\Config;


use Magento\Framework\Option\ArrayInterface;

class Status implements ArrayInterface
{
    const ENABLED = 1;
    const DISABLED = 0;
    public function toOptionArray()
    {
        return [
            self::ENABLED => __("Enabled"),
            self::DISABLED => __("Disabled"),
        ];
    }
}