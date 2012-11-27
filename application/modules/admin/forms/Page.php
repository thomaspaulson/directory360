<?php
class Admin_Form_Page extends Zend_Form
{
	public function init()
	{
		// initialize form
		$this->setAction('')
		->setAttribs(array(
		'class' => 'form',
		'id' => 'Page'
		))
		->setMethod('post');
		
		$id = new Zend_Form_Element_Hidden('ID');
		$id->addFilter('Int');
		
		// create text input for title 
		$title = new Zend_Form_Element_Text('Title');
		$title->setLabel('Title:')
		->setOptions(array('size' => '35'));
		$title->setRequired(true);

		// create text input for title 
		$url = new Zend_Form_Element_Text('URL');
		$url->setLabel('url:')
		->setOptions(array('size' => '35'));
		//$url->setRequired(true);

		$content = new Zend_Form_Element_TextArea('Content');
		$content->setLabel('Content')
		->setOptions(array('rows' => '15','cols' => '60'))
		//->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		// create checkbox for Status
		$status = new Zend_Form_Element_Select('Status');
		$status->setLabel('Status:')
		->setRequired(true)
		->setMultiOptions(array(
		'' => 'select',
		'1' => 'Publish',
		'0' => 'Draft',
		));				
		$status->setValue(0);		
		
		
		// attach elements to form
		
		$this->addElement($id)
		->addElement($title)
		->addElement($url)
		->addElement($content)
		->addElement($status);	
		
		
		// add display group
		$this->addDisplayGroup(array('ID', 'Title', 'URL', 'Content','Status'), 'PageContent'	);
		
		$this->getDisplayGroup('PageContent')
		->setLegend('Content');
		
		// add display group
		
		//$this->addDisplayGroup(array('ID','Title', 'URL', 'Content', 'Status' ), 'Content');
		
		//$this->getDisplayGroup('Content')
		//->setLegend('Content');
		
		
		// create text input for title 
		$metaTitle = new Zend_Form_Element_Text('MetaTitle');
		$metaTitle->setLabel('Title:')
		->setOptions(array('size' => '35'));
		

		$metaKeywords = new Zend_Form_Element_TextArea('MetaKeywords');
		$metaKeywords->setLabel('Meta Keywords')
		->setOptions(array('rows' => '15','cols' => '60'))
		//->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$metaDescription = new Zend_Form_Element_TextArea('MetaDescription');
		$metaDescription->setLabel('Meta Description')
		->setOptions(array('rows' => '15','cols' => '60'))
		//->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		// attach elements to form
		$this->addElement($metaTitle)
		->addElement($metaKeywords)
		->addElement($metaDescription);	
		

		// add display group
		$this->addDisplayGroup(array('MetaTitle', 'MetaKeywords', 'MetaDescription'), 'MetaData'	);
		
		$this->getDisplayGroup('MetaData')
		->setLegend('MetaData')
		->setOptions(array('class'=>'coolfieldset'));
		
		
		
		// create submit button
		$submit = new Zend_Form_Element_Submit('submit', array(
		'label' => 'Submit',
		'class' => 'submit'
		));
		
		$this->addElement($submit);
		
		
	}
	
}