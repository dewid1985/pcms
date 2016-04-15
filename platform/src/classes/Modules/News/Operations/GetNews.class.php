<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 09.02.15
 * Time: 18:29
 */
class GetNews extends NewsOperation implements IModuleOperation
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleNewsGetOperationRequest
     */
    protected function getRequest()
    {
        return $this->getModuleObject()->getRequest();
    }

    /**
     * @return mixed|void
     */
    public function operation()
    {
        $news = PlatformCommonNews::dao()->getByNewsAndProject(
            $this->getRequest()->getNewsId(),
            $this->getRequest()->getProjectId()
        );

        $this->getModuleObject()->setResponse(
            ModuleNewsGetOperationResponse::create()
                ->setNewsId($news->getId())
                ->setCreatedAt($news->getCreatedAt())
                ->setPublishedAt($news->getPublishedAt())
                ->setRubrics($news->getNewsDraft()->getRubrics())
                ->setMetaDescription($news->getNewsDraft()->getMetaDescription())
                ->setMetaKeywords($news->getNewsDraft()->getMetaKeywords())
                ->setTitle($news->getNewsDraft()->getTitle())
                ->setAnons($news->getNewsDraft()->getAnons())
                ->setText($news->getNewsDraft()->getText())
        );
    }
}