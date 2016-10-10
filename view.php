<?php

require 'src/Core/FileNotFoundException.php';
require 'src/Models/Connection.php';
require 'src/Models/ActiveRecord.php';
require 'src/Models/Walkable.php';
require 'src/Models/PhotoRecord.php';
require 'src/Models/Repository.php';
require 'src/Models/PhotoRepository.php';
require 'src/Widgets/Widget.php';
require 'src/Widgets/PhotoGallery/GalleryButton.php';
require 'src/Widgets/PhotoGallery/GalleryPhoto.php';

// Trata superglobal $_GET
// print_r($_GET);
// echo '<br>';

// Repositório de fotos
$photoRepository = new Models\PhotoRepository();
$totalPhotos = $photoRepository->count();

if (isset($_GET['id'])) {
    // Tenta recuperar a foto referente ao $id passado via URL
    $currentPhoto = Models\PhotoRecord::load($_GET['id']);
} else {
    // Tenta recuperar a primeira foto cadastrada
    if ($records = $photoRepository->load(null, 'id ASC', 1)) {
        $currentPhoto = Models\PhotoRecord::load($records[0]['id']);
    }
}
if ($currentPhoto) {
    // Tenta recuperar a foto anterior e posterior
    $prevPhoto = $currentPhoto->previous();
    $nextPhoto = $currentPhoto->next();
}

?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css">

        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
        <![endif]-->
    </head>
    <body>
        <div class="top-menu">
            <h1 class="top-menu-title"><a class="top-menu-title-link" href="index.php">Photo Viewer</a></h1>
            <a class="top-menu-item js-btn-add" href="#/add/">Cadastrar nova foto...</a>
        </div>

        <div class="content">
            <div class="gallery">
                <?php
                    // Botão de voltar para a foto anterior
                    $prevButton = new Widgets\PhotoGallery\GalleryButton(
                        Widgets\PhotoGallery\GalleryButton::PREV,
                        $prevPhoto
                    );
                    echo $prevButton->render();

                    // Foto principal
                    $galleryPhoto = new Widgets\PhotoGallery\GalleryPhoto($currentPhoto, $totalPhotos);
                    echo $galleryPhoto->render();

                    // Botão de avançar para a próxima foto
                    $nextButton = new Widgets\PhotoGallery\GalleryButton(
                        Widgets\PhotoGallery\GalleryButton::NEXT,
                        $nextPhoto
                    );
                    echo $nextButton->render();
                ?>
            </div>
            <div class="total-photos">Total de fotos cadastradas:
                <span class="total-photos-count"><?php echo $totalPhotos; ?></span>
            </div>
        </div>

        <div class="float-box">
            <form class="form-add-photo" action="add.php?class=PhotosController&method=add" method="post" enctype="multipart/form-data">
                <label class="form-add-photo-label" for="fileToUpload">Cadastrar nova foto na galeria...</label>
                <input class="form-add-photo-input js-input-file" type="file" name="photo" id="fileToUpload">
                <input class="form-add-photo-submit js-btn-add-submit" type="submit" value="Salvar foto" name="submit">
                <input class="form-add-photo-reset js-btn-add-reset" type="reset" value="Cancelar" name="reset">
            </form>
            <div class="float-box-arrow"></div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/main.js"></script>
    </body>
</html>
