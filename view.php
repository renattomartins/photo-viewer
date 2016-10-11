<?php

// Requer o carregador automático de classes
require __DIR__.'/bootstrap.php';

$globals = ['get' => $_GET, 'post' => $_POST, 'files' => $_FILES];
$control = new Controllers\PhotosControl($globals);
$result = $control->view();

extract($result);

require __DIR__.'/src/Templates/gallery.php';
