<?php
namespace Jobs\Controller;

use Jobs\Form\FilterJobsForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class JobsController
 *
 * @package Jobs\Controller
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
class JobsController extends AbstractActionController
{

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        /** @var $jobs \Doctrine\ORM\EntityRepository */
        $jobs = $objectManager
            ->getRepository('\Jobs\Entity\Job');

        /** @var $departments \Doctrine\ORM\EntityManager */
        $departments = $objectManager
            ->getRepository('\Jobs\Entity\Department')
            ->findAll();

        /** @var $languages \Doctrine\ORM\EntityManager */
        $languages = $objectManager
            ->getRepository('\Jobs\Entity\Language')
            ->findAll();

        /** @var $request \Zend\Http\Request */
        $request = $this->getRequest();

        // filter by department
        if ($request->getPost()->departments) {
            $jobs = $jobs->findByDepartment($request->getPost()->departments);
        } else {
            $jobs = $jobs->findAll();
        }

        // filter by language
        if ($request->getPost()->languages) {
            $language = $request->getPost()->languages;
        } else {
            $language = 'en';
        }

        $form = new FilterJobsForm($departments, $languages);
        $form->setData($request->getPost());

        return new ViewModel(array(
            'jobs'        => $jobs,
            'departments' => $departments,
            'filter_form' => $form,
            'language'    => $language
        ));
    }

}