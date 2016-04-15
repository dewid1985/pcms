<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-01-27 11:24:06                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformCommonArticle extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'PlatformCommonArticle', 8, true, true, false, null, null),
				'project' => LightMetaProperty::fill(new LightMetaProperty(), 'project', 'project_id', 'identifier', 'PlatformCommonProject', null, true, false, false, 1, 3),
				'articleDraft' => LightMetaProperty::fill(new LightMetaProperty(), 'articleDraft', 'article_draft_id', 'identifier', 'PlatformCommonArticleDraft', null, false, false, false, 1, 3),
				'articlePublished' => LightMetaProperty::fill(new LightMetaProperty(), 'articlePublished', 'article_published_id', 'identifier', 'PlatformCommonArticlePublished', null, false, false, false, 1, 3),
				'createdAt' => LightMetaProperty::fill(new LightMetaProperty(), 'createdAt', 'created_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
				'publishedAt' => LightMetaProperty::fill(new LightMetaProperty(), 'publishedAt', 'published_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
				'published' => LightMetaProperty::fill(new LightMetaProperty(), 'published', null, 'boolean', null, null, false, true, false, null, null)
			);
		}
	}
?>