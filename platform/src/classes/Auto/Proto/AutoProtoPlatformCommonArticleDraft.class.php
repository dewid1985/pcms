<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-04-13 12:41:04                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformCommonArticleDraft extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'PlatformCommonArticleDraft', 8, true, true, false, null, null),
				'article' => LightMetaProperty::fill(new LightMetaProperty(), 'article', 'article_id', 'identifier', 'PlatformCommonArticle', null, false, false, false, 1, 3),
				'admin' => LightMetaProperty::fill(new LightMetaProperty(), 'admin', 'admin_id', 'identifier', 'PlatformUsersAdmin', null, false, false, false, 1, 3),
				'title' => LightMetaProperty::fill(new LightMetaProperty(), 'title', null, 'string', null, null, false, true, false, null, null),
				'anons' => LightMetaProperty::fill(new LightMetaProperty(), 'anons', null, 'string', null, null, false, true, false, null, null),
				'text' => LightMetaProperty::fill(new LightMetaProperty(), 'text', null, 'string', null, null, false, true, false, null, null),
				'author' => LightMetaProperty::fill(new LightMetaProperty(), 'author', null, 'string', null, null, false, true, false, null, null),
				'metaDescription' => LightMetaProperty::fill(new LightMetaProperty(), 'metaDescription', 'meta_description', 'string', null, null, false, true, false, null, null),
				'metaKeywords' => LightMetaProperty::fill(new LightMetaProperty(), 'metaKeywords', 'meta_keywords', 'string', null, null, false, true, false, null, null),
				'rubrics' => LightMetaProperty::fill(new LightMetaProperty(), 'rubrics', null, 'hstore', 'Hstore', null, false, true, false, null, null),
				'modifiedAt' => LightMetaProperty::fill(new LightMetaProperty(), 'modifiedAt', 'modified_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
				'preview' => LightMetaProperty::fill(new LightMetaProperty(), 'preview', null, 'string', null, null, false, true, false, null, null),
				'images' => LightMetaProperty::fill(new LightMetaProperty(), 'images', null, 'hstore', 'Hstore', null, false, true, false, null, null)
			);
		}
	}
?>