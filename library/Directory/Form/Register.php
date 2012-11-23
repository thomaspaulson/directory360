<?php
class Directory_Form_Register extends Zend_Form
{
	public function init()
	{
	
		// 	initialize form
	
		$view = Zend_Layout::getMvcInstance()->getView();
		
		$this->setAction($view->baseUrl().'/user/register')
		->setMethod('post');
		//$this->setOptions(array('class'=>'inline'));
		
		// create text input for fist name 
		$firstName = new Zend_Form_Element_Text('FirstName');
		$firstName->setLabel('First name:')
		->setOptions(array('size' => '30'))
		->setRequired(true)
		->addFilter('HtmlEntities')
		->addFilter('StringTrim');

		// create text input for last name 
		$lastName = new Zend_Form_Element_Text('LastName');
		$lastName->setLabel('Last name:')
		->setOptions(array('size' => '30'))
		->addFilter('HtmlEntities')
		->addFilter('StringTrim');
		
		
		// create text input for name 
		$email = new Zend_Form_Element_Text('Email');
		$email->setLabel('Email:')
		->setOptions(array('size' => '30'))
		->setRequired(true)
		->addValidator("EmailAddress")
		->addFilter('StringTrim');
		
		$redirect = new Zend_Form_Element_Hidden('Redirect');
		$redirect->addFilter('StringTrim');
		
        $validator = new Zend_Validate_Db_NoRecordExists(
	 	   array(
	        'table' => 'user',
	        'field' => 'Email',
			));
		
		
			
		$validator->setMessage('Email already exists.', Zend_Validate_Db_Abstract::ERROR_RECORD_FOUND);
		
		$email->addValidator($validator);
		
		
		// create text input for Password
		$password = new Zend_Form_Element_Password('Password');
		$password->setLabel('Password:')
		->setOptions(array('size' => '30','class'=>'title'))
		->setRequired(true)
		//->addFilter('HtmlEntities')
		->addFilter('StringTrim');
		
		$password->addValidator(new My_Validate_PasswordConfirmation());

		// create text input for confirm_Password
		$confirmPassword = new Zend_Form_Element_Password('ConfirmPassword');
		$confirmPassword->setLabel('Confirm Password:')
		->setOptions(array('size' => '30','class'=>'title'))
		->setRequired(true)
		//->addFilter('HtmlEntities')
		->addFilter('StringTrim');
		
		/*
		// create captcha
		$captcha = new Zend_Form_Element_Captcha('captcha', array(
		'captcha' => array(
		'captcha' => 'Image',
		'wordLen' => 6,
		'timeout' => 300,
		'width' => 300,
		'height' => 100,		
		'imgUrl' => '/captcha',
		'imgDir' => APPLICATION_PATH . '/../public/captcha',
		'font' => APPLICATION_PATH .'/../public/fonts/LiberationSansRegular.ttf',		
		)
		));
		$captcha->setLabel('Verification code:');
			*/
		
		// create submit button
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Register')
		->setOptions(array('class' => 'submit'));
		
		// attach elements to form		
		$this->addElement($firstName)
		//->addElement($lastName)
		->addElement($email)
		//->addElement($password)
		//->addElement($confirmPassword)
		//->addElement($captcha)
		->addElement($submit)
		->addElement($redirect);
	}
}



    class My_Validate_PasswordConfirmation extends Zend_Validate_Abstract
    {
        const NOT_MATCH = 'notMatch';
     
        protected $_messageTemplates = array(
            self::NOT_MATCH => 'Password confirmation does not match'
        );
     
        public function isValid($value, $context = null)
        {
            $value = (string) $value;
            $this->_setValue($value);
     
            if (is_array($context)) {
            	  if (isset($context['ConfirmPassword'])
                    && ($value == $context['ConfirmPassword']))
                {
                    return true;
                }
            } elseif (is_string($context) && ($value == $context)) {
                return true;
            }
     
            $this->_error(self::NOT_MATCH);
            return false;
        }
    }

