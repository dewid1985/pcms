<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-03-18 13:48:40                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoModuleMultimediaSearchOperationRequest extends ProtoModuleMultimediaRequest
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
						'ofUploadedAt' => LightMetaProperty::fill(new LightMetaProperty(), 'ofUploadedAt', 'of_uploaded_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
						'toUploadedAt' => LightMetaProperty::fill(new LightMetaProperty(), 'toUploadedAt', 'to_uploaded_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null)
					)
				);
		}
	}
?>