<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 13:05
 */
abstract class ModuleOperationEnum extends BaseOperationEnum implements IModuleOperationEnum
{
    protected static $operation = array(/* override me */);

    /**
     * Собираю операции и базовый $names действий
     *
     * @param $id
     */
    public function __construct($id)
    {
        parent::$names = static::$names + static::$operation;
        parent::__construct($id);
    }
}