<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-09 09:15:21                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformCommonProjectModule extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'PlatformCommonProjectModule', 8, true, true, false, null, null),
				'module' => LightMetaProperty::fill(new LightMetaProperty(), 'module', 'module_id', 'identifier', 'PlatformCommonModule', null, true, false, false, 1, 3),
				'project' => LightMetaProperty::fill(new LightMetaProperty(), 'project', 'project_id', 'identifier', 'PlatformCommonProject', null, true, false, false, 1, 3),
				'disabled' => LightMetaProperty::fill(new LightMetaProperty(), 'disabled', null, 'boolean', null, null, false, true, false, null, null)
			);
		}
	}
?>