<?php
/**
 * Bootstrap file.
 *
 * Esse arquivo de boostrap é usado para inicializar a aplicação e invocar
 * comandos de inicaliação que possam causar efeitos colaterais (ao contrário
 * do arquivo basics.php, que é voltado apenas para declaração de símbolos).
 * O arquivo boostrap.php é incluído a cada requisição que o servidor recebe
 * e também é utilizado para rodar os testes unitários.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */

// Requer o carregador automático de classes
require __DIR__.'/vendor/autoload.php';

// Requer basic symbols
require __DIR__.'/basics.php';
