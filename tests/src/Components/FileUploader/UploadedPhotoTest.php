<?php

namespace Components\FileUploader;

use Tests\TestCase;

/**
 * Classe UploadedPhoto.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
class UploadedPhotoTest extends TestCase
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

    /**
     * Testa se o construtor está funcionando corretamente.
     */
    public function testIfConstructIsWorking()
    {
        // Testa exceção de arquivo não enviado
        $fileInfo = ['name' => '', 'type' => '', 'size' => 0, 'tmp_name' => '','error' => 4];

        // Instanciando um UploadedPhoto sem arquivo enviado
        $this->expectException(UploadedFileException::class);
        new UploadedPhoto($fileInfo);
    }
}
