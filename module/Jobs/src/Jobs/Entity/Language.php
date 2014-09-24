<?php
namespace Jobs\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Implement a Language entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="languages")
 * @package Jobs\Entity
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


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


}