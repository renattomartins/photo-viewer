<?php

namespace Controllers;

/**
 * Classe Control.
 *
 * As classes do tipo Control são responsáveis por coordenar o fluxo
 * de execução das requisições recebidas pela aplicação.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
abstract class Control
{
    protected $get;
    protected $post;
    protected $files;

    /**
     * Método construtor.
     */
    public function __construct($globals)
    {
        $this->get = $globals['get'];
        $this->post = $globals['post'];
        $this->files = $globals['files'];

        // Retira parâmetros de controle de fluxo dos dados vindo na query string
        if (isset($this->get['class'])) {
            unset($this->get['class']);
        }
        if (isset($this->get['action'])) {
            unset($this->get['action']);
        }
    }
}
