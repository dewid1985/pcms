<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 11:32
 */
class AddRubrics extends RubricsOperation implements IModuleOperation
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
     * Выполнение операции
     *
     * @return mixed
     */
    public function operation()
    {
        PlatformCommonRubric::dao()
            ->add(
                PlatformCommonRubric::create()
                    ->setProjectId($this->getRequest()->getProjectId())
                    ->setRubricDataId(
                        PlatformCommonRubricData::dao()
                            ->add(
                                PlatformCommonRubricData::create()
                                    ->setShortName($this->getRequest()->getShortName())
                                    ->setDescription($this->getRequest()->getDescription())
                                    ->setMetaDescription($this->getRequest()->getMetaDescription())
                                    ->setMetaKeywords($this->getRequest()->getMetaKeywords())
                            )
                            ->getId()
                    )
                    ->setName($this->getRequest()->getName())
                    ->setPath($this->getRequest()->getPath())
                    ->setEnabled($this->getRequest()->getEnabled())
                    ->setCreatedAt($this->getRequest()->getCreatedAt())
            );
    }
}