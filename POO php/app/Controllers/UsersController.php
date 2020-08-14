<?php

namespace App\controllers;
use App\models\User;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;
use Zend\Diactoros\Response\RedirectResponse;

class UsersController extends BaseController {

   private function emailAlreadyExistsInDB(string $emailToCheck) {
      $user = User::where('email', $emailToCheck)->first();
      
      if($user != null){
         return true;
      } else {
         return false;
      }
   }
   
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
            if ($this->emailAlreadyExistsInDB($postData['email'])){
               throw new \Exception('This email account already exists');
            }

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
         } catch (\Exception $e) {
            $validationMessages = [$e->getMessage()];
         }

      }
 
      return $this->renderHTML('addUser.twig',[
         'validationMessages' => $validationMessages
      ]);
   }

   public function getLoginForm($request) {
      return $this->renderHTML('userLogin.twig');
   }

   public function authenticateUser($request) {
      if ($request->getMethod() == 'POST') {
         $validationMessages = null;
         $postLoginData = $request->getParsedBody();


         $userValidator = v::key('email', v::stringType()->notEmpty()->setName('Email'))
         ->key('password', v::stringType()->notEmpty()->setName('Password'));

         try {
            $userValidator->assert($postLoginData);

            if($this->emailAlreadyExistsInDB($postLoginData['email'])){
               $user = User::where('email', $postLoginData['email'])->first();
               if (\password_verify($postLoginData['password'], $user->password)) {
                  echo 'contraseña correcta';
                  return new RedirectResponse('/admin');
               } else {
                  $validationMessages = ['Email or password are incorrect'];
               }
            } else {
               $validationMessages = ['Email or password are incorrect'];
            }
         } catch (ValidationException $exception) {
            $validationMessages = array_values($exception->getMessages());
         }
         

         return $this->renderHTML('userLogin.twig', [
            'validationMessages' => $validationMessages
         ]);
      }
   }
}