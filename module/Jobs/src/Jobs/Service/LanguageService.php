<?php
namespace Jobs\Service;

class LanguageService extends ServiceBaseAbstract
{
    /**
     * Test function for unit testing
     * @param $userId
     * @return string
     */
    public function getLanguageById( $languageId )
    {
        $language = $this->em->find('Application\Entity\Language',  $languageId );
        return $language;
    }
}