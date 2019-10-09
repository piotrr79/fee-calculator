<?php
declare(strict_types=1);

namespace Fee\Calculator\Manager;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Fee\Calculator\Manager\BaseCalculator;
use Fee\Calculator\Service\Fee\FeeCalculatorInterface;
use Fee\Calculator\Model\LoanApplication;
use Fee\Calculator\Validator\Validate;

/**
 * Calculation Manager
 *
 * @package Fee Calculator
 */
class FeeCalculatorManager extends BaseCalculator implements FeeCalculatorInterface
{
    /**
     * Get service Validate from DI Container
     *
     * @todo Add config yaml file to define and register services in config
     * @todo instead of registering them in code
     *
     * @return object
     */
    private function getContainer()
    {
        $validate = new Validate();
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->register('validator', $validate);
        $validator = $containerBuilder->get('validator');

        return $validator;
    }

    /**
     * Calculates the fee
     *
     * @param LoanApplication $application Loan Application
     *
     * @return float $result
     */
    public function calculate(LoanApplication $application): float
    {
        $validator = $this->getContainer();
        $term = $application->getTerm();
        $amount = $application->getAmount();
        $validator->validate($term, $amount);
        // Calculate interests rate
        $rate = $this->pattern($term, $amount);
        $fee = $amount * $rate;
        $result = $this->roundup($amount, $fee);

        return $result;
    }
}
