<?php

require 'src/Components/FileUploader/UploadedFile.php';
require 'src/Components/FileUploader/UploadedPhoto.php';

$uploadedPhoto = new Components\FileUploader\UploadedPhoto(array_keys($_FILES)[0], $_FILES);
$uploadedPhoto->save();

header('Location: view.php', true, 302);
exit();
