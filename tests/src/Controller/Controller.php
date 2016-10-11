<?php

namespace Controller;

use Test\TestCase;
use Controller\Controller;

class ControllerTest extends TestCase
{
    public function testIfIsShowingCorrectController()
    {
        $controller = new Controller();
        $this->assertInstanceOf('Controller\Controller', $controller);

        // Tenta carregar uma classe
        $this->assertEquals(true, $controller->show(['class' => 'PhotosController', 'method' => 'add']));
        $this->assertEquals(false, $controller->show(['class' => 'PhotosController', 'method' => 'doesnotexist']));
    }
}
