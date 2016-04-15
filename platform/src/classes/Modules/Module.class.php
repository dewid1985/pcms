<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.01.15
 * Time: 12:17
 */

class Module extends DispatcherModule
{
    public function setModule(ModulesEnum $module)
    {
        $this->setModuleEnum($module);
        $module = ModulesEnum::create($this->getModuleEnum()->getId())->getName();
        $this->setModuleObject($module::me());
        return $this;
    }
}