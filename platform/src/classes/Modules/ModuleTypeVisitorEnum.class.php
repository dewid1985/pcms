<?php
/**
 * Типы визитеров
 *
 * Created by PhpStorm.
 * User: root
 * Date: 31.12.14
 * Time: 12:13
 */
class ModuleTypeVisitorEnum extends Enum
{
    const
        REQUEST = 1,
        RESPONSE = 2
    ;

    protected static  $names = array(
        self::RESPONSE => 'Response',
        self::REQUEST => 'Request'
    );

    /**
     * Получить тип Request
     *
     * @return ModuleTypeVisitorEnum
     */
    public static  function getTypeRequest()
    {
       return new self(self::REQUEST);
    }

    /**
     * Получить тип Response
     *
     * @return ModuleTypeVisitorEnum
     */
    public static function getTypeResponse()
    {
        return new self(self::RESPONSE);
    }

}