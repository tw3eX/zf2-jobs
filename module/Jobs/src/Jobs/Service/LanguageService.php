<?php
namespace Jobs\Service;

/**
 * Class LanguageService
 *
 * @package Jobs\Service
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
class LanguageService extends ServiceBaseAbstract
{

    /**
     * Get by id function for unit testing
     *
     * @param int $languageId
     * @return \Jobs\Entity\Language
     */
    public function getLanguageById( $languageId )
    {
        $language = $this->em->find('Application\Entity\Language',  $languageId );
        return $language;
    }

}