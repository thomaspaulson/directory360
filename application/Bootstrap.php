<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initDoctrine()
	{
		require_once 'Doctrine/Doctrine.php';
		$this->getApplication()
		->getAutoloader()
		->pushAutoloader(array('Doctrine', 'autoload'), 
		'Doctrine');
		$manager = Doctrine_Manager::getInstance();
		$manager->setAttribute(Doctrine::ATTR_MODEL_LOADING,Doctrine::MODEL_LOADING_CONSERVATIVE);
		$manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
		$config = $this->getOption('doctrine');
		$conn = Doctrine_Manager::connection($config['dsn'], 
		'doctrine');
		return $conn;
	}
	

}

