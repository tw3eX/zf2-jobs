<?php
namespace Jobs\Service;

/**
 * Class DepartmentService
 *
 * @package Jobs\Service
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
class DepartmentService extends ServiceBaseAbstract
{

    /**
     * Get by id function for unit testing
     *
     * @param int $departmentId
     * @return \Jobs\Entity\Department
     */
    public function getDepartmentById( $departmentId )
    {
        $department = $this->em->find('Application\Entity\Department',  $departmentId );
        return $department;
    }

}