<?php
namespace pastuhov\logstock;

class DynamicDataFilter implements LogFilterInterface
{
    /**
     * @var string[]
     */
    public $dynamicFields = [];

    public function filter($log)
    {
        $fields = implode('|', $this->dynamicFields);
        $log = preg_replace(
            "/($fields) ([^\\s]+) ([^\\s]+|'[^']+')/",
            '$1 $2 :DYNAMIC',
            $log
        );

        return $log;
    }
}
