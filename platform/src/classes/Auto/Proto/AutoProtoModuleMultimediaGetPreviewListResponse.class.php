<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-03-27 09:47:05                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoModuleMultimediaGetPreviewListResponse extends ProtoModuleMultimediaResponse
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'data' => LightMetaProperty::fill(new LightMetaProperty(), 'data', null, 'string', null, null, false, true, false, null, null)
					)
				);
		}
	}
?>