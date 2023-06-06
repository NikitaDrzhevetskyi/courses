<?php

namespace controllers;

use core\Controller;

class Student extends Controller
{
    public function actionIndex()
    {
        if($_SESSION['user']['role'] == '3'){
            $user = \models\Charts::studChart();
            return $this->render('index', 'admin', ['info'=>$user]);
        } else {
            header("Location: /error404");
        }
    }

    public function actionAbout()
    {
        if($_SESSION['user']['role'] == '3'){
            $user = \models\Student::getInfo();
            return $this->render('about', 'admin', ['user_info'=> $user]);
        } else {
            header("Location: /error404");
        }
    }

    public function actionCourses()
    {
        if($_SESSION['user']['role'] == '3'){
            return $this->render('courses', 'admin', ['courses' =>  \models\Student::getCourses(), 'params'=>\models\Courses::GetAllParams()]);
        } else {
            header("Location: /error404");
        }
    }


    public function actionSortCourses()
    {
        if($_SESSION['user']['role'] == '3') {
            if ($_POST['submit']) {
                $courses = \models\Student::getCourses($_POST, $page = $_POST['page']);
                $courses['page'] = $_POST['page'];
                echo json_encode($courses);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionCourseinfo()
    {
        if($_SESSION['user']['role'] == '3'){
            if($_GET['id'] != null){
                $success = \models\Student::ChesckedUser($_GET['id']);
                if($success == 1 || $success == 2) {
                    return $this->render('courseinfo', 'admin', [
                        'course' =>  \models\Student::getCourse($_GET['id'])[0],
                        'lessons'=> \models\Student::getLessons($_GET['id'], null),
                        'teachers' => \models\Student::getTeachers($_GET['id']),
                        'time' =>  \models\Teacher::getDISTINCTLessonsTime($_GET['id'], null)]);
                } else {
                    header("Location: /error404");
                }
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }




    public function actionTeachersDateLessons()
    {
        if($_SESSION['user']['role'] == '3') {
            if ($_POST['id']) {
                if ($_POST['start'] && $_POST['teacher']) {
                    $id = $_POST['id'];
                    $param['id_course'] = $id;
                    $param['id_teacher'] = $_POST['teacher'];
                    $param['start'] = $_POST['start'];
                    $lessons = \models\Student::getLessons($id, $param);
                } else if ($_POST['teacher']) {
                    $id = $_POST['id'];
                    $param['id_course'] = $id;
                    $param['id_teacher'] = $_POST['teacher'];
                    $lessons = \models\Student::getLessons($id, $param);
                } else if ($_POST['start']) {
                    $id = $_POST['id'];
                    $param['id_course'] = $id;
                    $param['start'] = $_POST['start'];
                    $lessons = \models\Student::getLessons($id, $param);
                } else {
                    $id = $_POST['id'];
                    $lessons = \models\Student::getLessons($id, null);
                }
                echo json_encode($lessons);
            }
        }  else {
            header("Location: /error404");
        }
    }

    public function actionDeleteMyCourse()
    {
        if ($_SESSION['user']['role'] == '3') {
            if ($_POST['id']) {
              $res = \models\Student::deleteCourseStudent($_POST['id']);
                echo json_encode(['msg' => $res]);
            } else {
                echo json_encode(['msg' => 'error']);
            }
        } else {
            header("Location: /error404");
        }
    }



}