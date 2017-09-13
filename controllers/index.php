<?php
// контролер
Class Controller_Index Extends Controller_Base {
	
	// шаблон
	public $layouts = "main";
	
	// экшен 
	function index() {
		//доп скрипт для подключения в layaut
		$this->template->vars('js', ["js/routins.js"]);
		
		$id = 0;
		
		if (isset($_REQUEST['id'])) {
			$id = intval($_REQUEST['id']);
		}
		
		$where = "true";
		if ($id > 0 ) $where = "phonebook.id = $id";
		
		$sort = 'f, i, o';
		
		
		if (isset($_REQUEST['sort'])) {
			$sort = ($_REQUEST['sort']);
			switch ($sort) {
				case "fio": $sort = 'f, i, o'; break;
				case "phone": $sort = 'phone'; break;
				case "addres": $sort = 'town, street'; break;
				default: $sort = 'f, i, o';
			}
			
		}
		
		$select = array(
			'fields' => "phonebook.id As id, f, i, o, subyect, town, address.id AS addressid, street, birthday, phone",
			'join' => "INNER JOIN address ON phonebook.address_id = address.id ".
				      "INNER JOIN subyectrf ON address.subyect_id = subyectrf.id ", // условие объединения
			'where' => $where,
			'order' => $sort // сортируем
		);
		$model = new Model_Phonebook($select); // создаем объект модели
		
			
		if (isset($_REQUEST['ajax']))
		{
			$row = $model->getOneRow(); // получаем 
			echo json_encode($row); //создаем js массив
			
		} else {
			$phonebook = $model->getAllRows(); // получаем справочник телефонов
			
			$this->template->vars('phonebook', $phonebook);
			$this->template->view('index');
		}	
	}
	
	function del () {
		
		$id = 0;
		$row = false;
		
		if (isset($_REQUEST['id'])) {
			$id = intval($_REQUEST['id']);
			
			$model = new Model_Phonebook();
			$model->id = $id;
			
			$row = $model->deleteRow();
			
		}
		
		echo json_encode($row);
		
	}
	
	
	function insupd () {
	
		$id = 0;
		$row = false;
	
		if (isset($_REQUEST['id'])) {
			$id = intval($_REQUEST['id']);
				
			$model = new Model_Phonebook();
			
			$model->f = strip_tags($_REQUEST['f']);
			$model->i = strip_tags($_REQUEST['i']);
			$model->o = strip_tags($_REQUEST['o']);
			$model->birthday = strip_tags($_REQUEST['birthday']);
			$model->phone = strip_tags($_REQUEST['phone']);
			$model->address_id = strip_tags($_REQUEST['address_id']);
			
			if ($id == 0) 
				$row = $model->save();
			else {
				$model->id = $id;
				$row = $model->update();
			}
			
			//$row = $model->deleteRow();
				
		}
		
		if ($row)
			echo json_encode($model->getFields());
	
	}
	
}