<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile() {
        $profiles = Profile::forUser();
    }

    public function profileCreate() {

    }

    public function profileStore() {

    }

    public function profileEdit() {

    }

    public function profileUpdate() {

    }

    public function profileDestroy() {

    }


}
