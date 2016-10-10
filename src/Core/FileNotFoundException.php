<?php

namespace Core\FileNotFoundException;

use Exception;

/**
 * Classe FileNotFoundException.
 *
 * Exceção lançada quando um arquivo não pôde ser encontrado.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
class UploadedFileException extends Exception
{
    /**
     * Método Construtor da exceção.
     *
     * @param int $code Código do erro
     */
    public function __construct($msg = null, $code = 0, \Exception $previous = null)
    {
        if ($msg === null) {
            $msg = 'O arquivo não pôde ser encontrado.';
        }
        parent::__construct($msg, $code, $previous);
    }
}
