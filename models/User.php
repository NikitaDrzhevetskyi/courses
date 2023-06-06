<?php

namespace models;

use DateTime;

class User
{
    /**
     * Авторизований користувач (якщо сесія є - поверне запис)
     *
     */
    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return false;
    }

    /**
     * Вихід з системи
     *
     */
    public static function logout()
    {
        unset($_SESSION["user"]);
    }

    /**
     * Пошук користувача по email
     *
     */
    public static function auth($authParams)
    {
        $user = \core\Core::getInstance()->getDB()->Select('users', "*", null, ['email' => $authParams['email']])[0];

        if (password_verify($authParams['password'], $user['password_hash'])){
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['first_name'] = $user['first_name'];
            $_SESSION['user']['last_name'] = $user['last_name'];
            $_SESSION['user']['email'] = $user['email'];
            $_SESSION['user']['role'] = $user['role'];
            return $user;
        } else {
            return $user;
        }
    }


    /**
     * Додає нового користувача у бд
     *
     */
    public static function addUser($userParams)
    {
        if(!\models\User::checkUserNameAndSurname($userParams['first_name'])){
            $message['error'] = "Перевірте ім'я";
            $message['message'] = "false";
            return  $message;
        }

        if (!\models\User::CheckUserNameAndSurname($userParams['last_name'])) {
            $message['error'] = "Перевірте прізвище";
            $message['message'] = "false";
            return  $message;
        }

        if (!\models\User::CheckUserEmail($userParams['email'])) {
            $message['error'] = 'Перевірте email';
            $message['message'] = \models\User::CheckUserEmail($userParams['email']);
            return  $message;
        }

        if (!\models\User::FindUserByEmail($userParams['email']))
        {
            $message['error'] = 'Користувач з таким email вже існує';
            $message['message'] = "false";
            return  $message;
        }

        if (!\models\User::CheckUserTelephone($userParams['telephone'])) {
            $message['error'] = "Перевірте телефон";
            $message['message'] = "false";
            return  $message;
        }

        if (!\models\User::CheckUserPassword($userParams['password'])) {
            $message['error'] = "Пароль дуже короткий, пароль має містити більше 6 символів";
            $message['message'] = "false";
            return  $message;
        } else if (!($userParams['password'] === $userParams['passwordRepeat'])) {
            $message['error'] = 'Паролі не співпадають';
            $message['message'] = "false";
            return  $message;
        }


        if($userParams['date_birth'] == ""){
            $userParams['date_birth'] = null;
        }

        // Якщо усі поля відповідають вимогам
        $userParams['password'] = password_hash($userParams['password'], PASSWORD_DEFAULT);
            // Реєстрація користувача
        $id = \core\Core::getInstance()->getDB()->Insert('users',
                [
                    'first_name' => $userParams['first_name'],
                    'last_name' => $userParams['last_name'],
                    'email' => $userParams['email'],
                    'role' => $userParams['role'],
                    'gender' => $userParams['gender'],
                    'date_birth' => $userParams['date_birth'],
                    'telephone' => $userParams['telephone'],
                    'password_hash' => $userParams['password'],
                    'create_at' => date_create()->format('Y-m-d H:i:s'),
                ]);
        if($id != null){
           $message['message'] = "true";
            $message['error'] = "Реєстрація пройшла успішно";
           return  $message;
        } else {
           $message['message'] = "false";
           $message['error'] = "Виникла помилка при реєстрації";
           return  $message;
        }
    }

    /**
     * Перевірка правильності введення імені|прізвища
     *
     */
    public static function checkUserNameAndSurname($name){
        if (strlen($name) >= 2 and preg_match('/^[A-ZА-ЯІЇ]+\z/iu', $name)) {
            return true;
        }
        return false;
    }
    /**
     * Перевірка правильності введення email
     *
     */
    public static function checkUserEmail($email)
    {
        if (preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/', $email)) {
            return true;
        }
        return false;
    }
    /**
     * Перевірка правильності введення пароля
     *
     */
    public static function checkUserPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }else
            return false;
    }
    /**
     * Перевірка правильності введення телефона
     *
     */
    public static function checkUserTelephone($phone)
    {
        if (preg_match('/(?:\+38)0[5-9]\d\d{3}\d{2}\d{2}/',  $phone)) {
            return true;
        }else
            return false;
    }
    /**
     * Пошук по Email
     *
     */
    public static function FindUserByEmail($email)
    {
        $user = \core\Core::getInstance()->getDB()->Select('users', "*", ['email' => $email]);
        if($user == false){
            return false;
        }else
            return true;
    }


    public static function updateUser($userParams)
    {
        if(!\models\User::checkUserNameAndSurname($userParams['first_name'])){
            return "Перевірте ім'я";
        }

        if (!\models\User::CheckUserNameAndSurname($userParams['last_name'])) {
            return "Перевірте прізвище";
        }

        if (!\models\User::CheckUserEmail($userParams['email'])) {
            return "Перевірте email";
        }
        if ($_SESSION['user']['email'] != $userParams['email'] and !\models\User::FindUserByEmail($userParams['email']))
        {
            return "Користувач з таким email вже існує";
        }

        if (!\models\User::CheckUserTelephone($userParams['telephone'])) {
            return "Перевірте телефон";

        }

        if($userParams['date_birth'] == ""){
            $userParams['date_birth'] = null;
        }

        if($userParams['password'] != null) {
            if (!\models\User::CheckUserPassword($userParams['password'])) {
                return "Пароль дуже короткий, пароль має містити більше 6 символів";

            } else if (!($userParams['password'] === $userParams['passwordRepeat'])) {
                return 'Паролі не співпадають';

            }
            $userParams['password'] = password_hash($userParams['password'], PASSWORD_DEFAULT);

             $result = \core\Core::getInstance()->getDB()->Update('users',
                [
                    'first_name' => $userParams['first_name'],
                    'last_name' => $userParams['last_name'],
                    'email' => $userParams['email'],
                    'gender' => $userParams['gender'],
                    'date_birth' => $userParams['date_birth'],
                    'telephone' => $userParams['telephone'],
                    'password_hash' => $userParams['password'],
                    'update_at' => date_create()->format('Y-m-d H:i:s'),
                ], ['id' => $_SESSION['user']['id']]);
            return $result;
        } else {
                $result = \core\Core::getInstance()->getDB()->Update('users',
                    [
                        'first_name' => $userParams['first_name'],
                        'last_name' => $userParams['last_name'],
                        'email' => $userParams['email'],
                        'gender' => $userParams['gender'],
                        'date_birth' => $userParams['date_birth'],
                        'telephone' => $userParams['telephone'],
                        'update_at' => date_create()->format('Y-m-d H:i:s'),
                    ], ['id' => $_SESSION['user']['id']]);
                return $result;
        }
    }

    public static function UpdateWithRole($userParams)
    {
        if(!\models\User::checkUserNameAndSurname($userParams['first_name'])){
            return "Перевірте ім'я";
        }
        if (!\models\User::CheckUserNameAndSurname($userParams['last_name'])){
            return "Перевірте прізвище";
        }
        if (!\models\User::CheckUserEmail($userParams['email'])){
            return "Перевірте email";
        }
        if ($_SESSION['user']['email'] != $userParams['email'] and !\models\User::FindUserByEmail($userParams['email']))
        {
            return "Користувач з таким email вже існує";
        }
        if (!\models\User::CheckUserTelephone($userParams['telephone'])) {
            return "Перевірте телефон";
        }
        if($userParams['date_birth'] == "") {
            $userParams['date_birth'] = null;
        }
            $result = \core\Core::getInstance()->getDB()->Update('users',
                [
                    'first_name' => $userParams['first_name'],
                    'last_name' => $userParams['last_name'],
                    'email' => $userParams['email'],
                    'gender' => $userParams['gender'],
                    'date_birth' => $userParams['date_birth'],
                    'telephone' => $userParams['telephone'],
                    'update_at' => date_create()->format('Y-m-d H:i:s'),
                    'role' => $userParams['role'],
                ], ['id' => $userParams['id']]);
            return $result;
    }
}