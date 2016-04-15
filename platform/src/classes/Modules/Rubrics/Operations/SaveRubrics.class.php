<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.02.15
 * Time: 17:17
 */
class SaveRubrics extends RubricsOperation implements IModuleOperation
{
    protected $currentRubricPath;

    /**
     * @return mixed
     */
    public function getCurrentRubricPath()
    {
        return $this->currentRubricPath;
    }

    /**
     * @param mixed $currentRubricPath
     */
    public function setCurrentRubricPath($currentRubricPath)
    {
        $this->currentRubricPath = $currentRubricPath;
    }

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleRubricsSaveOperationRequest
     */
    protected function getRequest()
    {
        return $this->getModuleObject()->getRequest();
    }

    /**
     * Выполнение операции
     * @throws OperationSaveRubricException
     */
    public function operation()
    {
        $currentRubric = PlatformCommonRubric::dao()
            ->getById($this->getRequest()->getRubricId());

        $this->setCurrentRubricPath($currentRubric->getPath());

        $descendantsRubric =
            PlatformCommonRubric::dao()
                ->getDescendantsByPathAndProjectId(
                    $currentRubric->getPath(),
                    $this->getRequest()->getProjectId()
                );

        $parentRubric = PlatformCommonRubric::dao()
            ->getByShortNameAndProject(
                $this->getRequest()->getParent(),
                PlatformCommonProject::dao()->getById($this->getRequest()->getProjectId())
            )->getPath();

        foreach ($descendantsRubric as $rubric) {
            /** @var PlatformCommonRubric $rubric */
            if ($parentRubric == $rubric->getPath())
                throw new OperationSaveRubricException('This rubric is subrubric current title');

        };

        foreach ($descendantsRubric as $rubric) {
            /** @var PlatformCommonRubric $rubric */
            $this->renamePath($rubric);
        }

        PlatformCommonRubric::dao()->save(
            $currentRubric
                ->setModifiedAt($this->getRequest()->getModifiedAt())
                ->setName($this->getRequest()->getName())
        );

        PlatformCommonRubricData::dao()
            ->save(
                $currentRubric
                    ->getRubricData()
                    ->setShortName($this->getRequest()->getShortName())
                    ->setDescription($this->getRequest()->getDescription())
                    ->setMetaDescription($this->getRequest()->getMetaDescription())
                    ->setMetaKeywords($this->getRequest()->getMetaKeywords())
            );

        $this->getModuleObject()->setResponse(
            ModuleRubricsSaveOperationResponse::create()->setRubricId($currentRubric->getId())
        );
    }

    protected function renamePath(PlatformCommonRubric $rubric)
    {
        PlatformCommonRubric::dao()
            ->save(
                $rubric->setPath(
                    str_replace(
                        $this->getCurrentRubricPath(),
                        $this->getRequest()->getPath(),
                        $rubric->getPath()
                    )
                )
            );
    }
}