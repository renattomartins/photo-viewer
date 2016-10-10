<?php

require 'src/Components/FileUploader/UploadedFile.php';
require 'src/Components/FileUploader/UploadedFileException.php';
require 'src/Components/FileUploader/UploadedPhoto.php';
require 'src/Core/FileNotFoundException.php';
require 'src/Models/ActiveRecord.php';
require 'src/Models/Photo.php';

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

// Trata superglobal $_POST
// print_r($_POST);
// echo '<br>';
// <code here>

// Trata superglobal $_GET
// print_r($_GET);
// echo '<br>';
// <code here>

if (isset($inputName)) {
    try {
        $uploadedPhoto = new Components\FileUploader\UploadedPhoto($inputName, $file, Models\Photo::PHOTOS_DIRECTORY);

        // Tentar salvar o arquivo recebido na pasta adequada do servidor
        if ($uploadedPhoto->save()) {
            // Cria objeto de negócio Photo com base no arquivo recebido
            $photo = new Models\Photo($uploadedPhoto->getName());
            echo '<br>' . $photo->toString();
            // Tenta persistir o objeto de negócio
            if ($photo->store()) {
                // Adiciona mensagem de sucesso
                echo '<br>Arquivo salvo!';
                echo '<br>' . $photo->toString();
            } else {
                // Adciona mensagem de erro
                // Apaga arquivo da pasta de upload
            }
        } else {
            // Adiciona mensagem de erro
            // code... print_r($uploadedPhoto->getErrors());
        }
    } catch (Components\FileUploader\UploadedFileException $e) {
        // Adiciona mensagem de erro
        // code... echo 'Primeira: '.$e->getMessage();
    } catch (Core\FileNotFoundException $e) {
        // Adiciona mensagem de erro
        // code... echo 'Segunda: '.$e->getMessage();
    } catch (Exception $e) {
        // Adiciona mensagem de erro
        // code... echo 'Padrão: '.$e->getMessage();
    }
}

// Redirecina para a tela inicial de visualização de fotos
// header('Location: view.php', true, 302);
// exit();
