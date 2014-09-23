<?php
namespace Jobs\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Implement a Job entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="jobs")
 *
 * @author Valeriy Zakharov <tw3exa@gmail.com>
 */
class Job
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Department")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     */
    protected $department;

    /**
     * @ORM\OneToMany(targetEntity="Translation", mappedBy="job")
     **/
    private $translations;

    public function __construct() {
        $this->translations = new ArrayCollection();
    }

}