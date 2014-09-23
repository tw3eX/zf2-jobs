<?php
namespace Jobs\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Implement a Translation entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="translations")
 *
 * @author Valeriy Zakharov <tw3exa@gmail.com>
 */
class Translation
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     **/
    protected $language;

    /**
     * @ORM\ManyToOne(targetEntity="Job", inversedBy="translations")
     * @ORM\JoinColumn(name="job_id", referencedColumnName="id")
     **/
    private $job;

}