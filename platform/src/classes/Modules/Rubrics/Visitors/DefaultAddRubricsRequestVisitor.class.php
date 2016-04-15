<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 31.12.14
 * Time: 12:57
 */
class DefaultAddRubricsRequestVisitor extends RubricsVisitor implements IModuleVisitor
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleRubricsAddOperationRequest
     */
    private function getRequest()
    {
        return $this->getModuleObject()->getRequest();
    }

    /**
     * Выполнение визитера
     *
     * @return mixed
     */
    public function visit()
    {
        if (is_null($this->getRequest()->getParent()))
            $this->setDefaultProjectPath();
        else
            $this->setPath();
    }

    private function setDefaultProjectPath()
    {
        $this->getRequest()->setPath(
            ucfirst(
                PlatformCommonProject::dao()
                    ->getById($this->getRequest()->getProjectId())
                    ->getName()
            ) .
            '.' .
            ucfirst($this->getRequest()->getName())
        );
    }

    private function setPath()
    {
        $this->getRequest()->setPath(
            PlatformCommonRubric::dao()
                ->getByShortNameAndProject(
                    $this->getRequest()->getParent(),
                    PlatformCommonProject::dao()->getById($this->getRequest()->getProjectId())
                )
                ->getPath() .
            '.' . ucfirst($this->getRequest()->getName())
        );
    }
}