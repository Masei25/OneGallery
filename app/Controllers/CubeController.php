<?php

namespace App\Controllers;

use Cube\Tools\Auth;
use Cube\Http\Request;
use Cube\Http\Response;
use App\Migrations\Users;
use Cube\Http\Controller;
use App\Models\UsersModel;
use Cube\Misc\InputValidator;
use Cube\Exceptions\AuthException;

class CubeController extends Controller
{
    /**
     * Home controller
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function home(Request $request, Response $response)
    {
        return $response->view('home');
    }

    /**
     * Login controller
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function login(Request $request, Response $response)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        try {
            Auth::attempt($username, password_hash($password, PASSWORD_DEFAULT));
            
        } catch (AuthException $th) {
            return $response->withSession('msg', $th->getMessage())->redirect(route('home'));
        }
        return $response->redirect(route('dashboard'));
    }

    /**
     * Register Controller
     *
     * @param Request $request
     * @param Response $response
     * @return response
     */
    
    public function register(Request $request, Response $response)
    {
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $password2 = $request->input('password2');  

        InputValidator::init([
            "uniqueField" => function (InputValidator $validator, string $field, string $message) {
                if ($validator->getValue() == '') {
                    return null;
                }

                if (UsersModel::findby($field, $validator->getValue())) {
                    $validator->attachError($message);
                }
            }
        ]);

        $username->validate('required')->uniqueField('username', 'Username has already been registered');
        $email->validate('required')->uniqueField('email', 'Email has already been registered');
        $password->validate('required')->equals($password2, "Password does not match");
        
        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();
            return $response->withSession('msg', $errors)->redirect('/register');
        }

        UsersModel::createEntry([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'access_type' => UsersModel::ACCESS_TYPE_ADMIN,
        ]);

        $msg = 'Registration successfully, please login to continue';

        return $response->withSession('msgs', $msg)->redirect('/register');
    }

}