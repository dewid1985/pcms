<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-27 11:18:06                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformSocialFlowPages extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'PlatformSocialFlowPages', 8, true, true, false, null, null),
				'flow' => LightMetaProperty::fill(new LightMetaProperty(), 'flow', 'flow_id', 'identifier', 'PlatformSocialFlow', null, true, false, false, 1, 3),
				'page' => LightMetaProperty::fill(new LightMetaProperty(), 'page', 'page_id', 'identifier', 'PlatformSocialAppAdminPage', null, true, false, false, 1, 3)
			);
		}
	}
?>