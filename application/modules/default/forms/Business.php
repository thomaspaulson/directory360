<?php
class Default_Form_Business extends Zend_Form{
	
	public function  init(){
		$this->setName('Business');
		$id = new Zend_Form_Element_Hidden('ID');
		$id->addFilter('Int');
		
		$name = new Zend_Form_Element_Text('Name');
		$name->setLabel('Name')
		->setOptions(array('class'=>'text'))
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
		
		$description = new Zend_Form_Element_TextArea('Description');
		$description->setLabel('Name')
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
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
		$this->addElements(array($id, $name, $description,$status, $submit));
		
	} 
}