<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2014-12-08 13:25:11                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPlatformUsersUserRegistrationFacts extends IdentifiableObject
	{
		protected $user = null;
		protected $userId = null;
		protected $project = null;
		protected $projectId = null;
		protected $registredAt = null;
		
		/**
		 * @return PlatformUsersUser
		**/
		public function getUser()
		{
			if (!$this->user && $this->userId) {
				$this->user = PlatformUsersUser::dao()->getById($this->userId);
			}
			
			return $this->user;
		}
		
		public function getUserId()
		{
			return $this->user
				? $this->user->getId()
				: $this->userId;
		}
		
		/**
		 * @return PlatformUsersUserRegistrationFacts
		**/
		public function setUser(PlatformUsersUser $user)
		{
			$this->user = $user;
			$this->userId = $user ? $user->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return PlatformUsersUserRegistrationFacts
		**/
		public function setUserId($id)
		{
			$this->user = null;
			$this->userId = $id;
			
			return $this;
		}
		
		/**
		 * @return PlatformUsersUserRegistrationFacts
		**/
		public function dropUser()
		{
			$this->user = null;
			$this->userId = null;
			
			return $this;
		}
		
		/**
		 * @return PlatformCommonProject
		**/
		public function getProject()
		{
			if (!$this->project && $this->projectId) {
				$this->project = PlatformCommonProject::dao()->getById($this->projectId);
			}
			
			return $this->project;
		}
		
		public function getProjectId()
		{
			return $this->project
				? $this->project->getId()
				: $this->projectId;
		}
		
		/**
		 * @return PlatformUsersUserRegistrationFacts
		**/
		public function setProject(PlatformCommonProject $project)
		{
			$this->project = $project;
			$this->projectId = $project ? $project->getId() : null;
			
			return $this;
		}
		
		/**
		 * @return PlatformUsersUserRegistrationFacts
		**/
		public function setProjectId($id)
		{
			$this->project = null;
			$this->projectId = $id;
			
			return $this;
		}
		
		/**
		 * @return PlatformUsersUserRegistrationFacts
		**/
		public function dropProject()
		{
			$this->project = null;
			$this->projectId = null;
			
			return $this;
		}
		
		/**
		 * @return TimestampTZ
		**/
		public function getRegistredAt()
		{
			return $this->registredAt;
		}
		
		/**
		 * @return PlatformUsersUserRegistrationFacts
		**/
		public function setRegistredAt(TimestampTZ $registredAt)
		{
			$this->registredAt = $registredAt;
			
			return $this;
		}
		
		/**
		 * @return PlatformUsersUserRegistrationFacts
		**/
		public function dropRegistredAt()
		{
			$this->registredAt = null;
			
			return $this;
		}
	}
?>