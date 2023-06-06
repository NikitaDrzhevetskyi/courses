<?php

namespace controllers;

class Users
{
    public function actionAuth()
    {
        if (!\models\User::checkLogged()) {
            if (isset($_POST['email']) and isset($_POST['password'])) {

                $auth['email'] = $_POST['email'];
                $auth['password'] = $_POST['password'];
                if (\models\User::auth($auth)) {
                    $message['message'] = 'success';
                } else {
                    $message['message'] = 'error';
                }
                echo json_encode($message);
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionRegistration()
    {
        if (!\models\User::checkLogged()) {
            if (isset($_POST['submit'])) {
                $user['first_name'] = $_POST['name'];
                $user['last_name'] = $_POST['surname'];
                $user['email'] = $_POST['email'];
                $user['role'] = $_POST['role'];
                $user['gender'] = $_POST['gender'];
                $user['date_birth'] = $_POST['date_birth'];
                $user['telephone'] = $_POST['telephone'];
                $user['password'] = $_POST['password'];
                $user['passwordRepeat'] = $_POST['passwordRepeat'];

                $message = \models\User::AddUser($user);
//                if ($message != null) {
                    echo json_encode($message);
//                } else {
//                    header("Location: /error404");
//                }

            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionLogout()
    {
        \models\User::logout();
        header("Location: /");
    }

    public function actionUpdate()
    {
        if (\models\User::checkLogged()) {
            if (isset($_POST['submit'])) {
                $user['first_name'] = $_POST['name'];
                $user['last_name'] = $_POST['surname'];
                $user['email'] = $_POST['email'];
                $user['role'] = $_POST['role'];
                $user['gender'] = $_POST['gender'];
                $user['date_birth'] = $_POST['date_birth'];
                $user['telephone'] = $_POST['telephone'];
                $user['password'] = $_POST['password'];
                $user['passwordRepeat'] = $_POST['passwordRepeat'];

                $message = \models\User::UpdateUser($user);
                echo json_encode($message);
            } else {
                    header("Location: /error404");
           }
        } else {
                header("Location: /error404");
        }
    }

    public function actionUpdateWithRole()
    {
        if (\models\User::checkLogged()) {
            if (isset($_POST['submit'])) {
                $user['first_name'] = $_POST['name'];
                $user['last_name'] = $_POST['surname'];
                $user['email'] = $_POST['email'];
                $user['role'] = $_POST['role'];
                $user['gender'] = $_POST['gender'];
                $user['date_birth'] = $_POST['date_birth'];
                $user['telephone'] = $_POST['telephone'];
                $user['id'] = $_POST['id'];

                $message = \models\User::UpdateWithRole($user);
                echo json_encode($message);
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }
}