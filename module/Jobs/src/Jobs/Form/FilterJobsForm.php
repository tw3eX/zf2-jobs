<?php
namespace Jobs\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;
use Zend\Form\Element\Button;
class FilterJobsForm extends Form
{
    public function __construct($departments,$languages)
    {
        parent::__construct('Department');
        $this->setAttribute('method', 'post');

        $select = new  Select('departments');
        $select->setAttribute('class', 'form-control');
        $departments_array = array(null => 'Без фильтра');
        foreach($departments as $department){
            $departments_array[$department->getId()] = $department->getName();
        }
        $select->setValueOptions($departments_array);
        $this->add($select);

        $select = new  Select('languages');
        $select->setAttribute('class', 'form-control');
        $languages_array = array(null => 'Без фильтра');
        foreach($languages as $language){
            $languages_array[$language->getName()] = $language->getName();
        }
        $select->setValueOptions($languages_array);
        $this->add($select);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Применить фильтр',
                'id' => 'submitbutton',
                'class' => 'btn btn-primary',
            ),
        ));
    }

}