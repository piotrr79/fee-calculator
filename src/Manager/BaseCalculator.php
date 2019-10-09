<?php
declare(strict_types=1);

namespace Fee\Calculator\Manager;

/**
 * Base Calculator - calculations pattern
 *
 * @package Fee Calculator
 */
class BaseCalculator
{
    /**
     * Fee calculation pattern
     *
     * @param int $term loan term
     * @param float $amount loan amount
     *
     * @return float $pattern
     */
    public function pattern($term, $amount): float
    {
        if ($term <= 12) {
            switch (true) {
                case $amount >= 1000 and $amount <= 2000:
                    // $factor = ($amount - min_amount) / (max - min_amount)
                    // $pattern = max_interest * (1 - $factor) + min_interest * $factor
                    $factor = ($amount - 1000) / (2000 - 1000);
                    $pattern = 0.05 * (1 - $factor) + 0.045 * $factor;
                    break;
                case $amount >= 2000 and $amount <= 3000:
                    $factor = ($amount - 2000) / (3000 - 2000);
                    $pattern = 0.045 * (1 - $factor) + 0.03 * $factor;
                    break;
                case $amount >= 3000 and $amount <= 4000:
                    $factor = ($amount - 3000) / (4000 - 3000);
                    $pattern = 0.03 * (1 - $factor) + 0.028 * $factor;
                    break;
                case $amount >= 4000 and $amount <= 5000:
                    $factor = ($amount - 4000) / (5000 - 4000);
                    $pattern = 0.028 * (1 - $factor) + 0.02 * $factor;
                    break;
                case $amount > 5000:
                    $pattern = 0.02;
                    break;
                default:
                    $pattern = 0.02;
                    break;
            }
        } else {
            switch (true) {
                case $amount >= 1000 and $amount <= 2000:
                    $factor = ($amount - 1000) / (2000 - 1000);
                    $pattern = 0.07 * (1 - $factor) + 0.05 * $factor;
                    break;
                case $amount >= 2000 and $amount <= 3000:
                    $factor = ($amount - 2000) / (3000 - 2000);
                    $pattern = 0.05 * (1 - $factor) + 0.04 * $factor;
                    break;
                case $amount > 3000:
                    $pattern = 0.04;
                    break;
                default:
                    $pattern = 0.04;
                    break;
            }
        }
        return $pattern;
    }

    /**
     * Round up fee
     *
     * @param float $amount loan term
     * @param float $fee loan amount
     *
     * @return float $fee
     */
    public function roundup($amount, $fee): float
    {
        $total = $amount + $fee;
        // Check if total is multiple of 5
        if (($total % 5) != 0) {
            // Round up total to exact multiple of 5
            $rounded =  ceil($total/5) * 5;
            // Extract fee
            $fee = $rounded - $amount;
        }

        // Let's be greedy a little and round up fee to two decimal places,
        // customer cannot pay a fraction of penny
        $fee = round($fee, 2);

        return $fee;
    }
}
