<?php

/**
 * Directory_Model_Jobs
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Directory_Model_Jobs extends Directory_Model_BaseJobs
{

    public function setUp()
    {
        $this->hasOne('Directory_Model_Page', array(
            'local' => 'PageID',
            'foreign' => 'ID'
        ));                
	}
	
}