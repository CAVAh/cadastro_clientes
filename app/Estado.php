<?php

namespace App;

/**
 * @property mixed nome
 * @property mixed uf
 * @property mixed id
 * @property mixed pais_id
 */
class Estado extends CustomModel
{
    protected $table = 'estados';
    protected $fillable = ['id', 'nome', 'uf', 'pais', 'pais_id'];
    protected $hidden = ['pais_id'];
}
