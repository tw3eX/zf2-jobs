<?php
// module/Jobs/src/Jobs/Controller/JobsController.php:
namespace Jobs\Controller;
ini_set('display_errors', true);
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Jobs\Form\FilterJobsForm;

class JobsController extends AbstractActionController
{

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

        if($request->getPost()->departments){
            $jobs = $jobs->findByDepartment($request->getPost()->departments);
        }else{
            $jobs = $jobs->findAll();
        }

        if($request->getPost()->languages){
            $language = $request->getPost()->languages;
        }else{
            $language = 'en';
        }

        $form = new FilterJobsForm($departments, $languages);
        $form->setData($request->getPost());

        $view = new ViewModel(array(
            'jobs' => $jobs,
            'departments' => $departments,
            'filter_form' => $form,
            'language' =>$language
        ));

        return $view;
    }
    
}