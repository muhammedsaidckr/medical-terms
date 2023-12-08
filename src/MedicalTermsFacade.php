<?php

namespace Msc\MedicalTerms;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Msc\MedicalTerms\Skeleton\SkeletonClass
 */
class MedicalTermsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'medical-terms';
    }
}
