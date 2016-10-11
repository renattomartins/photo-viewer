<?php

namespace Components\Notifications;

/**
 * Classe Notification.
 *
 * Essa classe tem como única responsabilidade receber e armazenar mensagens
 * de feedback ao usuário final (que podem ser tanto de sucesso quanto de
 * erro). Essas mensgens são persistidas em arquivo simples e podem ser
 * consumidas por outro pacote de classes em outra parte do ciclo de vida
 * da requisição.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
class Notification
{
    const SUCCESS = 1;
    const ERROR = 2;
    const PATH = 'tmp/notifications.txt';

    /**
     * Adiciona mensagem de notificação para ser consumida no futuro.
     */
    public function addMessage($type, $message)
    {
        // Abre arquivo, escreve e fecha arquivo
        $handle = fopen(self::PATH, "a");
        fwrite($handle, $type . "\t" . $message . "\n");
        fclose($handle);
    }
}
