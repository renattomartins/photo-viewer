<?php

namespace Models;

use PDO;
use Core\FileNotFoundException;

/**
 * Classe Photo.
 *
 * Um objeto da classe Photo representa uma 'foto' dentro do domínio de
 * negócios da aplicação Photo Viewer. Essa classe age como o padrão
 * de projeto ActiveRecord.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
class Photo
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
     * @return int ID do objeto de negócio Photo
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

        $stmt = $pdo->prepare('INSERT INTO photos(`name`) VALUES( ? )');
        if ($stmt->execute([$this->name])) {
            // Configura ID verdadeiro do objeto
            $this->id = $pdo->lastInsertId();

            return true;
        }

        return false;
    }
}
