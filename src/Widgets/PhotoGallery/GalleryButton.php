<?php

namespace Widgets\PhotoGallery;

use Widgets\Widget;
use Models\PhotoRecord;

/**
 * Classe GalleryButton.
 *
 * Essa classe representa um botão de navegação de uma galeria de objetos
 * e tem a responsabilidade única de renderizar a reprensentação do botão
 * de acordo com o estado do domínio. A peça final gerada é um conjunto de
 * tags HTML com algumas classes que podem ser usadas tanto pelo CSS e
 * quanto por códigos JavaScript.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
final class GalleryButton extends Widget
{
    // Direções do botão
    const PREV = 1;
    const NEXT = 2;

    /**
     * Método construtor.
     *
     * @param $direction int         Direção do botão (1=Prev), (2=Next)
     * @param $photo     PhotoRecord Objeto PhotoRecord para o qual esse botão faz referência
     */
    public function __construct($direction = GalleryButton::PREV, PhotoRecord $photo = null)
    {
        // Se existe um PhotoRecord para o GalleryButton apontar
        if (isset($photo)) {
            $href = ' href="view.php?id='.$photo->getId().'"';
            $cssClass = '';

        // Se NÃO existe um PhotoRecord para o GalleryButton apontar
        } else {
            $href = '';
            $cssClass = ' is-disabled';
        }

        // Monta tag <a> para representar o botão
        if ($direction == GalleryButton::PREV) {
            $this->output =
            '<a'.$href.' class="gallery-link gallery-link-prev'.$cssClass.'"><span>Foto anterior</span></a>';
        } elseif ($direction == GalleryButton::NEXT) {
            $this->output =
            '<a'.$href.' class="gallery-link gallery-link-next'.$cssClass.'"><span>Foto seguinte</span></a>';
        }
    }
}
