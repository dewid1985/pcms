<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.01.15
 * Time: 15:23
 */
class MultimediaOperation extends Module
{
        function __construct()
        {
            $this->setModule(ModulesEnum::multimedia());
        }

        function getResponse()
        {
            return
                $this->getModuleObject()->getResponse();
        }
}
