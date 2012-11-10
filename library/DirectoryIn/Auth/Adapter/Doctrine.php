<?php

class DirectoryIn_Auth_Adapter_Doctrine implements Zend_Auth_Adapter_Interface
{
	// array containing authenticated user record
	protected $_resultArray;
	
	// constructor
	// accepts username and password
	public function __construct($username, $password)
	{
		$this->username = $username;
		$this->password = $password;
	}
	
	// main authentication method
	// queries database for match to authentication credentials
	// returns Zend_Auth_Result with success/failure code
	public function authenticate()
	{
		$q = Doctrine_Query::create()
		->from('DirectoryIn_Model_User u')
		->where('u.Email = ? AND u.Password = ?',
		array($this->username, $this->password)
		);
		$this->_resultArray = $q->fetchArray();
		if (count($this->_resultArray) == 1) {
			return new Zend_Auth_Result(
			Zend_Auth_Result::SUCCESS, $this->username, array());
		} else {
			return new Zend_Auth_Result(
			Zend_Auth_Result::FAILURE, null, 
			array('Authentication unsuccessful'));
		}
	}
	
	// returns result array representing authenticated user record
	// excludes specified user record fields as needed
	public function getResultArray($excludeFields = null)
	{
		//print_r($this->_resultArray);exit();
		if (!$this->_resultArray) {
			return false;
		} 
		$returnArray = array();
		if ($excludeFields != null) {
			$excludeFields = (array)$excludeFields;
			foreach ($this->_resultArray[0] as $key => $value) {
				//print($key);
				if (!in_array($key, $excludeFields)) {
				$returnArray[$key] = $value;
				}
			}
			return $returnArray;
		} else {
			return $this->_resultArray;
		}
		
	}
}	
