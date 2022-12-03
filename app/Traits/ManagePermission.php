<?php

namespace App\Traits;

trait ManagePermission {

    public function havePermission($permission){

        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                if($permission->id == $permission->id){
                    return true;
                }
            }
        }

        return false;
    }
}

