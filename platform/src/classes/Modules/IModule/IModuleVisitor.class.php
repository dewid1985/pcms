<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 10:45
 */

interface IModuleVisitor
{
    /**
     * Выполнение визитера
     *
     * @return mixed
     */
    public function visit();
}