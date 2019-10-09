<?php
declare(strict_types=1);

namespace Fee\Calculator\Tests;

use Fee\Calculator\Tests\BaseTest;
use Fee\Calculator\Model\LoanApplication;

 /**
  * FeeCalculatorManagerTest - run with: `./vendor/bin/phpunit tests/FeeCalculatorManagerTest`
  * or `./vendor/bin/phpunit tests/FeeCalculatorManagerTest --debug`
  * @package Fee Calculator
  */
class FeeCalculatorManagerTest extends BaseTest
{

    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Test case one - 12 months, 3000
     */
    public function testCalculateCaseOne(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(12, 3000);
        $testClass = $fcm->calculate($application);
        $this->assertEquals(90.0, $testClass);
    }

    /**
     * Test case two - 12 months, 1000
     */
    public function testCalculateCaseTwo(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(12, 1000);
        $testClass = $fcm->calculate($application);
        $this->assertEquals(50.0, $testClass);
    }

    /**
     * Test case three - 12 months, 20000
     */
    public function testCalculateCaseThree(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(12, 20000);
        $testClass = $fcm->calculate($application);
        $this->assertEquals(400.0, $testClass);
    }

    /**
     * Test case four - 24 months, 1000
     */
    public function testCalculateCaseFour(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(24, 1000);
        $testClass = $fcm->calculate($application);
        $this->assertEquals(70.0, $testClass);
    }

    /**
     * Test case fife - 24 months, 1000
     */
    public function testCalculateCaseFife(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(24, 2000);
        $testClass = $fcm->calculate($application);
        $this->assertEquals(100.0, $testClass);
    }

    /**
     * Test case six - 24 months, 20000
     */
    public function testCalculateCaseSix(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(24, 20000);
        $testClass = $fcm->calculate($application);
        $this->assertEquals(800.0, $testClass);
    }

    /**
     * Test case seven - 26 months, 20000. Exception test
     */
    public function testCalculateCaseSeven(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(26, 20000);

        try {
            $message = $fcm->calculate($application);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        }
        $this->assertEquals('Max loan time is 24 months. Please correct value.', $message);
    }

    /**
     * Test case eight - 24 months, 20000. Exception test
     */
    public function testCalculateCaseEight(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(24, 22000);

        try {
            $message = $fcm->calculate($application);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        }
        $this->assertEquals('Max loan is 20000. Please correct value.', $message);
    }

    /**
     * Test case nine - 24 months, 900. Exception test
     */
    public function testCalculateCaseNine(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(24, 900);

        try {
            $message = $fcm->calculate($application);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        }
        $this->assertEquals('Min loan is 1000. Please correct value.', $message);
    }

    /**
     * Test case ten - 13 months, 1687. Exception test
     */
    public function testCalculateCaseTen(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(13, 1687);

        try {
            $message = $fcm->calculate($application);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        }
        $this->assertEquals('Loan time can be only 12 or 24 months. Please correct value.', $message);
    }

    /**
     * Test case eleven - 12 months, 1687
     */
    public function testCalculateCaseEleven(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(12, 1687);
        $testClass = $fcm->calculate($application);
        $this->assertEquals(78.56, $testClass);
    }

    /**
     * Test case twelve - 12 months, 1687.99
     */
    public function testCalculateCaseTwelve(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(12, 1687.99);
        $testClass = $fcm->calculate($application);
        $this->assertEquals(82.01, $testClass);
    }

    /**
     * Test case therteen - 24 months, 2500
     */
    public function testCalculateCaseTherteen(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(24, 2500);
        $testClass = $fcm->calculate($application);
        $this->assertEquals(115, $testClass);
    }

    /**
     * Test case fourteen - 24 months, 2357
     */
    public function testCalculateCaseFourteen(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(24, 2699);
        $testClass = $fcm->calculate($application);
        $this->assertEquals(116.08, $testClass);
    }

    /**
     * Test case fifteen - 24 months, 1687
     */
    public function testCalculateCaseFifteen(): void
    {
        $fcm = $this->getContainer();
        $application = new LoanApplication(24, 1687);
        $testClass = $fcm->calculate($application);
        $this->assertEquals(98, $testClass);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

}
