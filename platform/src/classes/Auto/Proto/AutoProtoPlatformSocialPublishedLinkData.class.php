<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-04-11 09:08:09                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformSocialPublishedLinkData extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'PlatformSocialPublishedLinkData', 8, true, true, false, null, null),
				'publishedLink' => LightMetaProperty::fill(new LightMetaProperty(), 'publishedLink', 'published_link_id', 'identifier', 'PlatformSocialPublishedLink', null, true, false, false, 1, 3),
				'appAdminPages' => LightMetaProperty::fill(new LightMetaProperty(), 'appAdminPages', 'app_admin_pages_id', 'identifier', 'PlatformSocialAppAdminPage', null, false, false, false, 1, 3),
				'appAdminGroup' => LightMetaProperty::fill(new LightMetaProperty(), 'appAdminGroup', 'app_admin_group_id', 'identifier', 'PlatformSocialAppAdminGroup', null, false, false, false, 1, 3),
				'socialNetwork' => LightMetaProperty::fill(new LightMetaProperty(), 'socialNetwork', 'social_network', 'enum', 'PlatformSocialNameEnum', null, true, false, false, 1, null),
				'postId' => LightMetaProperty::fill(new LightMetaProperty(), 'postId', 'post_id', 'string', null, 512, false, true, false, null, null)
			);
		}
	}
?>