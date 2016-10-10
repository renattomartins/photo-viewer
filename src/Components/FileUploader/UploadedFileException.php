<?php

namespace Components\FileUploader;

use Exception;

/**
 * Classe UploadedFileException.
 *
 * Essa classe tem a responsabilidade de gerenciar
 * os códigos de erro de um arquivo recebido do
 * client-side (UploadedFile object).
 *
 * A definição da classe UploadedFileException fazendo
 * parte do pacote FileUploader pode ser considerada um
 * exemplo prático da aplicação do princípio SRP (Single
 * Responsability Principle) do S.O.L.I.D. onde as mensagens
 * descritivas de erro não são o assunto principal da
 * da classe UploadedFile. Mantê-lo por lá faria com que
 * aquela classe tivesse mais de um motivo para ser
 * modificada.
 *
 * O próprio ato de estender a classe Exception do PHP
 * e poder substituí-la pela classe derivada UploadedFileException
 * em blocos try/catch sem problemas de abstração pode ser
 * considerado um exmplo prático de aplicação do princípio
 * LSP (Liskov Substitution Principle) do S.O.L.I.D.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 *
 * @link http://php.net/manual/pt_BR/features.file-upload.errors.php#89374
 */
class UploadedFileException extends Exception
{
    /**
     * Método Construtor da exceção.
     *
     * @param int $code Código do erro
     */
    public function __construct($code)
    {
        $msg = $this->codeToMessage($code);
        parent::__construct($msg, $code);
    }

    /**
     * Associa o código de erro a uma mensagem descritiva.
     *
     * @param  int    $code Código do erro.
     * @return string       Mensagem descritiva do erro (em PT-BR).
     */
    private function codeToMessage($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $msg = 'O arquivo enviado excede a directiva upload_max_filesize em php.ini';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $msg = 'O arquivo enviado excede a directiva MAX_FILE_SIZE que foi especificado no formulário HTML';
                break;
            case UPLOAD_ERR_PARTIAL:
                $msg = 'O arquivo enviado foi apenas parcialmente carregado';
                break;
            case UPLOAD_ERR_NO_FILE:
                $msg = 'Nenhum arquivo foi transferido';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $msg = 'Faltando uma pasta temporária';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $msg = 'Falha ao gravar arquivo em disco';
                break;
            case UPLOAD_ERR_EXTENSION:
                $msg = 'Uma extensão do PHP interrompeu o upload do arquivo.';
                break;

            default:
                $msg = 'Erro de upload desconhecido';
                break;
        }

        return $msg;
    }
}
