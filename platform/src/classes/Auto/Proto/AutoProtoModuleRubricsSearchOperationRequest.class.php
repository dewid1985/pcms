<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-03-06 11:21:14                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoModuleRubricsSearchOperationRequest extends ProtoModuleRubricsRequest
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'draw' => LightMetaProperty::fill(new LightMetaProperty(), 'draw', null, 'integer', null, 4, true, true, false, null, null),
						'offset' => LightMetaProperty::fill(new LightMetaProperty(), 'offset', null, 'integer', null, 4, true, true, false, null, null),
						'limit' => LightMetaProperty::fill(new LightMetaProperty(), 'limit', null, 'integer', null, 4, true, true, false, null, null),
						'ofCreatedAt' => LightMetaProperty::fill(new LightMetaProperty(), 'ofCreatedAt', 'of_created_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
						'toCreatedAt' => LightMetaProperty::fill(new LightMetaProperty(), 'toCreatedAt', 'to_created_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
						'ofModifiedAt' => LightMetaProperty::fill(new LightMetaProperty(), 'ofModifiedAt', 'of_modified_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
						'toModifiedAt' => LightMetaProperty::fill(new LightMetaProperty(), 'toModifiedAt', 'to_modified_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null)
					)
				);
		}
	}
?>