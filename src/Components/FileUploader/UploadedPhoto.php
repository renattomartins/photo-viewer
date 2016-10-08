<?php

namespace Components\FileUploader;

/**
 * Classe UploadedPhoto.
 *
 * Essa classe tem a responsabilidade de gerenciar
 * um arquivo de foto recebido do client-side, ou
 * seja, vindo de um upload. Essa classe estende
 * a classe abstrata UploadedFile.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
class UploadedPhoto extends UploadedFile
{
    /**
     * Método Construtor.
     *
     * @param string $inputName         Nome do campo de formulário do arquivo recebido
     * @param array  $fileUploadedArray Array previamente formatado pelo PHP (ie. global $_FILES)
     * @param string $targetDir         Diretório de destino final do arquivo
     */
    public function __construct($inputName, $fileUploadedArray, $targetDir = 'uploads/')
    {
        // Chama construtor da classe abstrata pai
        parent::__construct($inputName, $fileUploadedArray, $targetDir);

        // Tipos permitidos para upload de fotos
        $this->allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    }

    /**
     * Verifica se o arquivo é válido para UploadedPhoto.
     *
     * @return bool true se ok
     */
    public function isValid()
    {
        return $this->isImage() && !$this->isExistent() && $this->isAllowedSize() && $this->isAllowedFormat();
    }

    /**
     * Verifica se arquivo já foi movido para seu destino final.
     *
     * @return bool true se já foi movido
     */
    public function isMoved()
    {
        return $this->isMoved;
    }

    /**
     * Salva o arquivo permanentemente no servidor, movendo-o do diretório temporário
     * do PHP de arquivos recebidos para seu destino final (UploadedFile::$targetDir).
     *
     * @return bool true se arquivo foi salvo; false se não
     */
    public function save()
    {
        // Verifica se arquivo respeita todas as condições
        if (!$this->isMoved() && $this->isValid()) {
            // Tenta mover arquivo temporário para a pasta adequada
            return $this->isMoved = move_uploaded_file($this->tmpName, $this->targetFile);
        }

        return false;
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
        return array_search(strtolower($this->extension), $this->allowedTypes) !== false;
    }
}
