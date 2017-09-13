<?php

Class Model_Address Extends Model_Base {
	
	public $id;
	public $town;
	public $street;
	public $subyect_id;
	
	public function fieldsTable(){
		return array(
			
			'id' => 'Id street',
			'town' => 'town name',
			'street' => 'street_name',
			'subyect_id' => 'Id subyect RF',
		);
	}
	
}