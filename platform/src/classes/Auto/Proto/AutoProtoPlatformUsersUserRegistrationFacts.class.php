<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-08 13:25:11                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformUsersUserRegistrationFacts extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'PlatformUsersUserRegistrationFacts', 8, true, true, false, null, null),
				'user' => LightMetaProperty::fill(new LightMetaProperty(), 'user', 'user_id', 'identifier', 'PlatformUsersUser', null, true, false, false, 1, 3),
				'project' => LightMetaProperty::fill(new LightMetaProperty(), 'project', 'project_id', 'identifier', 'PlatformCommonProject', null, true, false, false, 1, 3),
				'registredAt' => LightMetaProperty::fill(new LightMetaProperty(), 'registredAt', 'registred_at', 'timestampTZ', 'TimestampTZ', null, true, true, false, null, null)
			);
		}
	}
?>