<?php

namespace Models;

use PDO;
use Exception;

/**
 * Classe Connection.
 *
 * Essa classe foi adaptada por mim (Renato Martins) para atender
 * as necessidades da aplicação Photo Viewer. A classe é resposável
 * por criar conexões com bancos de dados e implementa o padrão de
 * projeto Factory Method.
 *
 * @author    Pablo Dall'Oglio (do livro: PHP Orientado a Objetos, 3ª edição)
 * @adaptedBy Renato Martins <renatto.martins@gmail.com>
 */
final class Connection
{
    /**
     * Não podem existir instâncias de TConnection.
     */
    private function __construct()
    {
    }

    /**
     * Recebe o nome do conector de BD e instancia o objeto PDO. Esse
     * método é um Factory Method (GoF Design Patterns).
     */
    public static function open($name)
    {
        // verifica se existe arquivo de configuração para este banco de dados
        if (file_exists("src/Config/{$name}.ini")) {
            // lê o INI e retorna um array
            $dbDetails = parse_ini_file("src/Config/{$name}.ini");
        } else {
            // se não existir, lança um erro
            throw new Exception("Arquivo '$name' não encontrado");
        }

        // lê as informações contidas no arquivo
        $user = isset($dbDetails['user']) ? $dbDetails['user'] : null;
        $pass = isset($dbDetails['pass']) ? $dbDetails['pass'] : null;
        $name = isset($dbDetails['name']) ? $dbDetails['name'] : null;
        $host = isset($dbDetails['host']) ? $dbDetails['host'] : null;
        $type = isset($dbDetails['type']) ? $dbDetails['type'] : null;
        $port = isset($dbDetails['port']) ? $dbDetails['port'] : null;

        // descobre qual o tipo (driver) de banco de dados a ser utilizado
        switch ($type) {
            case 'pgsql':
                $port = $port ? $port : '5432';
                $conn = new PDO("pgsql:dbname={$name}; user={$user}; password={$pass};
                        host=$host;port={$port}");
                break;
            case 'mysql':
                $port = $port ? $port : '3306';
                $conn = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
                break;
            case 'sqlite':
                $conn = new PDO("sqlite:{$name}");
                break;
        }
        // define para que o PDO lance exceções na ocorrência de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}
