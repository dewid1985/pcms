<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.02.15
 * Time: 17:59
 */
class DefaultSaveRubricsRequestVisitor extends RubricsVisitor implements IModuleVisitor
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleRubricsSaveOperationRequest
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
            '.'.ucfirst($this->getRequest()->getName())
        );
        $this->getRequest()->setParent(
            PlatformCommonRubric::dao()
                ->getByName(
                    ucfirst(
                        PlatformCommonProject::dao()
                            ->getById($this->getRequest()->getProjectId())
                            ->getName()
                    )
                )
                ->getRubricData()
                ->getShortName()
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