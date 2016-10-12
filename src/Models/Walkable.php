<?php

namespace Models;

/**
 * Interface Walkable.
 *
 * Contrato que deve ser obedecido para classes que implementam
 * Walkable.
 *
 * A interface Walkable e outras intefaces existentes no pacote
 * Models fazem parte de uma decisão de projeto para segregar
 * melhor as interfaces e podem ser consideradas uma aplicação
 * prática do princípio ISP (Interface Segregation Principle) do
 * S.O.L.I.D. que diz que clientes não devem ser forçados a depender
 * de métodos que não usam.
 *
 * @author Renato Martins <renatto.martins@gmail.com>
 */
interface Walkable
{
    /**
     * Carrega para a memória o objeto anterior ao objeto atual.
     */
    public function previous();

    /**
     * Carrega para a memória o objeto seguinte ao objeto atual.
     */
    public function next();
}
