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

    public function getDepartment(){
        return $this->department;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTranslation($language)
    {
        $default_language = 'en';

        $translations = $this->translations->filter(function($translation) use ($language) {
             return in_array($translation->getLanguage(), array($language));
         });
        $translation = $translations->first();
        if(!$translation && $language != $default_language){
            return $this->getTranslation($default_language);
        }elseif($translation){
            return $translation;
        }else{
            return $this->getTranslations()->first();
        }

    }

    public function getTranslations()
    {
        return $this->translations;

    }

}