<?php
namespace Jobs\Service;

class JobService extends ServiceBaseAbstract
{
    /**
     * Test function for unit testing
     * @param $userId
     * @return string
     */
    public function getJobById( $jobId )
    {
        $job = $this->em->find('Application\Entity\Job',  $jobId );
        return $job;
    }
}