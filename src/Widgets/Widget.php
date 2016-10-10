<?php

namespace Widgets;

/**
 * Classe Widget.
 *
 * Widget é uma classe abstrata que serve de classe-base para todos os
 * elementos visuais que precisam ser renderizados na tela.
 *
 * @author Renato Martins <renatto.martins@gmai.com>
 */
abstract class Widget
{
    protected $output;

    /**
     * Imprime widget na tela.
     */
    public function render()
    {
        echo $this->output;
    }
}
