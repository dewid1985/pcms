<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-15 09:15:12                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformSocialAppAdmin extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'PlatformSocialAppAdmin', 8, true, true, false, null, null),
				'app' => LightMetaProperty::fill(new LightMetaProperty(), 'app', 'app_id', 'identifier', 'PlatformSocialApp', null, true, false, false, 1, 3),
				'appAccessToken' => LightMetaProperty::fill(new LightMetaProperty(), 'appAccessToken', 'app_access_token', 'string', null, null, true, true, false, null, null),
				'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, null, true, true, false, null, null),
				'socialAdminId' => LightMetaProperty::fill(new LightMetaProperty(), 'socialAdminId', 'social_admin_id', 'integer', null, 8, true, true, false, null, null)
			);
		}
	}
?>