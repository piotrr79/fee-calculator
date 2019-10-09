<?php

namespace Fee\Calculator\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * BaseTest - Base Class for Unit Tests
 * @package Fee Calculator
 */
abstract class BaseTest extends TestCase
{
    /**
     * Set up test
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Get service fcm from DI Container
     * @return object
     */
    public function getContainer()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->register('fcm', '\Fee\Calculator\Manager\FeeCalculatorManager');
        $fcm = $containerBuilder->get('fcm');

        return $fcm;
    }

    /**
     * Tear down
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
