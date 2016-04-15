<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2016-01-27 11:18:06                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformSocialFlowGroups extends IdentifiableObject
	{
		protected $flow = null;
		protected $flowId = null;
		protected $group = null;
		protected $groupId = null;
		
		/**
		 * @return PlatformSocialFlow
		**/
		public function getFlow()
		{
			if (!$this->flow && $this->flowId) {
				$this->flow = PlatformSocialFlow::dao()->getById($this->flowId);
			}
			
			return $this->flow;
		}
		
		public function getFlowId()
		{
			return $this->flow
				? $this->flow->getId()
				: $this->flowId;
		}
		
		/**
		 * @return PlatformSocialFlowGroups
		**/
		public function setFlow(PlatformSocialFlow $flow)
		{
			$this->flow = $flow;
			$this->flowId = $flow ? $flow->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return PlatformSocialFlowGroups
		**/
		public function setFlowId($id)
		{
			$this->flow = null;
			$this->flowId = $id;
			
			return $this;
		}
		
		/**
		 * @return PlatformSocialFlowGroups
		**/
		public function dropFlow()
		{
			$this->flow = null;
			$this->flowId = null;
			
			return $this;
		}
		
		/**
		 * @return PlatformSocialAppAdminGroup
		**/
		public function getGroup()
		{
			if (!$this->group && $this->groupId) {
				$this->group = PlatformSocialAppAdminGroup::dao()->getById($this->groupId);
			}
			
			return $this->group;
		}
		
		public function getGroupId()
		{
			return $this->group
				? $this->group->getId()
				: $this->groupId;
		}
		
		/**
		 * @return PlatformSocialFlowGroups
		**/
		public function setGroup(PlatformSocialAppAdminGroup $group)
		{
			$this->group = $group;
			$this->groupId = $group ? $group->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return PlatformSocialFlowGroups
		**/
		public function setGroupId($id)
		{
			$this->group = null;
			$this->groupId = $id;
			
			return $this;
		}
		
		/**
		 * @return PlatformSocialFlowGroups
		**/
		public function dropGroup()
		{
			$this->group = null;
			$this->groupId = null;
			
			return $this;
		}
	}
?>