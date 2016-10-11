<?php

namespace Model;

use Test\TestCase;

class UserTest extends TestCase
{
    protected $entity;

    public function setUp()
    {
        $this->entity = 'Appliction\Model\Photo';
    }

    public function testIfIsSavingAsExpected()
    {
        // Criando os dados necessários para salvar o usuário
        // $photoData = ['id' => null, 'name' => 'foto1.jpg'];

        // Instanciando a entidade Photo definindo todos os atributos à ela
        // $photo = new Photo($photoData);

        // salvando o usuário no banco de dados
        // $this->getEntityManager()->persist($photo);
        // $this->getEntityManager()->flush();

        // Obtendo o usuário salvo
        // $registeredPhoto = $this->getEntityManager()
        //     ->getRepository($this->entity)
        //     ->findOneBy(array('id' => 2));

        // Garantindo que tudo funcionou conforme o esperado
        // $this->assertInstanceOf($this->entity, $registeredPhoto);
        // $this->assertEquals($photoData['name'], $registeredPhoto->getName());
    }
}
