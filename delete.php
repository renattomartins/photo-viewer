<?php

require 'src/Components/Notifications/Notification.php';
require 'src/Core/FileNotFoundException.php';
require 'src/Models/Connection.php';
require 'src/Models/ActiveRecord.php';
require 'src/Models/Walkable.php';
require 'src/Models/PhotoRecord.php';

// ### Trata superglobal $_GET
if (isset($_GET['id'])) {
    // Tenta recuperar a foto referente ao $id passado via URL
    if ($photo = Models\PhotoRecord::load($_GET['id'])) {
        // Tenta excluir objeto
        if ($photo->delete()) {
            // Adiciona mensagem de sucesso
            Components\Notifications\Notification::addMessage(Components\Notifications\Notification::SUCCESS, 'Foto excluída com sucesso!');
        } else {
            // Adciona mensagem de erro
            Components\Notifications\Notification::addMessage(Components\Notifications\Notification::ERROR, 'Não foi possível excluir a foto. Tente novamente mais tarde.');
        }
    }
}


// Redirecina para a tela inicial de visualização de fotos
header('Location: view.php', true, 302);
exit();
