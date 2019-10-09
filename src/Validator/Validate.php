<?php
declare(strict_types=1);

namespace Fee\Calculator\Validator;

/**
 * Validate - input validation
 *
 * @package Fee Calculator
 */
class Validate
{
    /**
     * Input value validation
     *
     * @param  int   $term
     * @param  float $amount
     * @throws \Exception
     */
    public function validate($term, $amount): void
    {

        $message = 'Please correct value.';

        if ($term < 12) {
            throw new \Exception('Min loan time is 12 months. '. $message);
        }

        if ($term > 24) {
            throw new \Exception('Max loan time is 24 months. '. $message);
        }

        if ($term > 12 and $term < 24) {
            throw new \Exception('Loan time can be only 12 or 24 months. '. $message);
        }

        if ($amount < 1000) {
            throw new \Exception('Min loan is 1000. '. $message);
        }

        if ($amount > 20000) {
            throw new \Exception('Max loan is 20000. '. $message);
        }

        if ($amount > 20000) {
            throw new \Exception('Max loan is 20000. '. $message);
        }

        if (round($amount, 2) != $amount) {
            throw new \Exception('You can choose loan amount up to two decinal places, not more. '. $message);
        }
    }
}
