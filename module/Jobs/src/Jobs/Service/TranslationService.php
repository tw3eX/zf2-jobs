<?php
namespace Jobs\Service;

class TranslationService extends ServiceBaseAbstract
{
    /**
     * Test function for unit testing
     * @param $translationId
     * @return string
     */
    public function getTranslationById( $translationId )
    {
        $translation = $this->em->find('Application\Entity\Translation',  $translationId );
        return $translation;
    }
}