<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 18:20
 */
class SaveArticle extends ArticleOperation implements IModuleOperation
{
    private $modifiedAt = NULL;

    /**
     * @return Timestamp
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
     * @return ModuleArticleAddOperationRequest
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
        $article = PlatformCommonArticle::dao()
            ->getById($this->getRequest()->getArticleId());

        PlatformCommonArticle::dao()
            ->save(
                $article
                    ->setPublishedAt($this->getRequest()->getPublishedAt())
            );

        PlatformCommonArticleDraft::dao()
            ->save(
                $article
                    ->getArticleDraft()
                    ->setTitle($this->getRequest()->getTitle())
                    ->setAnons($this->getRequest()->getAnons())
                    ->setText($this->getRequest()->getText())
                    ->setMetaDescription($this->getRequest()->getMetaDescription())
                    ->setMetaKeywords($this->getRequest()->getMetaKeywords())
                    ->setRubrics($this->getRequest()->getRubrics())
                    ->setModifiedAt($this->getModifiedAt())
                    ->setPreview($this->getRequest()->getPreview())
                    ->setAuthor($this->getRequest()->getAuthor())
                    ->setAdminId($this->getRequest()->getAdminId())
            );


        $this->getModuleObject()->setResponse(
            ModuleArticleSaveOperationResponse::create()
                ->setModifiedAt($this->getModifiedAt())
                ->setArticleId($article->getId())
        );

    }
}