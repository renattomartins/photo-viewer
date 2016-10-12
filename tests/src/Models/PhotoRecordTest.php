<?php

namespace Models;

use Tests\TestCase;
use Core\FileNotFoundException;

/**
 * Classe PhotoRecordTest.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
class PhotoRecordTest extends TestCase
{
    private $fileName;

    /**
     * Executado antes de cada teste unitário.
     */
    public function setUp()
    {
        parent::setUp();

        // Simula arquivo base para ser usado no construtor do PhotoRecord
        $this->fileName = 'tdd'.rand().'jpg';
        copy('tests/uploads/photos/tdd.jpg', PhotoRecord::PHOTOS_DIRECTORY.$this->fileName);
    }

    /**
     * Executado após a execução de cada um dos testes unitários.
     */
    public function tearDown()
    {
        parent::tearDown();

        // Remove arquivo
        unlink(PhotoRecord::PHOTOS_DIRECTORY.$this->fileName);
    }

    /**
     * Testa se o construtor está funcionando corretamente.
     */
    public function testIfConstructIsWorking()
    {
        // Instanciando um PhotoRecord
        $photoRecord = new PhotoRecord($this->fileName);
        $this->assertInstanceOf('Models\PhotoRecord', $photoRecord);

        // Instanciando um PhotoRecord com arquivo não existente
        $this->expectException(FileNotFoundException::class);
        new PhotoRecord('arquivo_nao_existente.jpg');
    }

    /**
     * Testa os métodos 'get__'.
     */
    public function testGetters()
    {
        // Instanciando um PhotoRecord
        $photoRecord = new PhotoRecord($this->fileName);

        $this->assertEquals(0, $photoRecord->getId());
        $this->assertEquals($this->fileName, $photoRecord->getName());
        $this->assertEquals("Id: 0, Name: {$this->fileName}", $photoRecord->toString());
    }
}
