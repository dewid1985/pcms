<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-25 10:30:13                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformSocialAppAdminPage extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'PlatformSocialAppAdminPage', 8, true, true, false, null, null),
				'appAdmin' => LightMetaProperty::fill(new LightMetaProperty(), 'appAdmin', 'app_admin_id', 'identifier', 'PlatformSocialAppAdmin', null, true, false, false, 1, 3),
				'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, null, true, true, false, null, null),
				'category' => LightMetaProperty::fill(new LightMetaProperty(), 'category', null, 'string', null, null, false, true, false, null, null),
				'pageId' => LightMetaProperty::fill(new LightMetaProperty(), 'pageId', 'page_id', 'integer', null, 8, false, true, false, null, null),
				'accessToken' => LightMetaProperty::fill(new LightMetaProperty(), 'accessToken', 'access_token', 'string', null, null, true, true, false, null, null),
				'permissions' => LightMetaProperty::fill(new LightMetaProperty(), 'permissions', null, 'hstore', 'Hstore', null, false, true, false, null, null)
			);
		}
	}
?>