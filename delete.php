<?php

// Requer o carregador automático de classes
require __DIR__.'/vendor/autoload.php';

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
