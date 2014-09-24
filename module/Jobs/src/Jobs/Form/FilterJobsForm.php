<?php
namespace Jobs\Form;

use Zend\Form\Element\Select;
use Zend\Form\Form;

/**
 * Class FilterJobsForm
 * @package Jobs\Form
 */
class FilterJobsForm extends Form
{
    /**
     * @param \Doctrine\ORM\EntityManager $departments
     * @param \Doctrine\ORM\EntityManager $languages
     */
    public function __construct($departments, $languages)
    {
        parent::__construct('Department');
        $this->setAttribute('method', 'post');

        $select = new  Select('departments');
        $select->setAttribute('class', 'form-control');

        $departments_array = array(null => '-- empty --');
        foreach ($departments as $department) {
            $departments_array[$department->getId()] = $department->getName();
        }
        $select->setValueOptions($departments_array);
        $this->add($select);

        $select = new  Select('languages');
        $select->setAttribute('class', 'form-control');
        $languages_array = array(null => '-- empty --');
        foreach ($languages as $language) {
            $languages_array[$language->getName()] = $language->getName();
        }
        $select->setValueOptions($languages_array);
        $this->add($select);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Apply filter',
                'id' => 'submitbutton',
                'class' => 'btn btn-primary',
            ),
        ));
    }

}