<?php
class DirectoryIn_Form_Example extends Zend_Form
{
public function init()
{
// initialize form
$this->setAction('/my/action')
->setAttribs(array(
'class' => 'form',
'id' => 'example'
))
->setMethod('post');
// create text input for title 
$title = new Zend_Form_Element_Text('title');
$title->setLabel('Title:')
->setOptions(array('size' => '35'));
// create submit button
$submit = new Zend_Form_Element_Submit('submit', array(
'label' => 'Submit',
'class' => 'submit'
));
// attach elements to form
$this->addElement($title)
->addElement($submit);
}
}