<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-13 07:54:36                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoPlatformCommonRubricData extends AbstractProtoClass
	{
		protected function makePropertyList()
		{
			return array(
				'id' => LightMetaProperty::fill(new LightMetaProperty(), 'id', null, 'integerIdentifier', 'PlatformCommonRubricData', 8, true, true, false, null, null),
				'shortName' => LightMetaProperty::fill(new LightMetaProperty(), 'shortName', 'short_name', 'string', null, null, true, true, false, null, null),
				'metaKeywords' => LightMetaProperty::fill(new LightMetaProperty(), 'metaKeywords', 'meta_keywords', 'string', null, null, true, true, false, null, null),
				'metaDescription' => LightMetaProperty::fill(new LightMetaProperty(), 'metaDescription', 'meta_description', 'string', null, null, true, true, false, null, null),
				'description' => LightMetaProperty::fill(new LightMetaProperty(), 'description', null, 'string', null, null, false, true, false, null, null)
			);
		}
	}
?>