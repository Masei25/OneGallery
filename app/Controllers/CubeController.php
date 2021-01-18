<?php

namespace App\Controllers;

use App\Migrations\Users;
use App\Models\UsersModel;
use Cube\Http\Response;
use Cube\Http\Request;
use Cube\Http\Controller;
use Cube\Misc\InputValidator;

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

        dd($username);
        return $response->redirect(route('/login'));
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
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');
        $password1 = $request->input('password1');
        

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
        $lastname->validate('required');
        $firstname->validate('required');
        $email->validate('required')->uniqueField('email', 'Email has already been registered');
        $password->validate('required')->equals($password1, "Password does not match");
        
        if (!InputValidator::isValid()) {
            $errors = InputValidator::getListedErrors();
            return $response->withSession('msg', $errors)->redirect(route('register'));
        }

        UsersModel::createEntry([
            'username' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
            'access_type' => UsersModel::ACCESS_TYPE_ADMIN,
        ]);

        $msg = 'You have registered successfully';

        return $response->withSession('msg', $msg)->redirect(route('register'));
    }

}