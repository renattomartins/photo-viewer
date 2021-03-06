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
     * Renderiza widget e retorna saída pronta para imprimir na tela.
     *
     * @return string Saída do widget pronta para ser impressa.
     */
    public function render()
    {
        return $this->output;
    }
}
