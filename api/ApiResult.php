<?php 
	class ApiResult {
		public $Success;
		public $RedirectUrl;
		public $Data;
		public $Errors;

		function __construct($success, $redirectUrl) 
		{
		   $this->Success = $success;
		   $this->RedirectUrl = $redirectUrl;
		   $this->Data = array();
		   $this->Errors = array();	
		}
	}
?>