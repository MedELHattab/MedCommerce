<?php
use App\Http\Controllers\Controller;

class AuthController extends Controller{
    public function login(){

    }
    public function registre(Request $request){
        $form=$request->validate([
            
        ]);
    }
    public function logout(){

    }
}