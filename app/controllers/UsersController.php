<?php
namespace app\controllers;

//lets define a shortcut to the Auth class
use lithium\security\Auth;
//and a shortcut to out Users model
use app\models\Users;

class UsersController extends \lithium\action\Controller {
    
    public function index() {
        $users = Users::all();
        return compact('users');
    }
    
    public function add() {
        $register = NULL;
 
        if ($this->request->data){
            $register = Users::create($this->request->data);
            if ($register->save()) {
                $this->redirect('/users/');
            }
        }
        $data = $this->request->data;
    
        return compact('register', 'data');
    }

    public function login() {

        //assume there's no problem with authentication
        $noauth= false;
        //perform the authentication check and redirect on success
        if (Auth::check('member', $this->request)) {
            //Redirect on successful login
            return $this->redirect('/');
        }
        //if theres still post data, and we weren't redirected above, then login failed
        if ($this->request->data) {
            //Login failed, trigger the error message
            $noauth = true;
        }
        //Return noauth status
        return compact('noauth');
    }
}
