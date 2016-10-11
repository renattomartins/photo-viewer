<?php
/**
 * Home template.
 *
 * Esse arquivo possui a marcação HTML do template para a página de boas-vindas.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
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
        <div class="cover">
            <h1 class="cover-title">MaxMilhas: Teste de Codificação Back-end</h1>
            <div class="cover-description">
                <p>O Photo Viewer é uma aplicação web desenvolvida como parte do
                    Teste de Codificação Back-end para a vaga de desenvolvedor
                    na MaxMilhas.</p>
                <p>Na aplicação é possível cadastrar fotos, ver
                    a lista de fotos cadastradas e também excluir fotos. As
                    fotos cadastradas são exibidas como uma galeria onde o
                    usuário navega e visualiza uma foto por vez.</p>
                <p>A aplicação foi desenvolvida utilizando PHP 5.6.</p>
            </div>
            <a class="cover-link" href="index.php?class=PhotosControl&action=view">Acessar &raquo;</a>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/main.js"></script>
    </body>
</html>
