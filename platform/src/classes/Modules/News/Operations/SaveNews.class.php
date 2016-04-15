<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 09.02.15
 * Time: 18:20
 */
class SaveNews extends NewsOperation implements IModuleOperation
{
    private $modifiedAt = NULL;

    /**
     * @return TimestampTZ
     */
    public function getModifiedAt()
    {
        if (is_null($this->modifiedAt))
            $this->modifiedAt = TimestampTZ::makeNow();
        return $this->modifiedAt;
    }

    /**
     * __construct
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleNewsAddOperationRequest
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


        $news = PlatformCommonNews::dao()
            ->getById($this->getRequest()->getNewsId());

        PlatformCommonNews::dao()
            ->save(
                $news
                    ->setPublishedAt($this->getRequest()->getPublishedAt())
            );

        PlatformCommonNewsDraft::dao()
            ->save(
                $news
                    ->getNewsDraft()
                    ->setTitle($this->getRequest()->getTitle())
                    ->setAnons($this->getRequest()->getAnons())
                    ->setText($this->getRequest()->getText())
                    ->setMetaDescription($this->getRequest()->getMetaDescription())
                    ->setMetaKeywords($this->getRequest()->getMetaKeywords())
                    ->setRubrics($this->getRequest()->getRubrics())
                    ->setModifiedAt($this->getModifiedAt())
                    ->setPreview($this->getRequest()->getPreview())
                    ->setAdminId($this->getRequest()->getAdminId())
            );

        $this->getModuleObject()->setResponse(
            ModuleNewsSaveOperationResponse::create()
                ->setModifiedAt($this->getModifiedAt())
                ->setNewsId($news->getId())
        );

    }
}