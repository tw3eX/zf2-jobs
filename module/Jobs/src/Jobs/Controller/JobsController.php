<?php
namespace Jobs\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Jobs\Form\FilterJobsForm;

/**
 * Class JobsController
 * @package Jobs\Controller
 */
class JobsController extends AbstractActionController
{

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $jobs = $objectManager
            ->getRepository('\Jobs\Entity\Job');

        $departments = $objectManager
            ->getRepository('\Jobs\Entity\Department')
            ->findAll();

        $languages = $objectManager
            ->getRepository('\Jobs\Entity\Language')
            ->findAll();

        $request = $this->getRequest();

        if($request->getPost()->departments):
            $jobs = $jobs->findByDepartment($request->getPost()->departments);
        else:
            $jobs = $jobs->findAll();
        endif;

        if($request->getPost()->languages):
            $language = $request->getPost()->languages;
        else:
            $language = 'en';
        endif;

        $form = new FilterJobsForm($departments, $languages);
        $form->setData($request->getPost());

        return new ViewModel(array(
            'jobs' => $jobs,
            'departments' => $departments,
            'filter_form' => $form,
            'language' =>$language
        ));
    }

}