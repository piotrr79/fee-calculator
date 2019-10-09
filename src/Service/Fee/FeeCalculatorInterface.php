<?php

declare(strict_types=1);

namespace Fee\Calculator\Service\Fee;

use Fee\Calculator\Model\LoanApplication;

/**
 * Calculates fees for loan applications.
 */
interface FeeCalculatorInterface
{
    /**
     * Calculates the fee for a loan application.
     *
     * @param LoanApplication $application The loan application to
     *                                     calculate for.
     *
     * @return float The calculated fee.
     */
    public function calculate(LoanApplication $application): float;
}
