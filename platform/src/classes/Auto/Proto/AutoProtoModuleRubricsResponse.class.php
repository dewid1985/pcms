<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-12 16:26:35                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoModuleRubricsResponse extends ProtoPlatformBaseResponse
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'rubricId' => LightMetaProperty::fill(new LightMetaProperty(), 'rubricId', 'rubric_id', 'integer', null, 4, false, true, false, null, null),
						'projectId' => LightMetaProperty::fill(new LightMetaProperty(), 'projectId', 'project_id', 'integer', null, 4, false, true, false, null, null),
						'adminId' => LightMetaProperty::fill(new LightMetaProperty(), 'adminId', 'admin_id', 'integer', null, 4, false, true, false, null, null),
						'RubricDataId' => LightMetaProperty::fill(new LightMetaProperty(), 'RubricDataId', '_rubric_data_id', 'integer', null, 4, false, true, false, null, null),
						'name' => LightMetaProperty::fill(new LightMetaProperty(), 'name', null, 'string', null, null, false, true, false, null, null),
						'path' => LightMetaProperty::fill(new LightMetaProperty(), 'path', null, 'string', null, null, false, true, false, null, null),
						'enabled' => LightMetaProperty::fill(new LightMetaProperty(), 'enabled', null, 'boolean', null, null, false, true, false, null, null),
						'createdAt' => LightMetaProperty::fill(new LightMetaProperty(), 'createdAt', 'created_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
						'modifiedAt' => LightMetaProperty::fill(new LightMetaProperty(), 'modifiedAt', 'modified_at', 'timestampTZ', 'TimestampTZ', null, false, true, false, null, null),
						'shortName' => LightMetaProperty::fill(new LightMetaProperty(), 'shortName', 'short_name', 'string', null, null, false, true, false, null, null),
						'description' => LightMetaProperty::fill(new LightMetaProperty(), 'description', null, 'string', null, null, false, true, false, null, null),
						'metaDescription' => LightMetaProperty::fill(new LightMetaProperty(), 'metaDescription', 'meta_description', 'string', null, null, false, true, false, null, null),
						'metaKeywords' => LightMetaProperty::fill(new LightMetaProperty(), 'metaKeywords', 'meta_keywords', 'string', null, null, false, true, false, null, null)
					)
				);
		}
	}
?>