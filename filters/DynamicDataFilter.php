<?php
namespace pastuhov\logstock\filters;

use pastuhov\logstock\LogFilterInterface;

class DynamicDataFilter implements LogFilterInterface
{
    /**
     * @var string[]
     */
    public $dynamicFields = [
        'expired_at',
        'created_at',
        'updated_at',
        'session_id'
    ];

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
