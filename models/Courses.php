<?php

namespace models;


class Courses
{
    /**
     * Отримуємо 3 останні курси (для головної сторінки)
     */
    public static function GetCourses(){
        $join = " INNER JOIN levels on courses.level = levels.id INNER JOIN categories on courses.category= categories.id  INNER JOIN languages on courses.language = languages.id ";
        $fields = ['courses.id as id',
                    'courses.name as name',
                    'courses.start as start',
                   'courses.lessons as lessons',
                   'levels.code as lvl',
                   'categories.name as category',
                   'courses.price as price',
                   'languages.name as language'];
       return \core\Core::getInstance()->getDB()->Select('courses', $fields, $join, ['is_active' => '1'], ['courses.id' => 'DESC'], null, '3');
    }

    /**
     * Отримуємо УСІ курси (для сторінки з курсами)
     */
    public static function GetMaxPriceForCourses()
    {
        return \core\Core::getInstance()->getDB()->Select('courses','MAX(price) as max_price');
    }


    public static function GetCountCoursesWithParams($params = null){
        $fields = 'COUNT(id) as count, MAX(price) as max_price, MIN(price) as min_price,  MAX(lessons) as lessons';

        if(!empty($params['courses.language'])){
            $tmp1 =  'courses.language' . $params['courses.language'];
        }
        if(!empty($params['courses.category'])){
            if($tmp1 != null){
                $tmp1 = $tmp1 . ' AND ';
            }
            $tmp2 =  'courses.category' . $params['courses.category'];
        }
        if(!empty($params['courses.level'])){
            if($tmp1 != null or $tmp2 != null){
                $tmp2 = $tmp2 . ' AND ';
            }
            $tmp3  =  'courses.level' . $params['courses.level'];
        }
        if($tmp1 != null or $tmp2 != null or $tmp3 != null){
            $act = ' AND is_active in (0,1)';
        } else {
            $act = ' is_active in (0,1)';
        }
        if(!empty($params['courses.price'])){
            $tmp4 = ' AND courses.price ' . $params['courses.price'];
        }
        if(!empty($params['courses.start'])){
            $tmp5 = ' AND courses.start  = \'' . ($params['courses.start']) . '\''  ;
        }
        if(!empty($params['courses.lessons'])){
            $tmp6 = ' AND lessons  <= ' . $params['courses.lessons'];
        }
        $where =  $tmp1 . $tmp2 . $tmp3 . $act . $tmp4 . $tmp5 . $tmp6;

        return \core\Core::getInstance()->getDB()->Select('courses', $fields, null, $where)[0];
    }


    public static function GetCoursesWithParams($params = null, $page = 1){
        $join = " INNER JOIN levels on courses.level = levels.id INNER JOIN categories on courses.category= categories.id  INNER JOIN languages on courses.language = languages.id ";
        $fields = ['courses.name as name',
            'courses.start as start',
            'courses.lessons as lessons',
            'courses.id as course_id',
            'levels.code as lvl',
            'categories.name as category',
            'courses.price as price',
            'languages.name as language',
            'courses.description as description'];

        $ConstOffset = 9;
        $offset = ($page - 1) * $ConstOffset;

        if(!empty($params['courses.language'])){
            $tmp1 =  'courses.language' . $params['courses.language'];
        }
        if(!empty($params['courses.category'])){
            if($tmp1 != null){
                $tmp1 = $tmp1 . ' AND ';
            }
            $tmp2 =  'courses.category' . $params['courses.category'];
        }
        if(!empty($params['courses.level'])){
            if($tmp1 != null or $tmp2 != null){
                $tmp2 = $tmp2 . ' AND ';
            }
            $tmp3  =  'courses.level' . $params['courses.level'];
        }
        if($tmp1 != null or $tmp2 != null or $tmp3 != null){
            $act = ' AND is_active in (0,1)';
        } else {
            $act = ' is_active in (0,1)';
        }
        if(!empty($params['courses.price'])){
            $tmp4 = ' AND courses.price ' . $params['courses.price'];
        }
        if(!empty($params['courses.start'])){
                $tmp5 = ' AND courses.start  = \'' . ($params['courses.start']) . '\''  ;
        }
        if(!empty($params['courses.lessons'])){
            $tmp6 = ' AND lessons  <= ' . $params['courses.lessons'];
        }
        $where =  $tmp1 . $tmp2 . $tmp3 . $act . $tmp4 . $tmp5 . $tmp6;

        return \core\Core::getInstance()->getDB()->Select('courses', $fields, $join, $where, 'courses.id', $offset, $ConstOffset);
    }



