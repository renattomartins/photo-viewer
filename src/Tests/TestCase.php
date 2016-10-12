<?php

namespace Tests;

use PHPUnit_Framework_TestCase as PHPUnit;

/**
 * Classe abstrata TestCase
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
abstract class TestCase extends PHPUnit
{
    /**
     * Executado antes de cada teste unitário.
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Executado após a execução de cada um dos testes unitários.
     */
    public function tearDown()
    {
        parent::tearDown();
    }
}
