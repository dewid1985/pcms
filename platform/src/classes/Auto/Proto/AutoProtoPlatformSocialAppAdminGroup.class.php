<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-15 09:15:12                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformSocialAppAdminGroup extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'PlatformSocialAppAdminGroup', 8, true, true, false, null, null),
				'appAdmin' => LightMetaProperty::fill(new LightMetaProperty(), 'appAdmin', 'app_admin_id', 'identifier', 'PlatformSocialAppAdmin', null, true, false, false, 1, 3),
				'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, null, true, true, false, null, null),
				'privacy' => LightMetaProperty::fill(new LightMetaProperty(), 'privacy', null, 'string', null, null, false, true, false, null, null),
				'groupId' => LightMetaProperty::fill(new LightMetaProperty(), 'groupId', 'group_id', 'integer', null, 8, true, true, false, null, null)
			);
		}
	}
?>