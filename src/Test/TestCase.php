<?php

namespace Test;

use PHPUnit_Framework_TestCase as PHPUnit;

/**
 * Classe abstrata TestCase
 */
abstract class TestCase extends PHPUnit
{
    /**
     * Executado antes de cada teste unitário.
     */
    public function setup()
    {
        parent::setup();
    }

    /**
     * Executado após a execução de cada um dos testes unitários.
     */
    public function tearDown()
    {
        parent::tearDown();
    }
}
