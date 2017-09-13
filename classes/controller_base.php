<?php
// абстрактый класс контроллера
Abstract Class Controller_Base {

	protected $template;
	protected $layouts; // шаблон
	
	//оставшееся часть url
	public $args = array();

	// в конструкторе подключаем шаблоны
	function __construct() {
		// шаблоны
		$this->template = new Template($this->layouts, get_class($this));
	}
	
	function args($value) {
		$this->args = $value;
		return true;
	}
	
	abstract function index();
	
}
