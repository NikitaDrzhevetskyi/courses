<?php

namespace controllers;

use core\Controller;


class Site extends Controller
{
    /**
     * Головна сторінка
     */
    public function actionIndex()
    {
        $courses = \models\Courses::GetCourses();
        return $this->render('index', 'main', ['courses' => $courses], ['Title' => 'Courses']);
    }

    public function actionCourses()
    {
        $my_link = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $params = \models\Courses::GetAllParams();

        if ($_GET['languages_check'] or
            $_GET['categories_check'] or
            $_GET['levels_check'] or
            $_GET['page'] or
            $_GET['min_price'] or
            $_GET['max_price'] or
            $_GET['date'] or
            $_GET['lessons_range'])
        {
            if ($_GET['languages_check'] != null) {
                $filter['courses.language'] = ' in (' . implode(", ", $_GET['languages_check']) . ') ';
            }
            if ($_GET['categories_check'] != null) {
                $filter['courses.category'] = ' in (' . implode(", ", $_GET['categories_check']) . ') ';
            }
            if ($_GET['levels_check'] != null) {
                $filter['courses.level'] = ' in (' . implode(", ", $_GET['levels_check']) . ') ';
            }
            if ($_GET['min_price'] != null and $_GET['max_price'] != null ) {
                $filter['courses.price'] = ' BETWEEN ' . $_GET['min_price'] . " AND " . $_GET['max_price'] ;
            }
            if ($_GET['date'] != null) {
                $filter['courses.start'] = $_GET['date'] ;
            }
            if ($_GET['lessons_range'] != null) {
                $filter['courses.lessons'] = $_GET['lessons_range'];
            }

            $el = \models\Courses::GetCountCoursesWithParams($filter);
            $count = $el['count'];
            if  ($_GET['min_price'] == null and $_GET['max_price'] == null ) {
                $_GET['min_price'] = $el['min_price'];
                $_GET['max_price'] = \models\Courses::GetMaxPriceForCourses()[0]['max_price'];
            }


            if ($_GET['page'] > 0 and $_GET['page'] <= $count) {
                $page = $_GET['page'];
                $tmp = mb_substr($my_link, 0, strpos($my_link, 'page'));
                $link = $tmp . '&page=';
            } else if($_GET['page'] === null) {
                $link = $my_link . '&page=';
                $page = 1;
            } else {
                $page = 1;
                $tmp = mb_substr($my_link, 0, strpos($my_link, 'page'));
                $link = $tmp . 'page=';
            }
                $courses = \models\Courses::GetCoursesWithParams($filter, $page);
                return $this->render('course', 'main',
                    ['courses' => $courses,
                    "params" => $params,
                        "filter" => $_GET,
                        'link' => $link,
                        "count"=>$count,
                        "lessons"=>$params['lessons']],
                    ['Title' => 'Courses']);
        } else {
            if(substr($my_link, -1) == '?'){
                $link = $my_link . 'page=';
            }else{
                $link = $my_link . '?page=';
            }

            $el = \models\Courses::GetCountCoursesWithParams();
            $count = $el['count'];
            $_GET['min_price'] = $el['min_price'];
            $_GET['max_price'] = $el['max_price'];
            $_GET['lessons_range'] = $el['lessons'];

                $courses = \models\Courses::GetCoursesWithParams();
                return $this->render('course', 'main',
                    ['courses' => $courses,
                        "params" => $params,
                        'link' => $link,
                        "count" => $count,
                        "lessons"=>$params['lessons']],
                    ['Title' => 'Courses']);
            }
        }

    public function actionFindcourse(){
        if ($_POST['name']) {
            $res = \models\Courses::GetCourseFilter($_POST['name']);
            echo json_encode($res);
        } else {
            echo json_encode('error');
        }
    }

    public function actionRegister(){
        if($_SESSION['user']['role'] == 3){
        if ($_POST['id']) {
            $res = \models\Courses::registerToCourse($_POST['id']);
            if($res == true){
                echo json_encode('Вас зараховано на курс');
            }else{
                echo json_encode('Ви вже зараховані на курс');
            }
        }
        } else  if($_SESSION['user']['role'] == 2 or $_SESSION['user']['role'] == 1){
            echo json_encode('Реєструватися на курс можуть лише cтуденти');
        } else {
            echo json_encode('Реєструватися на курс можуть лише авторизовані користувачі');
        }
    }
}
