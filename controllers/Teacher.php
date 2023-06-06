<?php

namespace controllers;

use core\Controller;

class Teacher extends Controller
{
    public function actionIndex()
    {
        if($_SESSION['user']['role'] == '2'){
            $user = \models\Charts::teachChart();
            return $this->render('index', 'admin', ['info'=>$user]);
        } else {
            header("Location: /error404");
        }
    }

    public function actionAbout()
    {
        if($_SESSION['user']['role'] == '2'){
            $user = \models\Teacher::getInfo();
            return $this->render('about', 'admin', ['user_info'=> $user]);
        } else {
            header("Location: /error404");
        }
    }

    public function actionCourses()
    {
        if($_SESSION['user']['role'] == '2'){
            return $this->render('courses', 'admin', ['courses' =>  \models\Teacher::getCourses(), 'params'=>\models\Courses::GetAllParams()]);
        } else {
            header("Location: /error404");
        }
    }

    public function actionSortCourses()
    {
        if($_SESSION['user']['role'] == '2') {
            if ($_POST['submit']) {
                $courses = \models\Teacher::getCourses($_POST, $_POST['page']);
                $courses['page'] = $_POST['page'];
                echo json_encode($courses);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionCourseinfo()
    {
        if($_SESSION['user']['role'] == '2'){
            if($_GET['id'] != null){
                $students = \models\Teacher::getAllStudents($_GET['id']);
                return $this->render('courseinfo', 'admin', [
                    'course' => \models\Student::getCourse($_GET['id'])[0],
                    'lessons'=> \models\Student::getLessons($_GET['id'], null),
                     'time' =>  \models\Teacher::getDISTINCTLessonsTime($_GET['id'], null),
                     'students'=>$students]);
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }


    public function actionDateLessons()
    {
        if ($_SESSION['user']['role'] == '2') {
            if ($_POST['id']) {
                if ($_POST['start']) {
                    $id = $_POST['id'];
                    $param['id_course'] = $id;
                    $param['start'] = $_POST['start'];
                    $lessons = \models\Teacher::getLessons($id, $param);
                } else {
                    $id = $_POST['id'];
                    $lessons = \models\Teacher::getLessons($id, null);

                }
                echo json_encode($lessons);
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionChangeInfoLessons()
    {
        if ($_SESSION['user']['role'] == '2') {
            if ($_GET['id']) {
                $lessons = \models\Teacher::getInfoLessons($_GET['id']);

                if($lessons['id_user'] != $_SESSION['user']['id']){
                    header("Location: /error404");
                } else {
                    return $this->render('change', 'admin', ['lessons' => $lessons]);
                }
            }
        }
    }


    public function actionUpdateLesson()
    {
        if ($_SESSION['user']['role'] == '2') {
            if ($_POST['submit']) {
                $params['start'] = $_POST['start'];
                $params['finish'] = $_POST['finish'];
                $params['type'] = $_POST['type'];
                $params['id'] = $_POST['id'];
                $params['link'] = $_POST['link'];
                $params['description'] = $_POST['description'];
                $message = \models\Teacher::upd($params);
                echo json_encode($message);
            }
        }
    }

    public function actionSortstudents()
    {
        if($_SESSION['user']['role'] == '2') {
            if ($_POST != null) {
                $stud = \models\Teacher::getStudents($_POST);
                echo json_encode($stud);
            }
        } else {
            header("Location: /error404");
        }
    }

}