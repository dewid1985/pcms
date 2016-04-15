<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 09.02.15
 * Time: 11:45
 */
class SearchNews extends NewsOperation implements IModuleOperation
{
    /**
     * __construct
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleNewsSearchOperationRequest
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
        $data = PlatformCommonNews::dao()->getBySearchOperationRequest($this->getRequest());

        $this->getModuleObject()->setResponse(
            ModuleNewsSearchOperationResponse::create()
                ->setDraw($this->getRequest()->getDraw())
                ->setRecordsTotal(empty($data[0]['count'])?0:$data[0]['count'])
                ->setRecordsFiltered(empty($data[0]['count'])?0:$data[0]['count'])
                ->setData($data)
        );
    }
}