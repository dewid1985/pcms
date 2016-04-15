<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.01.15
 * Time: 15:45
 */
class NewsVisitor extends Module
{
    function __construct()
    {
        $this->setModule(ModulesEnum::article());
    }
}