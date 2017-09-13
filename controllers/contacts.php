<?php
// контролер
Class Controller_Contacts Extends Controller_Base {
	
	// шаблон
	public $layouts = "main";
	
	// экшен
	function index() {
		$this->template->vars('pagetitle', "Контакты");
		$this->template->view('contacts');
	}
	
		
}