<?php
// контролер
Class Controller_Address Extends Controller_Base {
	
	// шаблон
	public $layouts = "main";
	
	// экшен
	function index() {
		
	}
	
	function town() {
	
		$select = array(
				'fields' => "town, subyect, subyect_id",
				'group' => "subyect_id, town ", // группируем
				'join' => "INNER JOIN subyectrf ON address.subyect_id = subyectrf.id",
				'order' => "subyectrf.id, town" // сортируем
		);
	
		$model = new Model_Address($select); // создаем объект модели
		$town = $model->getAllRows(); // получаем города
			
		//создаем js массив
		echo json_encode($town);
		
	}
	
	function street() {
		$town = "";
		
		if (isset($_REQUEST['town'])) {
			$town = ($_REQUEST['town']);
		}
		
		$select = array(
				'where' => "town like '".$town."'",
				'order' => "street" // сортируем
		);
	
		$model = new Model_Address($select); // создаем объект модели
		$street = $model->getAllRows(); // получаем фото
			
		//создаем js массив
		echo json_encode($street);
	}	
}