<?php
namespace Jobs\Form;

use Zend\Form\Element\Select;
use Zend\Form\Form;

/**
 * Class FilterJobsForm
 * @package Jobs\Form
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
class FilterJobsForm extends Form
{

    /**
     * @param \Doctrine\ORM\EntityManager $departments
     * @param \Doctrine\ORM\EntityManager $languages
     */
    public function __construct($departments, $languages)
    {
        parent::__construct('FilterForm');
        $this->setAttribute('method', 'post');

        $select = new  Select('departments');
        $select->setAttribute('class', 'form-control');

        $departments_array = array(null => '-- empty --');
        /** @var $department \Jobs\Entity\Department */
        foreach ($departments as $department) {
            $departments_array[$department->getId()] = $department->getName();
        }
        $select->setValueOptions($departments_array);
        $this->add($select);

        $select = new  Select('languages');
        $select->setAttribute('class', 'form-control');
        $languages_array = array(null => '-- empty --');
        /** @var $language \Jobs\Entity\Language */
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
                'class' => 'btn btn-primary',
            ),
        ));
    }

}