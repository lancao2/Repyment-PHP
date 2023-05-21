<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UsersController extends Controller
{
    public function index() {
        return User::all();
    }

    public function store(Request $req) {
        // Validation if all data has been submitted
        if(!$req->name || !$req->email || !$req->username || !$req->password){
            return response(["Dados de criação incompleto"], 400);
        }

        // Check if there is already an email registered
        $user = User::where("email", $req->email)->first();
        if($user){
            return response(["Email já cadastrado"], 400);
        }

        $user = User::create([
            "name" => $req->name,
            "email" => $req->email,
            "username" => $req->username,
            "password" => $req->password
        ]);
        $user = User::find($user);

        return response($user,200);
    }

    public function update(Request $req) {
        $user = User::find($req->id);
        $user->name = $req->name ? $req->name : $user->name;
        $user->username = $req->username ? $req->username : $user->username;
        $user->password = $req->password ? $req->password : $user->password;
        $user->email = $req->email ? $req->email : $user->email;

        $user->save();
        $user = User::find($req->id);
        return response($user, 200);
    }

    public function destroy(Request $req) {
        $user = User::find($req->id);

        if(!$user) {
            return response(["Usuario não encontrado"], 404);
        }

        $user->delete();
        return response(["Usuario deletado com sucesso"],200);
    }
}
