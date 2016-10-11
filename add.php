<?php

// Requer o carregador automático de classes
require __DIR__.'/bootstrap.php';

$globals = ['get' => $_GET, 'post' => $_POST, 'files' => $_FILES];
$control = new Controllers\PhotosControl($globals);
$control->add();
