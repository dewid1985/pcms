<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2015-02-17 09:58:59                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoProtoModuleRubricsGetOperationResponse extends ProtoModuleRubricsResponse
	{
		protected function makePropertyList()
		{
			return
				array_merge(
					parent::makePropertyList(),
					array(
						'parentRubricName' => LightMetaProperty::fill(new LightMetaProperty(), 'parentRubricName', 'parent_rubric_name', 'string', null, null, false, true, false, null, null)
					)
				);
		}
	}
?>