<?php
// module/Jobs/src/Jobs/Controller/JobsController.php:
namespace Jobs\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class JobsController extends AbstractActionController
{
    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $jobs = $objectManager
            ->getRepository('\Jobs\Entity\Job')
            ->findAll();

        $view = new ViewModel(array(
            'jobs' => $jobs,
        ));

        return $view;
    }

}