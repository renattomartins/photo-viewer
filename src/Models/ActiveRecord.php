<?php

namespace Models;

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
