<?php

/**
 * Сохранение черновика
 *
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 11:32
 */
class AddArticle extends ArticleOperation implements IModuleOperation
{
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
        /** @var PlatformCommonArticle $article */
        $article = PlatformCommonArticle::dao()
            ->add(
                PlatformCommonArticle::create()
                    ->setProjectId($this->getRequest()->getProjectId())
                    ->setArticleDraftId(
                        PlatformCommonArticleDraft::dao()
                            ->add(
                                PlatformCommonArticleDraft::create()
                                    ->setTitle($this->getRequest()->getTitle())
                                    ->setAnons($this->getRequest()->getAnons())
                                    ->setText($this->getRequest()->getText())
                                    ->setMetaDescription($this->getRequest()->getMetaDescription())
                                    ->setMetaKeywords($this->getRequest()->getMetaKeywords())
                                    ->setRubrics($this->getRequest()->getRubrics())
                                    ->setPreview($this->getRequest()->getPreview())
                                    ->setAdminId($this->getRequest()->getAdminId())
                                    ->setAuthor($this->getRequest()->getAuthor())
                            )
                            ->getId()
                    )
                    ->setCreatedAt(TimestampTZ::makeNow())
                    ->setPublishedAt($this->getRequest()->getPublishedAt())
                    ->setPublished(FALSE)
            );

        PlatformCommonArticleDraft::dao()
            ->save(
                PlatformCommonArticle::dao()
                    ->getById($article->getId())
                    ->getArticleDraft()
                    ->setArticle($article)
            );

        $this->getModuleObject()
            ->setResponse(
                ModuleArticleAddOperationResponse::create()
                    ->setArticleId($article->getId())
            );
    }
}