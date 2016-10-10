<?php

namespace Models;

use PDO;

/**
 * Classe PhotoRepository.
 *
 * A classe PhotoRepository atua como um gerenciador de coleções
 * de objetos do tipo Photo.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
class PhotoRepository
{
    /**
     * Carrega uma coleção de fotos (relacionada aos objetos Photo).
     *
     * @return Array Retorna uma coleção de fotos
     */
    public function load($criteria = null, $order = 'id ASC', $limit = null)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=praticaltests_photoviewer', 'root', 'root');

        // Monta a query
        $query = 'SELECT `id`, `name` FROM photos ';
        if (isset($criteria)) {
            $query .= 'WHERE '.addslashes($criteria);
        }
        if (isset($order)) {
            $query .= ' ORDER BY '.addslashes($order);
        }
        if (isset($limit)) {
            $query .= ' LIMIT '.addslashes($limit);
        }

        // Executa e retorna coleção de resultados
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retorna a quantidade de objetos selecionados, segundo os critérios.
     *
     * @return int Quantidade de objetos persistidos segundo critérios.
     */
    public function count($criteria = null)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=praticaltests_photoviewer', 'root', 'root');

        // Monta a query
        $query = 'SELECT count(id) FROM photos ';
        if (isset($criteria)) {
            $query .= 'WHERE '.addslashes($criteria);
        }

        // Executa e retorna quantidade de registros selecionados
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }
}
