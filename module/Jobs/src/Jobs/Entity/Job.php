<?php
namespace Jobs\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Implement a Job entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="jobs")
 * @package Jobs\Entity
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
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
     * @var Department
     * @ORM\ManyToOne(targetEntity="Department")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     */
    protected $department;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Translation", mappedBy="job")
     **/
    protected $translations;

    /**
     * new ArrayCollection
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get Department of this job
     *
     * @return Department
     */
    public function getDepartment()
    {

        return $this->department;
    }

    /**
     * @param Department $department
     */
    public function setDepartment(Department $department)
    {
        $this->department = $department;
    }

    /**
     * Get translation by slug.
     *
     * @param string $language
     * @return Translation
     */
    public function getTranslation($language)
    {
        $default_language = 'en';

        $translations = $this->translations->filter(
            function ($translation) use ($language) {
                return in_array($translation->getLanguage()->getName(), array($language));
            }
        );

        $translation = $translations->first();

        if (!$translation && $language != $default_language):
            return $this->getTranslation($default_language);
        elseif ($translation):
            return $translation;
        else:
            return $this->getTranslations()->first();
        endif;


    }

    /**
     * Helper method, get all translations of this job
     *
     * @return ArrayCollection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param Translation $translation
     */
    public function addTranslation(Translation $translation)
    {
        $translation->setJob($this);
        $this->translations[] = $translation;
    }

}