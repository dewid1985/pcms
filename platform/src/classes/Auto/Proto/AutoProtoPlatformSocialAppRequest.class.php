<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-14 10:54:19                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformSocialAppRequest extends ProtoPlatformBaseRequest
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, 32, true, true, false, null, null),
						'socialNetwork' => LightMetaProperty::fill(new LightMetaProperty(), 'socialNetwork', 'social_network', 'string', null, null, true, true, false, null, null),
						'appId' => LightMetaProperty::fill(new LightMetaProperty(), 'appId', 'app_id', 'string', null, null, true, true, false, null, null),
						'appSecretKey' => LightMetaProperty::fill(new LightMetaProperty(), 'appSecretKey', 'app_secret_key', 'string', null, null, true, true, false, null, null)
					)
				);
		}
	}
?>