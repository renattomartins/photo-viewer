<?php

namespace Controllers;

use Tests\TestCase;
use Controllers\Controller;

class ControlTest extends TestCase
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
