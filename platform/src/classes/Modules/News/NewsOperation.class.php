<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.01.15
 * Time: 15:23
 */
class NewsOperation extends Module
{
        function __construct()
        {
            $this->setModule(ModulesEnum::news());
        }

        function getResponse()
        {
            return
                $this->getModuleObject()->getResponse();
        }
}
