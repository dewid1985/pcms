<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 29.01.15
 * Time: 11:45
 */
class SearchArticle extends ArticleOperation implements IModuleOperation
{
    /**
     * __construct
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleArticleSearchOperationRequest
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
        $data = PlatformCommonArticle::dao()->getBySearchOperationRequest($this->getRequest());

        $this->getModuleObject()->setResponse(
            ModuleArticleSearchOperationResponse::create()
                ->setDraw($this->getRequest()->getDraw())
                ->setRecordsTotal(empty($data[0]['count'])?0:$data[0]['count'])
                ->setRecordsFiltered(empty($data[0]['count'])?0:$data[0]['count'])
                ->setData($data)
        );
    }
}