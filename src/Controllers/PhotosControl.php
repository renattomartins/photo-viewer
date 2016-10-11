<?php

namespace Controllers;

use Models\PhotoRepository;
use Models\PhotoRecord;
use Components\Notifications\Notification;
use Components\FileUploader\UploadedPhoto;
use Components\FileUploader\UploadedFileException;
use Core\FileNotFoundException;

/**
 * Classe PhotosControl.
 *
 * Cada operação dessa classe representa uma ação (action) do usuário.
 * Logo, essa classe é responsável por coordenar o fluxo de execução da
 * aplicação, sendo que as ações dela atuam principalmente sobre o
 * objeto de negócio Photo.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
class PhotosControl extends Control
{
    protected $notifications;

    /**
     * Método construtor.
     */
    public function __construct($globals)
    {
        parent::__construct($globals);

        // Usa componente Notification
        $this->notifications = new Notification();

        // Seta template
        $this->setTemplate('gallery');
    }

    /**
     * Action view - Coordena fluxo da ação (action) para 'visualizar uma foto' da galeria.
     *
     * @return array Retorna um array com objetos e variáveis que serão consumidos pela view
     */
    public function view()
    {
        // Repositório de fotos
        $photoRepository = new PhotoRepository();
        $totalPhotos = $photoRepository->count();

        // Referências aos objetos PhotoRecord requisitados
        $currentPhoto = null;
        $prevPhoto = null;
        $nextPhoto = null;

        // Busca PhotoRecord corrente
        if (isset($this->get['id'])) {
            $currentPhoto = PhotoRecord::load($this->get['id']);
        } elseif ($firstPhoto = $photoRepository->load(null, 'id ASC', 1)) {
            $currentPhoto = PhotoRecord::load($firstPhoto[0]['id']);
        }

        // Busca foto anterior e posterior
        if (isset($currentPhoto)) {
            $prevPhoto = $currentPhoto->previous();
            $nextPhoto = $currentPhoto->next();
        }

        return compact(['totalPhotos', 'currentPhoto', 'prevPhoto', 'nextPhoto']);
    }

    /**
     * Action add - Coordena fluxo da ação (action) que 'cadastra nova foto' na galeria.
     */
    public function add()
    {
        // Pega detalhes do arquivo recebido
        if (count($this->files) == 1) {
            $fileInfo = reset($this->files);

            // Tenta salvar o arquivo no diretório adequado do servidor
            try {
                $uploadedPhoto = new UploadedPhoto($fileInfo, PhotoRecord::PHOTOS_DIRECTORY);
                if ($uploadedPhoto->save()) {
                    // Tenta persistir o objeto PhotoRecord no banco de dados
                    $photo = new PhotoRecord($uploadedPhoto->getName());
                    if ($photo->store()) {
                        // Se tudo ocorreu bem, redireciona usuário para página da foto recém-inserida
                        $this->notifications->addMessage(Notification::SUCCESS, 'Nova foto cadastrada com sucesso!');
                        $this->redirect('index.php?class=PhotosControl&action=view&id='.$photo->getId());
                    } else {
                        // Se não foi possível persistir objeto, descarta arquivo recebido e informa o usuário
                        unlink(PhotoRecord::PHOTOS_DIRECTORY.$uploadedPhoto->getName());
                        $this->notifications->addMessage(Notification::ERROR, 'Não foi possível salvar sua foto no banco de dados.');
                    }
                } else {
                    // Se não foi possível salvar o arquivo no diretório do servidor, informa erros ao usuário
                    $errors = $uploadedPhoto->getErrors();
                    foreach ($errors as $error) {
                        $this->notifications->addMessage(Notification::ERROR, $error);
                    }
                }
            } catch (UploadedFileException $e) {
                $this->notifications->addMessage(Notification::ERROR, $e->getMessage());
            } catch (FileNotFoundException $e) {
                $this->notifications->addMessage(Notification::ERROR, $e->getMessage());
            } catch (Exception $e) {
                $this->notifications->addMessage(Notification::ERROR, $e->getMessage());
            }
        }

        // Para uma melhor UX, em caso de erro, redireciona usuário para a mesma foto que ele estava
        $urlQueryString = isset($this->get['referedId']) ? '&id='.$this->get['referedId'] : '';
        $this->redirect('index.php?class=PhotosControl&action=view'.$urlQueryString);
    }

    /**
     * Action delete - Coordena fluxo da ação (action) que 'exclui uma foto' da galeria.
     */
    public function delete()
    {
        if (isset($this->get['id'])) {
            // Busca PhotoRecord corrente no banco de dados
            if ($photo = PhotoRecord::load($this->get['id'])) {
                // Tenta excluí-lo
                if ($photo->delete()) {
                    $this->notifications->addMessage(Notification::SUCCESS, 'Foto excluída com sucesso!');
                } else {
                    $this->notifications->addMessage(Notification::ERROR, 'Não foi possível excluir a foto do banco de dados.');
                }
            }
        }
        // Redireciona usuário para foto inicial da galeria
        $this->redirect('index.php?class=PhotosControl&action=view');
    }
}
