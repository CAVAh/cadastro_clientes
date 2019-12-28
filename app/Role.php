<?php

namespace App;

class Role extends CustomModel
{
    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }
}
