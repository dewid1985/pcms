<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-04-08 11:53:07                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformSocialApp extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'PlatformSocialApp', 8, true, true, false, null, null),
				'admin' => LightMetaProperty::fill(new LightMetaProperty(), 'admin', 'created_admin_id', 'identifier', 'PlatformUsersAdmin', null, true, false, false, 1, 3),
				'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, 32, true, true, false, null, null),
				'socialNetwork' => LightMetaProperty::fill(new LightMetaProperty(), 'socialNetwork', 'social_network', 'enum', 'PlatformSocialNameEnum', null, true, false, false, 1, null),
				'appId' => LightMetaProperty::fill(new LightMetaProperty(), 'appId', 'app_id', 'integer', null, 8, true, true, false, null, null),
				'appSecretKey' => LightMetaProperty::fill(new LightMetaProperty(), 'appSecretKey', 'app_secret_key', 'string', null, null, true, true, false, null, null),
				'createdAt' => LightMetaProperty::fill(new LightMetaProperty(), 'createdAt', 'created_at', 'timestampTZ', 'TimestampTZ', null, true, true, false, null, null),
				'picture' => LightMetaProperty::fill(new LightMetaProperty(), 'picture', null, 'boolean', null, null, false, true, false, null, null)
			);
		}
	}
?>