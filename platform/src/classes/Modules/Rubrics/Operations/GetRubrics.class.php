<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 18:29
 */
class GetRubrics extends RubricsOperation implements IModuleOperation
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleRubricsGetOperationRequest
     */
    protected function getRequest()
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
        $rubric = PlatformCommonRubric::dao()->getById($this->getRequest()->getRubricId());


        $this->getModuleObject()->setResponse(
            ModuleRubricsGetOperationResponse::create()
                ->setParentRubricName(
                    $this->getParenRubricNameByPath(
                        substr($rubric->getPath(), 0, strrpos($rubric->getPath(), '.'))
                    )
                )
                ->setRubricId($rubric->getId())
                ->setShortName($rubric->getRubricData()->getShortName())
                ->setDescription($rubric->getRubricData()->getDescription())
                ->setMetaDescription($rubric->getRubricData()->getMetaDescription())
                ->setMetaKeywords($rubric->getRubricData()->getMetaKeywords())
        );
    }

    protected function getParenRubricNameByPath($path)
    {
        if (!empty($path))

            return PlatformCommonRubric::dao()->getByPath($path)->getName();
        else
            return NULL;
    }
}