<?php

namespace Components\FileUploader;

/**
 * Classe UploadedFile.
 *
 * Essa classe tem a responsabilidade de gerenciar
 * um arquivo recebido do client-side, ou seja, vindo
 * de um upload.
 *
 * UploadedFile é uma classe abstrada e seu projeto tem
 * como principal característica a aplicação do princípio
 * OCP (Open-Closed Principle) do S.O.L.I.D.. A ideia é
 * que seja possível estender essa classe abstrata para
 * gerenciar diferentes tipos de arquivos recebidos ou
 * com configurações de valições específicas.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
abstract class UploadedFile
{
    // Atributos padrão de arquivos vindos de upload no PHP
    protected $name;
    protected $type;
    protected $tmpName;
    protected $error;
    protected $size;

    // Abributos para gerenciar o arquivo recebido
    protected $targetDir;
    protected $targetFile;
    protected $fileName;
    protected $extension;
    protected $isMoved;

    // Abributos pré-definidos para validar o arquivo recebido
    protected $maxAllowedSize = 5000000; // ~4.76 MB
    protected $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'txt', 'pdf', 'xls', 'xlsx'];

    /**
     * Método Construtor.
     *
     * @param array  $fileInfo  Array previamente formatado pelo PHP (ie. o conteúdo em global $_FILES[fieldName])
     * @param string $targetDir Diretório de destino final do arquivo
     */
    public function __construct($fileInfo, $targetDir = 'uploads/')
    {
        // Verifica e trata possíveis erros de upload no arquivo
        $this->error = $fileInfo['error'];
        if ($this->error !== UPLOAD_ERR_OK) {
            // Arremessa exceção
            throw new UploadedFileException($this->error);
        }

        // Continua com processo de construção do objeto
        $this->name = $fileInfo['name'];
        $this->type = $fileInfo['type'];
        $this->tmpName = $fileInfo['tmp_name'];
        $this->size = $fileInfo['size'];
        $this->targetDir = $targetDir;
        $this->targetFile = $this->targetDir.basename($this->name);
        $this->fileName = pathinfo($this->targetFile, PATHINFO_FILENAME);
        $this->extension = pathinfo($this->targetFile, PATHINFO_EXTENSION);
        $this->isMoved = false;
    }

    /**
     * Pega nome do arquivo.
     *
     * @return string Nome do arquivo
     */
    public function getName()
    {
        return $this->name;
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

    // Métodos abstratos
    abstract public function isValid();
    abstract public function isMoved();
    abstract public function save();
    abstract public function getErrors();
}
