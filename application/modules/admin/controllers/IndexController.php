<?php

class Admin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
	    if (!Zend_Auth::getInstance()->hasIdentity()) {
	    	//$url = $this->getRequest()->getHttpHost() . $this->view->url();
	    	$url = $this->view->url();	    	
			$this->_redirect('/user/login?Redirect='.$url);
		}    	
    	
		$this->_helper->layout->setLayout('admin');
    }

    public function indexAction()
    {
        // action body
        // fetch business listing
		$q = Doctrine_Query::create()
			->from('Directory_Model_Listing l')
			->leftJoin('l.Directory_Model_Page')
			->where('l.Directory_Model_Page.Controller = ?', array('business'))
			->orderBy('l.PageID DESC');
			
		$result = $q->fetchArray();
		$this->view->listings = $result;
		
        // fetch jobs				
		$q = Doctrine_Query::create()
			->from('Directory_Model_Jobs j')
			->leftJoin('j.Directory_Model_Page')
			->orderBy('j.PageID DESC');
			
		$result = $q->fetchArray();
		$this->view->jobs = $result;
		
		
    }


}

