<?php
namespace Jobs\Service;

/**
 * Class TranslationService
 *
 * @package Jobs\Service
 * @author  Valeriy Zakharov <tw3exa@gmail.com>
 */
class TranslationService extends ServiceBaseAbstract
{

    /**
     * Get by id function for unit testing
     *
     * @param int $translationId
     * @return \Jobs\Entity\Translation
     */
    public function getTranslationById( $translationId )
    {
        $translation = $this->em->find('Application\Entity\Translation',  $translationId );
        return $translation;
    }

}