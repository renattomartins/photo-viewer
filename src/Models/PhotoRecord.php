<?php

namespace Models;

use PDO;
use Core\FileNotFoundException;

/**
 * Classe PhotoRecord.
 *
 * Um objeto da classe PhotoRecord representa uma 'foto' dentro do domínio de
 * negócios da aplicação Photo Viewer. Essa classe age como o padrão
 * de projeto ActiveRecord.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
class PhotoRecord implements ActiveRecord, Walkable
{
    private $id;
    private $name;

    const PHOTOS_DIRECTORY = 'uploads/photos/';

    /**
     * Método Construtor.
     *
     * @param string $name Nome do arquivo da foto
     */
    public function __construct($name)
    {
        if (!file_exists(self::PHOTOS_DIRECTORY.$name)) {
            // Arremessa exceção
            throw new FileNotFoundException();
        }

        $this->id = 0;
        $this->name = $name;
    }

    /**
     * Pega ID da foto.
     *
     * @return int ID do objeto de negócio PhotoRecord
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Pega nome do arquivo da foto.
     *
     * @return string Retorna nome do arquivo da foto
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Converte o objeto para sua versão texto.
     *
     * @return string Versão texto do objeto
     */
    public function toString()
    {
        return "Id: {$this->id}, Name: {$this->name}";
    }

    /**
     * Persite objeto.
     *
     * @return bool True se objeto persistido com sucesso; False caso contrário
     */
    public function store()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=praticaltests_photoviewer', 'root', 'root');

        // Prepara e executa query
        $stmt = $pdo->prepare('INSERT INTO photos(`name`) VALUES( ? )');
        if ($stmt->execute([$this->name])) {
            // Inclui ID verdadeiro no objeto
            $this->id = $pdo->lastInsertId();

            return true;
        }

        return false;
    }

    /**
     * Exclui objeto.
     *
     * @return bool True se objeto excluído com sucesso; False caso contrário
     */
    public function delete()
    {
    }

    /**
     * Carrega um objeto para a memória.
     *
     * @return PhotoRecord|null Retorna um objeto PhotoRecord; Ou null, caso não exista o objeto $id
     */
    public static function load($id)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=praticaltests_photoviewer', 'root', 'root');

        // Prepara e executa query
        $stmt = $pdo->prepare('SELECT `id`, `name` FROM photos WHERE `id` = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Busca o resultado
        if ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {
                // Cria novo objeto
                $photo = new self($record['name']);

                // Ajusta ID verdadeiro do objeto
                $photo->id = $record['id'];

                return $photo;
            } catch (FileNotFoundException $e) {
            }
        }

        return null;
    }

    /**
     * Carrega para a memória o objeto anterior ao objeto atual.
     *
     * @return PhotoRecord|null Retorna um objeto PhotoRecord; Ou null, caso não exista objeto anterior ao atual
     */
    public function previous()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=praticaltests_photoviewer', 'root', 'root');

        // Prepara e executa query
        $stmt = $pdo->prepare('SELECT `id`, `name` FROM photos WHERE `id` < :id ORDER BY `id` DESC LIMIT 1');
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        // Busca o resultado
        if ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {
                // Cria novo objeto
                $photo = new self($record['name']);

                // Ajusta ID verdadeiro do objeto
                $photo->id = $record['id'];

                return $photo;
            } catch (FileNotFoundException $e) {
            }
        }

        return null;
    }

    /**
     * Carrega para a memória o objeto seguinte ao objeto atual.
     *
     * @return PhotoRecord|null Retorna um objeto PhotoRecord; Ou null, caso não exista objeto seguinte ao atual
     */
    public function next()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=praticaltests_photoviewer', 'root', 'root');

        // Prepara e executa query
        $stmt = $pdo->prepare('SELECT `id`, `name` FROM photos WHERE `id` > :id ORDER BY `id` ASC LIMIT 1');
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        // Busca o resultado
        if ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
            try {
                // Cria novo objeto
                $photo = new self($record['name']);

                // Ajusta ID verdadeiro do objeto
                $photo->id = $record['id'];

                return $photo;
            } catch (FileNotFoundException $e) {
            }
        }

        return null;
    }
}