    /**
     * Отримуємо УСІ наявні парметри курсів
     */
    public static function GetAllParams(){
        $params['levels'] = \core\Core::getInstance()->getDB()->Select('levels', "*");
        $params['categories'] = \core\Core::getInstance()->getDB()->Select('categories', "*");
        $params['languages'] = \core\Core::getInstance()->getDB()->Select('languages', "*");
        $params['lessons'] = \core\Core::getInstance()->getDB()->Select('courses', "MAX(lessons) as lessons")[0]['lessons'];
        return  $params;
    }



    public static function UpdateCourse($userParams)
    {
        if(!$userParams['name']){
            return "Перевірте назву";
        }

        if(!preg_match("/^\d+$/", $userParams['lessons']) and $userParams['lessons'] > 0) {
            return "Перевірте кількість занять";
        }

        if(!preg_match("/^\d+$/", $userParams['price']) and $userParams['price'] > 0) {
            return "Перевірте ціну";
        }

        if($userParams['start'] > $userParams['finish']){
            return "Перевірте дату";
        }

        if(!$userParams['start'] || !$userParams['finish']){
            return "Перевірте дату";
        }

        $result = \core\Core::getInstance()->getDB()->Update('courses',
            [
                'name' => $userParams['name'],
                'language' => $userParams['language'],
                'level' => $userParams['level'],
                'category' => $userParams['category'],
                'lessons' => $userParams['lessons'],
                'price' => $userParams['price'],
                'description' => $userParams['description'],
                'is_active' => $userParams['is_active'],
                'start' => $userParams['start'],
                'finish' => $userParams['finish'],
            ], ['id' => $userParams['id']]);
        return $result;

    }


    public static function CreateCourse($userParams)
    {
        if(!$userParams['name']){
            return "Перевірте назву";
        }

        if(!preg_match("/^\d+$/", $userParams['lessons']) and $userParams['lessons'] > 0) {
            return "Перевірте кількість занять";
        }

        if(!preg_match("/^\d+$/", $userParams['price']) and $userParams['price'] > 0) {
            return "Перевірте ціну";
        }

        if($userParams['start'] > $userParams['finish']){
            return "Перевірте дату";
        }

        if(!$userParams['start'] || !$userParams['finish']){
            return "Перевірте дату";
        }

        $result = \core\Core::getInstance()->getDB()->Insert('courses',
            [
                'name' => $userParams['name'],
                'language' => $userParams['language'],
                'level' => $userParams['level'],
                'category' => $userParams['category'],
                'lessons' => $userParams['lessons'],
                'price' => $userParams['price'],
                'description' => $userParams['description'],
                'is_active' => $userParams['is_active'],
                'start' => $userParams['start'],
                'finish' => $userParams['finish'],
            ]);
        if ($result > 0){
            return true;
        }else{
            return false;
        }

    }

