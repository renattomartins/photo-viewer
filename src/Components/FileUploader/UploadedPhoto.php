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
        return !$this->hasUploadError() &&
               $this->isImage() &&
               !$this->isExistent() &&
               $this->isAllowedSize() &&
               $this->isAllowedFormat();
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
     * Pega erros de validação.
     *
     * @return array Retorna um array indexado numericamente com cada um dos erros de validação
     */
    public function getValidationErrors()
    {
        // ATENÇÃO:
        // Se não fosse apenas um teste de codificação (MaxMilhas) e se esse sistema fosse evoluir para
        // ter uma release 2 e evoluções no código, esse método teria que ser extraído e refatorado.
        // Não só esse método, mas, na verdade, cada uma funções privadas (isImage(), isExistent(), etc)
        // dessa classe poderiam se tornar uma espécie de objeto UploadedFileRule que implementaria
        // uma interface com os métodos UploadedFileRule::passed() e UploadedFileRule::getErrorMessage().
        // A classe UploadedFile poderia AGREGAR uma série de objetos UploadedFileRule e tudo ia ser
        // MUITO legal. Mas por enquanto, vamos deixar do jeito que está.

        $errors = [];

        // Foto já foi movida
        if ($this->isMoved()) {
            $errors[] = 'Essa foto já foi movida do local temporário para seu local permanentemente.';

            return $errors;
        }

        // Não é imagem
        if (!$this->isImage()) {
            $errors[] = 'A foto enviada não é uma imagem válida.';
        }

        // Nome de arquivo já utilizado
        if ($this->isExistent()) {
            $errors[] = "O nome \"{$this->name}\" já está sendo utilizado. ".
                        'Escolha outro nome e tente enviar a foto novamente.';
        }

        // Tamanho excede o máximo permitido
        if (!$this->isAllowedSize()) {
            $errors[] = 'O tamanho do arquivo ('.formatBytes($this->size).
                        ') excede o tamanho máximo permitido '.formatBytes($this->maxAllowedSize).'.';
        }

        // Formato não permitido
        if (!$this->isAllowedFormat()) {
            $errors[] = 'Extensão de arquivo não permitada. Extensões permitidas: '.
                        implode(', ', $this->allowedTypes).'.';
        }

        return $errors;
    }

    /**
     * Testa se é uma imagem.
     *
     * @return bool True se é uma imagem
     */
    private function isImage()
    {
        // Se não for uma imagem, retorna false
        $check = @getimagesize($this->tmpName);

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
