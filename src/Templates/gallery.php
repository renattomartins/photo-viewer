<?php
/**
 * Gallery template.
 *
 * Esse arquivo possui a marcação HTML do template para a galeria de fotos.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
use Widgets\PhotoGallery\GalleryButton;
use Widgets\PhotoGallery\GalleryPhoto;
use Widgets\Hints\Hints;

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

        <div class="hints">
            <?php
                // Mostra avisos
                $hints = new Hints();
                echo $hints->render();
            ?>
        </div>

        <div class="content">
            <div class="gallery">
                <?php
                    // Botão de voltar para a foto anterior
                    $prevButton = new GalleryButton(GalleryButton::PREV, $prevPhoto);
                    echo $prevButton->render();

                    // Foto principal
                    $galleryPhoto = new GalleryPhoto($currentPhoto, $totalPhotos);
                    echo $galleryPhoto->render();

                    // Botão de avançar para a próxima foto
                    $nextButton = new GalleryButton(GalleryButton::NEXT, $nextPhoto);
                    echo $nextButton->render();
                ?>
            </div>
            <div class="total-photos">Total de fotos cadastradas:
                <span class="total-photos-count"><?php echo $totalPhotos; ?></span>
            </div>
        </div>

        <div class="float-box">
            <?php
                $formAction =
                    'index.php?class=PhotosControl&action=add'.
                    (isset($currentPhoto) ? '&referedId='.$currentPhoto->getId() : '');
                ?>
            <form class="form-add-photo" method="post" action="<?= $formAction; ?>" enctype="multipart/form-data">
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
