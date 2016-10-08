<?php

namespace Components\FileUploader;

/**
 * Classe UploadedPhoto.
 *
 * Essa classe tem a responsabilidade de gerenciar
 * um arquivo recebido do client-side.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
class UploadedPhoto implements UploadedFile
{
    private $name;
    private $type;
    private $tmpName;
    private $error;
    private $size;
    private $targetDir;
    private $targetFile;
    private $uploadOk;
    private $fileName;
    private $extension;
    private $maxAllowedSize = 5000000; // ~4.76 MB
    private $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    /**
     * Método Construtor.
     */
    public function __construct($inputName, $fileUploadArray)
    {
        $this->name = $fileUploadArray[$inputName]['name'];
        $this->type = $fileUploadArray[$inputName]['type'];
        $this->tmpName = $fileUploadArray[$inputName]['tmp_name'];
        $this->error = $fileUploadArray[$inputName]['error'];
        $this->size = $fileUploadArray[$inputName]['size'];
        $this->targetDir = 'uploads/';
        $this->targetFile = $this->targetDir.basename($this->name);
        $this->uploadOk = true;
        $this->fileName = pathinfo($this->targetFile, PATHINFO_FILENAME);
        $this->extension = pathinfo($this->targetFile, PATHINFO_EXTENSION);
    }

    /**
     * Altera o diretório onde o arquivo é colocado.
     */
    public function setTargetDir($targetDir)
    {
        $this->targetDir = $targetDir;
        $this->targetFile = $this->targetDir.basename($this->name);
    }

    /**
     * Altera o tamanho máximo permitido para o arquivo.
     */
    public function setMaxAllowedSize($maxAllowedSize)
    {
        $this->maxAllowedSize = $maxAllowedSize;
    }

    /**
     * Testa se é uma imagem.
     *
     * @return bool True se é uma imagem
     */
    private function isImage()
    {
        // Se não for uma imagem, retorna false
        $check = getimagesize($this->tmpName);

        return $check !== false;
    }

    /**
     * Testa se o arquivo já existe no diretório de destino.
     *
     * @return bool True se o arquivo já é existente
     */
    private function isExistent()
    {
        return file_exists($this->targetFile);
    }

    /**
     * Testa se o tamanho do arquivo está dentro do permitido.
     *
     * @return bool True se o tamanho está ok
     */
    private function isAllowedSize()
    {
        return $this->size <= $this->maxAllowedSize;
    }

    /**
     * Testa se o formato do arquivo está na lista de formatos permitidos.
     *
     * @return bool True se o formato está ok
     */
    private function isAllowedFormat()
    {
        return (array_search(strtolower($this->extension), $this->allowedTypes) !== false);
    }

    /**
     * Verifica se arquivo é válido para UploadedPhoto.
     *
     * @return bool true se ok
     */
    public function isValid()
    {
        return $this->isImage() && !$this->isExistent() && $this->isAllowedSize() && $this->isAllowedFormat();
    }

    /**
     * Salva o arquivo no servidor.
     *
     * @return bool true se arquivo foi salvo; false se não
     */
    public function save()
    {
        // Verifica se arquivo respeita todas as condições
        if ($this->isValid()) {
            // Tenta mover arquivo temporário para a pasta adequada
            return move_uploaded_file($this->tmpName, $this->targetFile);
        }

        return false;
    }
}
