<?php
namespace Jobs\Service;

class DepartmentService extends ServiceBaseAbstract
{
    /**
     * Test function for unit testing
     * @param $userId
     * @return string
     */
    public function getDepartmentById( $departmentId )
    {

        $department = $this->em->find('Application\Entity\Department',  $departmentId );
        return $department;
    }
}