<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.02.15
 * Time: 14:05
 */
class SearchRubrics extends RubricsOperation implements IModuleOperation
{

    /**
     * __construct
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleRubricsSearchOperationRequest
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
        $data = $this->prepareData(
            PlatformCommonRubric::getBySearchOperationRequest($this->getRequest())
        );

        $this->getModuleObject()->setResponse(
            ModuleRubricsSearchOperationsResponse::create()
                ->setDraw($this->getRequest()->getDraw())
                ->setRecordsTotal(empty($data[0]['count']) ? 0 : $data[0]['count'] - 1)
                ->setRecordsFiltered(empty($data[0]['count']) ? 0 : $data[0]['count'] - 1)
                ->setData($data)
        );
    }

    protected function prepareData(array $data)
    {
        $result = array();
        foreach ($data as $k) {
            $path = substr($k['path'], 0, strrpos($k['path'], '.'));
            if (!empty($path))
                $k['path'] =
                    PlatformCommonRubric::dao()
                        ->getByPath(substr($k['path'], 0, strrpos($k['path'], '.')))
                        ->getRubricData()
                        ->getShortName();
            else
                $k['path'] = "";
            $result[] = $k;
        }
        return $result;
    }
}