<?php
// контролер
Class Controller_About Extends Controller_Base {
	
	// шаблон
	public $layouts = "main";
	
	// экшен
	function index() {
		$this->template->vars('pagetitle', "О задании");
		$this->template->view('about');
	}
	
		
}