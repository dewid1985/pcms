<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.12.14
 * Time: 14:12
 */

class PlatformDialectString implements DialectString
{

    /**
     * @var null
     */
    protected $sqlDialect = NULL;

    /**
     * @param $sqlDialect
     */
    function __construct($sqlDialect)
    {
        $this->sqlDialect = $sqlDialect;
    }

    /**
     * @param Dialect $dialect
     * @return null
     */
    public function toDialectString(Dialect $dialect)
    {
        return $this->sqlDialect;
    }


    public static function create($string)
    {
        return new self($string);
    }
}