<?php

namespace Widgets\PhotoGallery;

use Widgets\Widget;
use Models\PhotoRecord;

/**
 * Classe GalleryPhoto.
 *
 * Essa classe é a representação principal da foto, onde além da imagem em si,
 * são renderizados marcações HTML que estruturam e posicionam a imagem dentro
 * galeria. Essa classe tem a responsabilidade única de renderizar essa
 * reprensentação de acordo com o estado do domínio.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
class GalleryPhoto extends Widget
{
    /**
     * Método construtor.
     *
     * @param $photo PhotoRecord Objeto PhotoRecord que será renderizado
     * @param $total int         Total de fotos da galeria
     */
    public function __construct(PhotoRecord $photo = null, $total)
    {
        // Preenche a saída
        $this->output = '<div class="gallery-photo-area">';

        // Se NÃO existe um PhotoRecord e o total de fotos da galeria é igual 0
        if (!isset($photo) && $total == 0) {
            $this->output .= '<div class="gallery-placeholder">';
            $this->output .= '<span class="gallery-placeholder-msg">';
            $this->output .= 'Você ainda não possui nenhuma foto cadastrada.';
            $this->output .= '</span>';
            $this->output .= '</div>';
        // Se NÃO existe um PhotoRecord e o total de fotos da galeria for maior que 0
        } elseif (!isset($photo) && $total > 0) {
            $this->output .= '<div class="gallery-placeholder">';
            $this->output .= '<span class="gallery-placeholder-msg">';
            $this->output .= '<strong class="gallery-placeholder-msg-strong">';
            $this->output .= 'A foto que você está tentando acessar, não existe!';
            $this->output .= '</strong> Tente voltar à ';
            $this->output .= '<a href="index.php?class=PhotosControl&action=view"'.
                             ' class="gallery-placeholder-link">página inicial</a> ';
            $this->output .= 'e começar novamente.';
            $this->output .= '</span>';
            $this->output .= '</div>';
        // Se existe um PhotoRecord
        } elseif (isset($photo)) {
            $this->output .= '<img src="'.
                             PhotoRecord::PHOTOS_DIRECTORY.$photo->getName().
                             '" class="gallery-photo">';
            $this->output .= '<form class="gallery-form-delete js-form-delete" method="post"'.
                             ' action="index.php?class=PhotosControl&action=delete&id='.$photo->getId().'">';
            $this->output .= '<input type="submit" class="gallery-form-delete-submit" value="Excluir foto">';
            $this->output .= '</form>';
        }
        $this->output .= '</div>';
    }
}
