<?php

namespace Models;

/**
 * Interface Repository.
 *
 * Contrato que deve ser cumprido para classes que implementam
 * um Repository.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
interface Repository
{
    /**
     * Carrega para a memória uma coleção de objetos persistidos.
     */
    public function load($criteria, $order, $limit);

    /**
     * Conta a quantidade de objetos selecionados, segundo os critérios.
     */
    public function count($criteria);
}
