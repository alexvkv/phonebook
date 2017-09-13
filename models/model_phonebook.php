<?php

Class Model_Phonebook Extends Model_Base {
	
	public $id;
	public $f;
	public $i;
	public $o;
	public $address_id;
	public $birthday;
	public $phone;
	
	public function fieldsTable(){
		return array(
			'id' => 'Id',
			'f' => 'familiya',
			'i' => 'imya',
			'o' => 'otchestvo',
			'address_id' => 'Id address',
			'birthday' => 'day of birth',
			'phone' => 'phone number'
		);
	}
	
}