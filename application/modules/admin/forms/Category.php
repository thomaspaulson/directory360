<?php
class Admin_Form_Category extends Zend_Form
{

	public function init()
	{
		$this->setName('category');
		$id = new Zend_Form_Element_Hidden('ID');
		$id->addFilter('Int');
		
		$Name = new Zend_Form_Element_Text('Name');
		$Name->setLabel('Name')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
		Status
		
		$title = new Zend_Form_Element_Text('title');
		$title->setLabel('Title')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		$this->addElements(array($id, $Name, $title, $submit));
	}

}