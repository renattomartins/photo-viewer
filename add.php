<?php

// Requer o carregador automático de classes
require __DIR__.'/vendor/autoload.php';

function formatBytes($bytes, $precision = 2)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);

    return round($bytes, $precision).' '.$units[$pow];
}

// --- Análise, tratamento e encapsulamento das superglobais ---

// Para não usar as superglobais do PHP dentro de classes (o que não seria uma
// boa prática de desenvolvimento) elas são analisadas e colocadas em variáveis
// que são passadas para dentro das classes de Controller.

// Essa análise e tratamento dessas superglobais poderia ser feita no próprio
// Front Controller ou em uma classe de Dispatcher (que também poderia analisar,
// tratar e encapsular melhor outros aspectos do corpo e/ou cabeçalho da
// requisição). Mas para fins desse Teste de Codificação, optei por fazer um
// tratamento mais simples no arquivo de boostrap.

// ### Trata superglobal $_FILES
if (count($_FILES) == 1) {
    // Nome do input
    $inputName = array_keys($_FILES)[0];

    // Detalhes do arquivo recebido
    $file = $_FILES;
}

// ### Trata superglobal $_POST
// <code here>

// ### Trata superglobal $_GET
// <code here>

if (isset($inputName)) {
    try {
        $uploadedPhoto = new Components\FileUploader\UploadedPhoto($inputName, $file, Models\PhotoRecord::PHOTOS_DIRECTORY);

        // Tentar salvar o arquivo recebido na pasta adequada do servidor
        if ($uploadedPhoto->save()) {
            // Cria objeto de negócio PhotoRecord com base no arquivo recebido
            $photo = new Models\PhotoRecord($uploadedPhoto->getName());

            // Tenta persistir o objeto de negócio
            if ($photo->store()) {
                // Adiciona mensagem de sucesso
                Components\Notifications\Notification::addMessage(Components\Notifications\Notification::SUCCESS, 'Nova foto cadastrada com sucesso!');

                // Redirecina para visualizar a foto recém cadastrada
                header('Location: view.php?id='.$photo->getId(), true, 302);
                exit();
            } else {
                // Adciona mensagem de erro
                Components\Notifications\Notification::addMessage(Components\Notifications\Notification::ERROR, 'Não foi possível salvar sua foto no banco de dados. Tente novamente mais tarde.');

                // Apaga arquivo no servidor
                unlink(Models\PhotoRecord::PHOTOS_DIRECTORY.$uploadedPhoto->getName());
            }
        } else {
            // Adiciona mensagens de erro de validação do arquivo recebido
            $errors = $uploadedPhoto->getErrors();
            foreach ($errors as $message) {
                Components\Notifications\Notification::addMessage(Components\Notifications\Notification::ERROR, $message);
            }
        }
    } catch (Components\FileUploader\UploadedFileException $e) {
        Components\Notifications\Notification::addMessage(Components\Notifications\Notification::ERROR, $e->getMessage());
    } catch (Core\FileNotFoundException $e) {
        Components\Notifications\Notification::addMessage(Components\Notifications\Notification::ERROR, $e->getMessage());
    } catch (Exception $e) {
        Components\Notifications\Notification::addMessage(Components\Notifications\Notification::ERROR, $e->getMessage());
    }
}

// Redirecina para a tela inicial de visualização de fotos
header('Location: view.php', true, 302);
exit();
