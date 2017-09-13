<?php

Class Model_Photo Extends Model_Base {
	
	public $id;
	public $subyect;
	
	public function fieldsTable(){
		return array(
			
			'id' => 'Id',
			'subeyct' => 'Id User',
		);
	}
	
}