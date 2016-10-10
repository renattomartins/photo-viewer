<?php

require 'src/Core/FileNotFoundException.php';
require 'src/Models/Connection.php';
require 'src/Models/ActiveRecord.php';
require 'src/Models/Walkable.php';
require 'src/Models/PhotoRecord.php';

// Trata superglobal $_GET
// print_r($_GET);
// echo '<br>';

if (isset($_GET['id'])) {
    // Tenta recuperar a foto referente ao $id passado via URL
    if ($photo = Models\PhotoRecord::load($_GET['id'])) {
        echo '<br>' . $photo->toString();
        // Tenta excluir objeto
        if ($photo->delete()) {
            // Adiciona mensagem de sucesso
            echo '<br>Arquivo excluído!';
            echo '<br>' . $photo->toString();
        } else {
            // Adciona mensagem de erro
        }
    }
}


// Redirecina para a tela inicial de visualização de fotos
// header('Location: view.php', true, 302);
// exit();
