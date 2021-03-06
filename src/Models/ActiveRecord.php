<?php

namespace Models;

/**
 * Interface ActiveRecord.
 *
 * Contrato que deve ser cumprido para classes que implementam
 * um ActiveRecord.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
interface ActiveRecord
{
    /**
     * Armazena/persisiste o objeto da memória no banco de dados.
     */
    public function store();

    /**
     * Exclui o objeto do banco de dados.
     */
    public function delete();

    /**
     * Carrega um objeto para a memória.
     */
    public static function load($id);
}
