<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-04-13 12:41:04                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoModuleArticleRequest extends ProtoPlatformBaseRequest
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'articleId' => LightMetaProperty::fill(new LightMetaProperty(), 'articleId', 'article_id', 'string', null, null, false, true, false, null, null),
						'projectId' => LightMetaProperty::fill(new LightMetaProperty(), 'projectId', 'project_id', 'string', null, null, false, true, false, null, null),
						'articleDraftId' => LightMetaProperty::fill(new LightMetaProperty(), 'articleDraftId', 'article_draft_id', 'string', null, null, false, true, false, null, null),
						'articlePublishedId' => LightMetaProperty::fill(new LightMetaProperty(), 'articlePublishedId', 'article_published_id', 'string', null, null, false, true, false, null, null),
						'publishedAt' => LightMetaProperty::fill(new LightMetaProperty(), 'publishedAt', 'published_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
						'published' => LightMetaProperty::fill(new LightMetaProperty(), 'published', null, 'boolean', null, null, false, true, false, null, null),
						'rubrics' => LightMetaProperty::fill(new LightMetaProperty(), 'rubrics', null, 'hstore', 'Hstore', null, false, true, false, null, null),
						'title' => LightMetaProperty::fill(new LightMetaProperty(), 'title', null, 'string', null, null, false, true, false, null, null),
						'anons' => LightMetaProperty::fill(new LightMetaProperty(), 'anons', null, 'string', null, null, false, true, false, null, null),
						'text' => LightMetaProperty::fill(new LightMetaProperty(), 'text', null, 'string', null, null, false, true, false, null, null),
						'author' => LightMetaProperty::fill(new LightMetaProperty(), 'author', null, 'string', null, null, false, true, false, null, null),
						'adminId' => LightMetaProperty::fill(new LightMetaProperty(), 'adminId', 'admin_id', 'integer', null, 4, false, true, false, null, null),
						'metaDescription' => LightMetaProperty::fill(new LightMetaProperty(), 'metaDescription', 'meta_description', 'string', null, null, false, true, false, null, null),
						'metaKeywords' => LightMetaProperty::fill(new LightMetaProperty(), 'metaKeywords', 'meta_keywords', 'string', null, null, false, true, false, null, null),
						'createdAt' => LightMetaProperty::fill(new LightMetaProperty(), 'createdAt', 'created_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
						'modifiedAt' => LightMetaProperty::fill(new LightMetaProperty(), 'modifiedAt', 'modified_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
						'preview' => LightMetaProperty::fill(new LightMetaProperty(), 'preview', null, 'string', null, null, false, true, false, null, null),
						'images' => LightMetaProperty::fill(new LightMetaProperty(), 'images', null, 'hstore', 'Hstore', null, false, true, false, null, null)
					)
				);
		}
	}
?>