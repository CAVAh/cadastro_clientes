<?php

namespace App;

class Permission extends CustomModel
{
    public function roles() {
        return $this->belongsToMany(Role::class);
    }
}
