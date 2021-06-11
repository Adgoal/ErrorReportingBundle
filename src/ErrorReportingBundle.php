<?php

declare(strict_types=1);

namespace AdgoalCommon\ErrorReportingBundle;

use AdgoalCommon\ErrorReportingBundle\DependencyInjection\ErrorReportingBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ErrorReportingBundle.
 *
 * @category AdgoalCommon\ErrorReportingBundle
 */
class ErrorReportingBundle extends Bundle
{
    /**
     * @return ErrorReportingBundleExtension
     */
    public function getContainerExtension(): ErrorReportingBundleExtension
    {
        return new ErrorReportingBundleExtension();
    }
}
