<?php
class Admin_Form_Listing extends Zend_Form
{
	public function init()
	{
		// initialize form
		$this->setAction('')
		->setAttribs(array(
		'class' => 'form',
		'id' => 'Business'
		))
		->setMethod('post');
		
		// create select input for item category
		$category = new Zend_Form_Element_Select('CategoryID');
		$category->setLabel('Category:')
		->setRequired(true)
		->addValidator('Int')
		->addFilter('HtmlEntities')
		->addFilter('StringTrim'); 
		foreach ($this->getCategories() as $c) {
		$category->addMultiOption($c['ID'], $c['Name']);
		}

		// create select input for item location
		$location = new Zend_Form_Element_Select('LocationID');
		$location->setLabel('Location:')
		->setRequired(true)
		->addValidator('Int')
		->addFilter('HtmlEntities')
		->addFilter('StringTrim'); 
		foreach ($this->getLocations() as $c) {
		$location->addMultiOption($c['ID'], $c['Name']);
		}
		
		$this->addElement($category);
		$this->addElement($location);
		
		$id = new Zend_Form_Element_Hidden('ID');
		$id->addFilter('Int');
		
		// create text input for title 
		$title = new Zend_Form_Element_Text('Title');
		$title->setLabel('Title:')
		->setOptions(array('size' => '35'));
		$title->setRequired(true);

		// create text input for url 
		$url = new Zend_Form_Element_Text('URL');
		$url->setLabel('URL:')
		->setOptions(array('size' => '35'));		
		
		$description = new Zend_Form_Element_TextArea('Content');
		$description->setLabel('Description')
		->setOptions(array('rows' => '15','cols' => '60'))
		//->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
		

		$shortDescription = new Zend_Form_Element_TextArea('ShortDesc');
		$shortDescription->setLabel('Short Description')
		->setOptions(array('rows' => '15','cols' => '60'))
		//->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		// create text input for Address 
		$address = new Zend_Form_Element_Text('Address');
		$address->setLabel('Address:')
		->setOptions(array('size' => '35'));
	
		// create text input for Address 
		$city = new Zend_Form_Element_Text('City');
		$city->setLabel('City:')
		->setOptions(array('size' => '35'));
		
		// create text input for Address 
		$district = new Zend_Form_Element_Text('District');
		$district->setLabel('District:')
		->setOptions(array('size' => '35'));
				
		
		// create text input for Address 
		$phone = new Zend_Form_Element_Text('Phone');
		$phone->setLabel('Phone:')
		->setOptions(array('size' => '35'));
		
		// create text input for Address 
		$email = new Zend_Form_Element_Text('Email');
		$email->setLabel('Email:')
		->setOptions(array('size' => '35'));
		
		// create text input for url 
		$websiteUrl = new Zend_Form_Element_Text('WebsiteURL');
		$websiteUrl->setLabel('Website URL:')
		->setOptions(array('size' => '35'));		
				
		// create text input for map 
		$map = new Zend_Form_Element_Text('Map');
		$map->setLabel('Map URL:')
		->setOptions(array('size' => '35'));		
		

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
		->addElement($description)
		->addElement($shortDescription)
		->addElement($address)
		->addElement($city)
		->addElement($district)
		->addElement($phone)
		->addElement($email)	
		->addElement($websiteUrl)
		->addElement($map)		
		->addElement($status);	
		
		
		// add display group
		$this->addDisplayGroup(
		array('ID', 'Title', 'URL', 'Content', 'ShortDesc','Address','City','District','Phone','Email','WebsiteURL','Map','Status')
		, 'PageContent'	);
		
		$this->getDisplayGroup('PageContent')
		->setLegend('Content');
		
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
	
	public function getCategories() {
		$q = Doctrine_Query::create()
		->from('Directory_Model_Category c')
		->where('c.Status = ?', array('1'))
		->orderBy('c.Name ASC');
		//echo  $q->getSQLQuery();
		return $q->fetchArray();
	}	
	
	public function getLocations() {
		$q = Doctrine_Query::create()
		->from('Directory_Model_Location l')
		->where('l.Status = ?', array('1'))
		->orderBy('l.Name ASC');
		//echo  $q->getSQLQuery();
		return $q->fetchArray();
	}	
	
}