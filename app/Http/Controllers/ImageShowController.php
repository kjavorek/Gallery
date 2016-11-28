<?php

namespace App\Http\Controllers;

use App\Photos;
use App\User;
use Illuminate\Http\Request;

class ImageShowController extends Controller
{
    public function imageShow()
    {
        $findFoto = Photos::where('id', $_GET['id'])->get();
        $user=$findFoto[0]["userId"];
        $findUser= User::where('id', $user)->get();
        return view('imageShow', [
            'foto' => $findFoto,
            'user' => $findUser
            ]);
    }
}
