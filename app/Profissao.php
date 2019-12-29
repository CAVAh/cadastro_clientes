<?php

namespace App;

/**
 * @property mixed nome
 * @property mixed id
 */
class Profissao extends CustomModel
{
    protected $table = 'profissoes';
    protected $fillable = ['id', 'nome'];
}
