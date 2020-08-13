<?php

namespace App\controllers;
use App\models\User;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;

class UsersController extends BaseController {
   
   public function getAddUserAction($request) {
      $validationMessages = null;

      if ($request->getMethod() == 'POST') {
         
         $postData = $request->getParsedBody();
         
         $userValidator = v::key('firstName', v::stringType()->alpha(' ')->notEmpty()->setName('First Name'))
         ->key('lastName', v::stringType()->alpha(' ')->notEmpty()->setName('Last Name'))
         ->key('email', v::stringType()->notEmpty()->email()->setName('Email'))
         ->key('password', v::stringType()->notEmpty()->length(6, 20)->setName('Password'));

         try {
            $userValidator->assert($postData);

            $securedPwd = password_hash($postData['password'], PASSWORD_DEFAULT);

            $user = new User();
            $user->firstName = $postData['firstName'];
            $user->lastName = $postData['lastName'];
            $user->email = $postData['email'];
            $user->password = $securedPwd;
            $user->save();

            $validationMessages = 'Registro exitoso';
         } catch (ValidationException $exception) {
            $validationMessages = array_values($exception->getMessages());
         }
      }

      return $this->renderHTML('addUser.twig',[
         'validationMessages' => $validationMessages
      ]);
   }

   public function getLoginUserAction($request) {
      return $this->renderHTML('userLogin.twig');
   }
}