<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-28 13:42:23                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformSocialPublishedLink extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'PlatformSocialPublishedLink', 8, true, true, false, null, null),
				'flow' => LightMetaProperty::fill(new LightMetaProperty(), 'flow', 'flow_id', 'identifier', 'PlatformSocialFlow', null, true, false, false, 1, 3),
				'description' => LightMetaProperty::fill(new LightMetaProperty(), 'description', null, 'string', null, 256, true, true, false, null, null),
				'linkUrl' => LightMetaProperty::fill(new LightMetaProperty(), 'linkUrl', 'link_url', 'string', null, 512, true, true, false, null, null),
				'imgUrl' => LightMetaProperty::fill(new LightMetaProperty(), 'imgUrl', 'img_url', 'string', null, 512, true, true, false, null, null),
				'published' => LightMetaProperty::fill(new LightMetaProperty(), 'published', null, 'boolean', null, null, false, true, false, null, null),
				'publishedAt' => LightMetaProperty::fill(new LightMetaProperty(), 'publishedAt', 'published_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
				'createdAt' => LightMetaProperty::fill(new LightMetaProperty(), 'createdAt', 'created_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null)
			);
		}
	}
?>