<?php

namespace Controllers;

use Models\PhotoRepository;
use Models\PhotoRecord;

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
    /**
     * Método construtor.
     */
    public function __construct($globals)
    {
        parent::__construct($globals);
    }

    /**
     * Action view - Coordena fluxo da ação para 'visualizar uma foto' da galeria.
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

        return compact(['photoRepository', 'totalPhotos', 'currentPhoto', 'prevPhoto', 'nextPhoto']);
    }
}
