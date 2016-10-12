<?php
/**
 * Basics file.
 *
 * Esse arquivo também carregado logo no começo de cada requisição que o
 * servidor recebe, mas esse, ao contrário do boostrap.php é voltado apenas
 * para declaração de símbolos (classes, funções, constantes, etc).
 * Segundo as diretrizes da PSR-1, um arquivo não deveria declarar novos
 * símbolos e causar algum efeito colateral ao mesmo tempo, no mesmo arquivo.
 * Ele OU deve declarar símbolos OU executar a lógica com efeitos colaterais,
 * mas não ambos.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */

/**
 * Função utilitária de escopo global para colocar bytes em
 * uma ordem de grandeza legível por seres humanos.
 *
 * @param int $bytes
 * @param int $precision
 *
 * @return float bytes devidamente convertidos para uma unidade maior
 */
function formatBytes($bytes, $precision = 2)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);

    return round($bytes, $precision).' '.$units[$pow];
}
