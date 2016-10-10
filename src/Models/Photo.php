<?php

namespace Models;

use PDO;

/**
 * Classe Photo.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
class Photo
{
    private $id;
    private $name;

    public function __construct($name)
    {
        $this->id = 0;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function toString()
    {
        return "Id: {$this->id}, Name: {$this->name}";
    }

    public function addPhoto()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=praticaltests_photoviewer', 'root', 'root');

        $stmt = $pdo->prepare('INSERT INTO photos(`name`) VALUES( ? )');
        $stmt->execute([$this->name]);
        $this->id = $pdo->lastInsertId();

        return 'Foto cadastrada com sucesso!';
    }

    public function previous()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=praticaltests_photoviewer', 'root', 'root');
        $query = "SELECT `id`, `name` FROM photos WHERE `id` < {$this->id} ORDER BY `id` DESC LIMIT 1";
        foreach ($pdo->query($query, PDO::FETCH_ASSOC) as $photo) {
            print_r($photo);
        }

        // return 'Foto cadastrada com sucesso!';
    }

    public function next()
    {
        // select id,title from videos where id > $local_id order by id asc limit 1
    }
}
