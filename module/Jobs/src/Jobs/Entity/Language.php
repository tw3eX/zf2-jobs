<?php
namespace Jobs\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Implement a Language entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="languages")
 *
 * @author Valeriy Zakharov <tw3exa@gmail.com>
 */
class Language
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
     * @ORM\Column(type="string", length=4, nullable=false)
     */
    protected $name;

}