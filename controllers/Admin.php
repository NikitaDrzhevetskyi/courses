<?php

namespace controllers;

use core\Controller;

class Admin extends Controller
{

    public function actionIndex()
    {
        if($_SESSION['user']['role'] == '1'){
            $info = \models\Charts::studAdmin();
            return $this->render('index', 'admin', ['info'=>$info]);
        } else {
            header("Location: /error404");
        }
    }

    public function actionAbout()
    {
        if($_SESSION['user']['role'] == '1'){
            $user = \models\Admin::getInfo();
            return $this->render('about', 'admin', ['user_info'=> $user]);
        } else {
            header("Location: /error404");
        }
    }

    public function actionUsers()
    {
        if($_SESSION['user']['role'] == '1'){
            $user = \models\Admin::getUsersWithParams("", $page = 1);
            return $this->render('users', 'admin', ['user_info'=> $user]);
        } else {
            header("Location: /error404");
        }
    }


    public function actionAjaxUsers()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']){
                $user = \models\Admin::getUsersWithParams($_POST, $page = $_POST['page']);
                $user['page'] = $_POST['page'];
                echo json_encode($user);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionDelUser()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_GET['user']) {
                \models\Admin::DeleteUser($_GET['user']);
                header("Location: /admin/users");
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }



    public function actionUpdateUser()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_GET['user']) {
                $user = \models\Admin::getInfoById($_GET['user']);
                $user['id']=$_GET['user'];
                return $this->render('updateuser', 'admin', ['user_info'=> $user]);
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }


    public function actionCourses()
    {
        if($_SESSION['user']['role'] == '1'){
            return $this->render('courses', 'admin', ['courses' =>  \models\Admin::getCourses(), 'params'=>\models\Courses::GetAllParams()]);
        } else {
            header("Location: /error404");
        }
    }



    public function actionSortCourses()
    {
        if($_SESSION['user']['role'] == '1') {
            if ($_POST['submit']) {
                $courses = \models\Admin::getCourses($_POST, $page = $_POST['page']);
                $courses['page'] = $_POST['page'];
                echo json_encode($courses);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionDelCourse()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_GET['id']) {
                \models\Admin::DeleteCourse($_GET['id']);
                header("Location: /admin/courses");
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }


    public function actionCourseinfo()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_GET['id']) {
                $user = \models\Admin::getStudentsWithParams(['id_course' => $_GET['id']], $page = 1);
                $lessons = \models\Admin::getLessonsWithParams(['id_course_lessons' => $_GET['id']], $page = 1);
                return $this->render('courseinfo', 'admin', ['params'=>\models\Courses::GetAllParams(), 'course' =>  \models\Admin::getCourseByID($_GET['id']),
                    'user_info'=> $user, 'lessons' => $lessons]);
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }


    public function actionCreateCourse()
    {
        if($_SESSION['user']['role'] == '1'){
                return $this->render('createcourse', 'admin', ['params'=>\models\Courses::GetAllParams()]);
        } else {
            header("Location: /error404");
        }
    }


    public function actionCreateCourseAjax()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']) {
                $res = \models\Courses::CreateCourse($_POST);
                echo json_encode($res);
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }



    public function actionUpdatecourse()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']) {
                $res = \models\Courses::UpdateCourse($_POST);
                echo json_encode($res);
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }


    public function actionAjaxUsersStudents()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']){
                $user = \models\Admin::getStudentsWithParams($_POST, $page = $_POST['page']);
                $user['page'] = $_POST['page'];
                echo json_encode($user);
            }
        } else {
            header("Location: /error404");
        }
    }


    public function actionUpdateenrl()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_GET['stud'] && $_GET['course']){
                $user = \models\Admin::getEnrollmentInfo($_GET);
                return $this->render('enrollment', 'admin', ['enrollment' => $user]);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionAjaxupdateenrollment()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST){
                $res = \models\Courses::UpdateEnrollment($_POST);
                echo json_encode($res);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionAjaxLessons()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']){
                $user = \models\Admin::getLessonsWithParams($_POST, $page = $_POST['page']);
                $user['page'] = $_POST['page'];
                echo json_encode($user);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionUpdateLessons()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_GET['id']){
                return $this->render('updatelessons', 'admin', ['lessons'=>\models\Admin::getOneLesson($_GET['id'])]);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionDeleteLessons()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_GET['lesson']) {
                \models\Admin::DeleteLessons($_GET['lesson']);
                header("Location: /admin/courseinfo?id=" . $_GET['course']);
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionAddLessons()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_GET['course_id']) {
                return $this->render('createlessons', 'admin', ['course'=>$_GET, 'teachers' => \models\Courses::getTeachers()]);
            } else {
                header("Location: /error404");
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionCreateLessonsAjax()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']){
                $user = \models\Courses::createLessons($_POST);
                echo json_encode($user);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionUpdateLessonsAjax()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']){
                $user = \models\Courses::updateLessons($_POST);
                echo json_encode($user);
            }
        } else {
            header("Location: /error404");
        }
    }


    public function actionLangAndCatg()
    {
        if($_SESSION['user']['role'] == '1'){
            $language = \models\Admin::getLangAjax($_POST);
            $category = \models\Admin::getCoursAjax($_POST);
            return $this->render('langantcatg', 'admin', ['languages'=>$language, 'category'=>$category]);
        } else {
            header("Location: /error404");
        }
    }

    public function actionAddCategory()
    {
        if($_SESSION['user']['role'] == '1'){
            return $this->render('addcategory', 'admin');
        } else {
            header("Location: /error404");
        }
    }
    public function actionAddLanguageAjax()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']){
                $id = \models\Admin::createLanguage($_POST);
                echo json_encode($id);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionAjaxLanguages()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']){
                $language = \models\Admin::getLangAjax($_POST, $_POST['page']);
                $language['page'] = $_POST['page'];
                echo json_encode($language);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionAjaxCategory()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']){
                $category = \models\Admin::getCoursAjax($_POST, $_POST['page']);
                $category['page'] = $_POST['page'];
                echo json_encode($category);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionСreateCategory()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']){
                $category = \models\Admin::createСategory($_POST);
                echo json_encode($category);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionUpdCategory()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_GET['id']){
                $category = \models\Admin::getCategoryById($_GET)[0];
                return $this->render('updcategory', 'admin', ['category' => $category]);
            }
        } else {
            header("Location: /error404");
        }
    }
    public function actionDelCategory()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_GET['id']){
               \models\Admin::getDelCategById($_GET['id']);
                header("Location: /admin/LangAndCatg");
            }
        } else {
            header("Location: /error404");
        }
    }
    public function actionUpdCategoryAjax()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']){
                $id = \models\Admin::updateСategory($_POST);
                echo json_encode($id);
            }
        } else {
            header("Location: /error404");
        }
    }


    public function actionDelLang()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_GET['id']){
                \models\Admin::getDelLanguageById($_GET['id']);
                header("Location: /admin/LangAndCatg");
            }
        } else {
            header("Location: /error404");
        }
    }
    public function actionUpdLang()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_GET['id']){
                $language = \models\Admin::getLanguageById($_GET)[0];
                return $this->render('updlang', 'admin', ['language' => $language]);
            }
        } else {
            header("Location: /error404");
        }
    }
    public function actionUpdLangAjax()
    {
        if($_SESSION['user']['role'] == '1'){
            if($_POST['submit']){
                $id = \models\Admin::updateLanguage($_POST);
                echo json_encode($id);
            }
        } else {
            header("Location: /error404");
        }
    }

    public function actionBackup()
    {
        if($_SESSION['user']['role'] == '1'){
            \models\Admin::MakeDB();
            header("Location: /admin/index");
        } else {
            header("Location: /error404");
        }
    }
}