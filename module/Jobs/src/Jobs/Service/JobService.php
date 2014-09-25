<?php
namespace Jobs\Service;

/**
 * Class JobService
 *
 * @package Jobs\Service
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
class JobService extends ServiceBaseAbstract
{

    /**
     * Get by id function for unit testing
     *
     * @param int $jobId
     * @return \Jobs\Entity\Job
     */
    public function getJobById( $jobId )
    {
        $job = $this->em->find('Application\Entity\Job',  $jobId );
        return $job;
    }

}