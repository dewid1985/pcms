<?php

class PlatformCommonArticleDAO extends AutoPlatformCommonArticleDAO
{
    protected $array = array();

    /**
     * Получить статью по айди
     *
     * @param $id
     * @param int $expires
     * @return  PlatformCommonArticle
     */
    public function getById($id, $expires = Cache::EXPIRES_MEDIUM)
    {
        return parent::getById($id, $expires);
    }

    /**
     * Сиквенц
     *
     * @return string
     */
    public function getSequence()
    {
        return parent::getSequence() . '_seq';

    }

    /**
     * Получить статью по айди статьи, и по айди проекта
     *
     * @param $articleId
     * @param $projectId
     * @return PlatformCommonArticle
     */
    public function getByArticleAndProject($articleId, $projectId)
    {
        return Criteria::create($this)
            ->add(Expression::eq(DBField::create('id'), DBValue::create($articleId)))
            ->add(Expression::eq(DBField::create('project_id'), DBValue::create($projectId)))
            ->get();
    }


    /**
     * Поиск по реквесту
     *
     * @param ModuleArticleSearchOperationRequest $request
     * @return array
     */
    public function getBySearchOperationRequest(ModuleArticleSearchOperationRequest $request)
    {
        $criteria =
            Criteria::create($this)
                ->addProjection(
                    Projection::group('id')
                )
                ->addProjection(
                    Projection::group('articleDraft.title')
                )
                ->addProjection(
                    Projection::group('articleDraft.modifiedAt')
                )
                ->addProjection(
                    Projection::group('articleDraft.author')
                )
                ->addProjection(
                    Projection::property(
                        PlatformDialectString::create('count("common"."article"."id") OVER ()')
                    )
                )
                ->addProjection(
                    Projection::property('id')
                )

                ->addProjection(
                    Projection::property('articleDraft.author')
                )
                ->addProjection(
                    Projection::property('articleDraft.title')
                )
                ->addProjection(
                    Projection::property(
                        PlatformDialectString::create(
                            'to_char("common"."article"."created_at"::timestamptz ,\'YYYY-MM-DD HH24:MI\') as "created_at"'
                        )
                    )
                )
                ->addProjection(
                    Projection::property(
                        PlatformDialectString::create(
                            'to_char("'.dechex(crc32(PlatformCommonArticleDraft::dao()->getTable()))
                            . '_article_draft_id'.'"."modified_at"::timestamptz ,\'YYYY-MM-DD HH24:MI\') as "modified_at"'
                        )
                    )
                )
                ->addProjection(
                    Projection::property(
                        PlatformDialectString::create(
                            'to_char("common"."article"."published_at"::timestamptz ,\'YYYY-MM-DD HH24:MI\') as "published_at"'
                        )
                    )
                );

        $textSearchBlock = Expression::orBlock();

        if (!is_null($request->getTitle()))
            $textSearchBlock->expOr(
                Expression::fullTextOr(
                    dechex(crc32(PlatformCommonArticleDraft::dao()->getTable())) . '_article_draft_id.title',
                    array_map(
                        function ($parse) {
                            return trim($parse);
                        }, explode(',', $request->getTitle())
                    )
                )
            );

        if (!is_null($request->getAnons()))
            $textSearchBlock->expOr(
                Expression::fullTextOr(
                    dechex(crc32(PlatformCommonArticleDraft::dao()->getTable())) . '_article_draft_id.anons',
                    array_map(
                        function ($parse) {
                            return trim($parse);
                        }, explode(',', $request->getAnons())
                    )
                )
            );

        if (!is_null($request->getText()))
            $textSearchBlock->expOr(
                Expression::fullTextOr(
                    dechex(crc32(PlatformCommonArticleDraft::dao()->getTable())) . '_article_draft_id.text'                    ,
                    array_map(
                        function ($parse) {
                            return trim($parse);
                        }, explode(',', $request->getText())
                    )
                )
            );

        if ($textSearchBlock->getSize() != 0)
            $criteria
                ->add($textSearchBlock);


        if ($request->getOfCreatedAt() && $request->getToCreatedAt())
            $criteria
                ->add(
                    Expression::gt('createdAt', $request->getOfCreatedAt())
                )
                ->add(
                    Expression::lt('createdAt', $request->getToCreatedAt())
                );

        if (is_null($request->getOfCreatedAt()) && $request->getToCreatedAt())
            $criteria->add(
                Expression::lt('createdAt', $request->getToCreatedAt())
            );

        if ($request->getOfCreatedAt() && is_null($request->getToCreatedAt()))
            $criteria->add(
                Expression::gt('createdAt', $request->getOfCreatedAt())
            );


        if ($request->getOfPublishedAt() && $request->getToPublishedAt())
            $criteria
                ->add(
                    Expression::gt('publishedAt', $request->getOfPublishedAt())
                )
                ->add(
                    Expression::lt('publishedAt', $request->getToPublishedAt())
                );

        if (is_null($request->getOfPublishedAt()) && $request->getToPublishedAt())
            $criteria->add(
                Expression::lt('publishedAt', $request->getToPublishedAt())
            );

        if ($request->getOfPublishedAt() && is_null($request->getToPublishedAt()))

            $criteria->add(
                Expression::gt('publishedAt', $request->getOfPublishedAt())
            );

        if ($request->getOfModifiedAt() && $request->getToModifiedAt())
            $criteria
                ->add(
                    Expression::gt('articleDraft.modifiedAt', $request->getOfModifiedAt())
                )
                ->add(
                    Expression::lt('articleDraft.modifiedAt', $request->getToModifiedAt())
                );

        if (is_null($request->getOfModifiedAt()) && $request->getToModifiedAt())
            $criteria->add(
                Expression::lt('articleDraft.modifiedAt', $request->getToModifiedAt())
            );

        if ($request->getOfModifiedAt() && is_null($request->getToModifiedAt()))
            $criteria->add(
                Expression::gt('articleDraft.modifiedAt', $request->getOfModifiedAt())
            );

        $criteria
            ->add(Expression::eq(DBField::create('project_id'), DBValue::create($request->getProjectId())))
            ->addOrder(OrderBy::create('id')->desc())
            ->setLimit($request->getLimit())
            ->setOffset($request->getOffset());

        return $criteria
            ->getCustomList();
    }
}

?>