    public static function updateLessons($userParams)
    {
        if(!$userParams['name']) {
            return "Перевірте назву";
        }
        if(!$userParams['start']) {
            return "Перевірте дату";
        }
        if(!$userParams['finish']) {
            return "Перевірте дату";
        }
        if(!$userParams['start'] > $userParams['finish']) {
            return "Перевірте дату";
        }

        $result = \core\Core::getInstance()->getDB()->Update('lessons',
            [
                'name' => $userParams['name'],
                'description' => $userParams['description'],
                'link' => $userParams['link'],
                'type' => $userParams['type'],
                'start' => $userParams['start'],
                'finish' => $userParams['finish'],
                'updated_at' => date_create()->format('Y-m-d H:i:s'),
            ], ['id' => $userParams['id']]);
        return $result;
    }

    public static function createLessons($userParams)
    {
        if(!$userParams['name']) {
            return "Перевірте назву";
        }
        if(!$userParams['start']) {
            return "Перевірте дату";
        }
        if(!$userParams['finish']) {
            return "Перевірте дату";
        }
        if(!$userParams['start'] > $userParams['finish']) {
            return "Перевірте дату";
        }

        $result = \core\Core::getInstance()->getDB()->Insert('lessons',
            [
                'name' => $userParams['name'],
                'description' => $userParams['description'],
                'link' => $userParams['link'],
                'type' => $userParams['type'],
                'start' => $userParams['start'],
                'finish' => $userParams['finish'],
                'id_course' => $userParams['id_course'],
                'id_teacher' => $userParams['id_teacher'],
            ]);
        return $result;
    }


    public static function GetCourseFilter($value)
    {
        $join = " INNER JOIN languages on courses.language = languages.id INNER JOIN levels on courses.level = levels.id";

        if($value != null){
            $where = '';
            $where = $where . ' name like \'' . $value['name'] .'%\'';
        }else{
            $where = null;
        }
        return \core\Core::getInstance()->getDB()->Select('courses', '*', null, $where);
    }

    public static function UpdateEnrollment($userParams)
    {
        if(!preg_match("/^\d+$/", $userParams['payment']) and $userParams['payment'] >= 0) {
            return "Перевірте оплату";
        }
        $join = " INNER JOIN students on enrollments.id_student = students.id INNER JOIN users on students.user_id = students.id";

        $result = \core\Core::getInstance()->getDB()->Update('enrollments',
            [
                'payment' => $userParams['payment'],
                'date_payment' => $userParams['date_payment'],
                'type_payment' => $userParams['type_payment'],
                'success' => $userParams['success'],
                'updated_at' => date_create()->format('Y-m-d H:i:s'),
            ], ['id_student' => $userParams['user_id'], 'id_course' => $userParams['id_course']]);
        return $result;
    }




    public static function getTeachers()
    {
        $join = " INNER JOIN users on teachers.user_id = users.id";
        $fields = [
            'DISTINCT users.id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'teachers.id as user_id'
        ];
        return \core\Core::getInstance()->getDB()->Select('teachers', $fields, $join);
    }

    public static function registerToCourse($id)
    {
        if($_SESSION['user']['role'] == 3){
            $join = " INNER JOIN students on enrollments.id_student = students.id INNER JOIN users on students.user_id = users.id";
            if(\core\Core::getInstance()->getDB()->Select('enrollments', '*', $join, ['users.id'=> $_SESSION['user']['id'], 'id_course' => $id]) != null) {
                return false;
            }else{
                $join2 = " INNER JOIN users on students.user_id = users.id";
                $id_stud = \core\Core::getInstance()->getDB()->Select('students','students.id', $join2, ['users.id'=> $_SESSION['user']['id']])[0];
                $result = \core\Core::getInstance()->getDB()->Insert('enrollments',
                    [
                        'id_student' => $id_stud['id'],
                        'id_course' => $id,
                        'success' => '2',
                        'created_at'=> date_create()->format('Y-m-d H:i:s'),
                    ]);
                $result = \core\Core::getInstance()->getDB()->Select('enrollments', '*', $join, ['users.id'=> $_SESSION['user']['id'], 'enrollments.id_course' => $id]);
                return $result;
            }
        }
    }
}