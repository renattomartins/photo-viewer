<?php

// if (isset($_POST)) {
//     $target_dir = 'photos/';
//     $target_file = $target_dir.basename($_FILES['fileToUpload']['name']);
//     $uploadOk = 1;
//     $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
//     // Check if image file is a actual image or fake image
//     if (isset($_POST['submit'])) {
//         $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
//         if ($check !== false) {
//             echo 'File is an image - '.$check['mime'].'.';
//             $uploadOk = 1;
//         } else {
//             echo 'File is not an image.';
//             $uploadOk = 0;
//         }
//     }
//     // Check if file already exists
//     if (file_exists($target_file)) {
//         echo 'Sorry, file already exists.';
//         $uploadOk = 0;
//     }
//     // Check file size
//     if ($_FILES['fileToUpload']['size'] > 500000) {
//         echo 'Sorry, your file is too large.';
//         $uploadOk = 0;
//     }
//     // Allow certain file formats
//     if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg'
//     && $imageFileType != 'gif') {
//         echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
//         $uploadOk = 0;
//     }
//     // Check if $uploadOk is set to 0 by an error
//     if ($uploadOk == 0) {
//         echo 'Sorry, your file was not uploaded.';
//     // if everything is ok, try to upload file
//     } else {
//         if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
//             echo 'The file '.basename($_FILES['fileToUpload']['name']).' has been uploaded.';
//         } else {
//             echo 'Sorry, there was an error uploading your file.';
//         }
//     }
// }

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
        <link rel="stylesheet" href="css/main.css">

        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
        <![endif]-->
    </head>
    <body>
        <div class="top-menu">
            <h1>Photo Viewer</h1>
        </div>

        <div class="content">
            <form action="add.php" method="post" enctype="multipart/form-data">
                Carregar nova foto:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Salvar" name="submit">
            </form>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/main.js"></script>
    </body>
</html>
