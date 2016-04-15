<?php

/**
 * Диспечер модулей
 *
 * Created by PhpStorm.
 * User: root
 * Date: 29.12.14
 * Time: 17:20
 */
class DispatcherModule extends PlatformBase
{
    protected $visitor = array();

    /** @var DB|DBPool null */
    protected $link = null;

    /**
     * @return DB|DBPool
     */
    public function getLink()
    {
        if (is_null($this->link)) {
            $this->link = DBPool::me()->getLink();
        }
        return $this->link;
    }


    /**
     * @var BaseModule
     */
    protected $moduleObject = NULL;

    /**
     * @var ModulesEnum $moduleEnum
     */
    protected $moduleEnum = NULL;

    /**
     * @param ModulesEnum $moduleEnum
     */
    public function setModuleEnum(ModulesEnum $moduleEnum)
    {
        $this->moduleEnum = $moduleEnum;
    }

    /**
     * @param \BaseModule $moduleObject
     */
    public function setModuleObject($moduleObject)
    {
        $this->moduleObject = $moduleObject;
    }

    /**
     * @return ModulesEnum
     */
    public function getModuleEnum()
    {
        return $this->moduleEnum;
    }

    /**
     * @return \BaseModule
     */
    public function getModuleObject()
    {
        return $this->moduleObject;
    }

    /**
     * @param array $visitor
     */
    public function setVisitor($visitor)
    {
        $this->visitor = $visitor;
    }

    /**
     * @return array
     */
    public function getVisitor()
    {
        return $this->visitor;
    }


    /**
     * Инициализирую модуль
     *
     * @param Enum $operation
     * @throws PlatformModuleException
     */
    public function init(Enum $operation)
    {
        $this->getLink()->begin();
        $operation = ucfirst(
                $operation->getName()
            ) .
            ModulesEnum::create($this->getModuleEnum()->getId())->getName();

        try {
            $operationObject = new $operation;
        } catch (Exception $e) {
            throw new PlatformModuleException ("No operation \n file :" . $e->getFile() .
                "\n line :" . $e->getLine() . "\n " . $e->getMessage());
        }

        if (is_null($this->getModuleObject()->getRequest())) {
            throw new PlatformModuleException('No Request Module ');
        }
        if (!($operationObject instanceof IModuleOperation)) {
            throw new PlatformModuleException('No operation');
        }

        $this->wrapVisitors($operation, ModuleTypeVisitorEnum::getTypeRequest());
        $this->driveVisitors();

        try {
            $operationObject->operation();
        } catch (Exception $e) {
            $this->getLink()->rollback();
            throw new PlatformModuleException('Operation error');
        }

        $this->wrapVisitors($operation, ModuleTypeVisitorEnum::getTypeResponse());
        $this->driveVisitors();
        $this->getLink()->commit();
    }

    /**
     * Собираю визитеры
     *
     * @param $operation
     * @param ModuleTypeVisitorEnum $typeVisitor
     * @throws PlatformModuleException
     */
    public function wrapVisitors($operation, ModuleTypeVisitorEnum $typeVisitor)
    {
        $this->setVisitor(array());

        try {
            $configModule = PlatformConfig::create()
                ->setConfigPath(PATH_PLATFORM_MODULE . $this->getModuleEnum()->getName() . DIRECTORY_SEPARATOR)
                ->setConfig('Settings');

        } catch (Exception $e) {
            throw new PlatformModuleException('No config setting file');
        }

        try {
            $defaultVisitors =
                $configModule
                    ->getItemConfig('visitors')
                    ->getItem($operation)
                    ->getItem($typeVisitor->getName())
                    ->get();

        } catch (Exception $e) {
            $defaultVisitors = array();
        }

        try {
            $projectVisitors =
                ProjectConfig::create()
                    ->setConfig('project')
                    ->getItemConfig('visitors')
                    ->getItem($operation)
                    ->getItem('Request')
                    ->get();

        } catch (Exception $e) {
            $projectVisitors = array();
        }

        $this->setVisitor(
            array_unique(
                array_merge(
                    $defaultVisitors,
                    $projectVisitors
                )
            )
        );
    }

    /**
     * Запускаю визитеры
     *
     * @throws PlatformModuleException
     */
    public function driveVisitors()
    {
        foreach ($this->getVisitor() as $visitor) {
          //  try {
                $visitor::{'create'}()->visit();
           // } catch (Exception $e) {
             //   $this->getLink()->rollback();
              //  throw new PlatformModuleException ('No visitor as name class: ' . $visitor);
            //}
        }
    }
}


