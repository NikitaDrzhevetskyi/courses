<?php

namespace models;

class Admin
{
    public static function getInfo()
    {
        $fields = [
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.gender as gender',
            'users.date_birth as date_birth',
            'users.email as email',
            'users.telephone as telephone'];
        return \core\Core::getInstance()->getDB()->Select('users', $fields, null, ['users.id' => $_SESSION['user']['id']])[0];
    }

    public static function getInfoById($id)
    {
        $fields = [
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.gender as gender',
            'users.date_birth as date_birth',
            'users.email as email',
            'users.telephone as telephone',
            'users.role as role'];
        return \core\Core::getInstance()->getDB()->Select('users', $fields, null, ['users.id' => $id])[0];
    }


    public static function getUsersWithParams($params, $page = 1)
    {
        $join = " LEFT JOIN students on users.id = students.user_id LEFT JOIN teachers on users.id  = teachers.user_id";

        $ConstOffset = 10;
        $offset = ($page - 1) * $ConstOffset;

        $fields = [
            'DISTINCT users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.gender as gender',
            'users.date_birth as date_birth',
            'users.email as email',
            'users.telephone as telephone',
            'users.role as role',
            'users.create_at as create_at'
        ];

        if($params != null){
            if($params['role'] !== '1'){
                $params = \models\Admin::getWhereString($params);
                $user['users'] = \core\Core::getInstance()->getDB()->Select('users', $fields, $join, $params, 'users.create_at', $offset, $ConstOffset);
                $user['count'] = \core\Core::getInstance()->getDB()->Select('users', 'Count(*) as count', null, $params, 'users.create_at')[0];
            } else {
                $params = \models\Admin::getWhereString($params);
                $user['users'] = \core\Core::getInstance()->getDB()->Select('users', $fields, null, $params, 'users.create_at', $offset, $ConstOffset);
                $user['count'] = \core\Core::getInstance()->getDB()->Select('users', 'Count(*) as count', null, $params, 'users.create_at')[0];
            }
        }else{
            $user['users'] = \core\Core::getInstance()->getDB()->Select('users', $fields, null,  null, 'users.create_at', $offset, $ConstOffset);
            $user['count'] = \core\Core::getInstance()->getDB()->Select('users', 'Count(*) as count', null,  null, 'users.create_at')[0];
        }
        return $user;
    }

    public static function getWhereString($params)
    {
        $where = '';
        if (!empty($params['first_name'])) {
            $where = $where . ' users.first_name like \'' . $params['first_name'] . '%\'';
        }

        if (!empty($params['last_name']) and $where != '') {
            $where = $where . ' AND users.last_name like \'' . $params['last_name'] . '%\'';
        } else if (!empty($params['last_name'])) {
            $where = $where . ' users.last_name like \'' . $params['last_name'] . '%\'';
        }

        if (!empty($params['gender']) and $where != '') {
            $where = $where . ' AND users.gender = \'' . $params['gender'] . '\'';
        } else if (!empty($params['gender'])) {
            $where = $where . ' users.gender = \'' . $params['gender'] . '\'';
        }

        if (!empty($params['date_birth']) and $where != '') {
            $where = $where . ' AND users.date_birth = ' . $params['date_birth'];
        } else if (!empty($params['date_birth'])) {
            $where = $where . ' users.date_birth = ' . $params['date_birth'];
        }

        if (!empty($params['email']) and $where != '') {
            $where = $where . ' AND users.email like \'' . $params['email'] . '%\'';
        } else if (!empty($params['email'])) {
            $where = $where . ' users.email like \'' . $params['email'] . '%\'';
        }

        if (!empty($params['telephone']) and $where != '') {
            $where = $where . ' AND users.telephone like \'' . $params['telephone'] . '%\'';
        } else if (!empty($params['telephone'])) {
            $where = $where . ' users.telephone like \'' . $params['telephone'] . '%\'';
        }

        if (!empty($params['create']) and $where != '') {
            $where = $where . ' AND users.create_at like \'' . $params['create'] . '%\'';
        } else if (!empty($params['create'])) {
            $where = $where . ' users.create_at like \'' . $params['create'] . '%\'';
        }

        if (!empty($params['role']) and $where != '') {
            $where = $where . ' AND users.role = ' . $params['role'];
        } else if (!empty($params['role'])) {
            $where = $where . ' users.role = ' . $params['role'];
        }

        if (!empty($params['id_course']) and $where != '') {
            $where = $where . ' AND enrollments.id_course = ' . $params['id_course'];
        } else if (!empty($params['id_course'])) {
            $where = $where . ' enrollments.id_course = ' . $params['id_course'];
        }

        if (!empty($params['id_course_lessons']) and $where != '') {
            $where = $where . ' AND lessons.id_course = ' . $params['id_course_lessons'];
        } else if (!empty($params['id_course_lessons'])) {
            $where = $where . ' lessons.id_course = ' . $params['id_course_lessons'];
        }

        if (!empty($params['start']) and $where != '') {
            $where = $where . ' AND lessons.start = ' . $params['start'];
        } else if (!empty($params['start'])) {
            $where = $where . ' lessons.start = ' . $params['start'];
        }

        if (!empty($params['finish']) and $where != '') {
            $where = $where . ' AND lessons.finish = ' . $params['finish'];
        } else if (!empty($params['start'])) {
            $where = $where . ' lessons.finish = ' . $params['finish'];
        }

        if (!empty($params['type']) and $where != '') {
            $where = $where . ' AND lessons.type = ' . $params['type'];
        } else if (!empty($params['type'])) {
            $where = $where . ' lessons.type = ' . $params['type'];
        }


        return $where;
    }


    public static function getStudentsWithParams($params, $page = 1)
    {
        $join = " INNER JOIN enrollments on students.id = enrollments.id_student INNER JOIN users on students.user_id = users.id";

        $ConstOffset = 5;
        $offset = ($page - 1) * $ConstOffset;

        $fields = [
            'DISTINCT users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.gender as gender',
            'users.date_birth as date_birth',
            'users.email as email',
            'users.telephone as telephone',
            'users.role as role',
            'students.id as id_student'
        ];

        if($params != null){
                $params = \models\Admin::getWhereString($params);
                $user['users'] = \core\Core::getInstance()->getDB()->Select('students', '*', $join, $params, null, $offset, $ConstOffset);
                $user['count'] = \core\Core::getInstance()->getDB()->Select('students', 'Count(*) as count', $join, $params)[0];
        }else{
            $user['users'] = \core\Core::getInstance()->getDB()->Select('students', $fields, $join,  null, null, $offset, $ConstOffset);
            $user['count'] = \core\Core::getInstance()->getDB()->Select('students', 'Count(*) as count', $join,  null, null)[0];
        }
        return $user;
    }






    public static function DeleteUser($id)
    {
        \core\Core::getInstance()->getDB()->Delete('users', ['users.id' => $id]);
    }

    public static function DeleteCourse($id)
    {
        \core\Core::getInstance()->getDB()->Delete('courses', ['courses.id' => $id]);
    }

    public static function DeleteLessons($id)
    {
        \core\Core::getInstance()->getDB()->Delete('lessons', ['lessons.id' => $id]);
    }

    public static function getCourseByID($id)
    {
        $join = "INNER JOIN categories on courses.category = categories.id INNER JOIN levels on courses.level = levels.id INNER JOIN languages on courses.language = languages.id  ";

        $fields = ['courses.id as id',
            'courses.name as name',
            'languages.name as language',
            'levels.name as level',
            'categories.name as category',
            'courses.lessons as lessons',
            'courses.price as price',
            'courses.start as start',
            'courses.description as description',
            'courses.finish as finish',
            'courses.is_active as active',
        ];
        return \core\Core::getInstance()->getDB()->Select('courses', $fields, $join, ['courses.id' => $id])[0];

    }



    public static function getCourses($params = null, $page = 1)
    {
        $ConstOffset = 15;
        $offset = ($page - 1) * $ConstOffset;

        $join = "INNER JOIN categories on courses.category = categories.id INNER JOIN levels on courses.level = levels.id INNER JOIN languages on courses.language = languages.id  ";
        $fields = ['courses.id as id',
            'courses.name as name',
            'languages.name as language',
            'levels.name as level',
            'categories.name as category',
            'courses.lessons as lessons',
            'courses.price as price',
            'courses.start as start',
            'courses.finish as finish',
            'courses.is_active as active',
        ];

        $params = \models\Student::getWhereString($params);
        $user['course'] = \core\Core::getInstance()->getDB()->Select('courses', $fields, $join, $params, null, $offset, $ConstOffset);
        if($params != null) {
            $user['count'] = \core\Core::getInstance()->getDB()->Select('courses', 'Count(*) as count', $join, $params, null)[0];
        } else {
            $user['count'] = \core\Core::getInstance()->getDB()->Select('courses', 'Count(*) as count', $join, null, null)[0];
        }
        return $user;
    }

    public static function getEnrollmentInfo($params)
    {
        $join = " INNER JOIN enrollments on students.id = enrollments.id_student INNER JOIN users on students.user_id = users.id";

        $fields = [
            'users.first_name as first_name',
            'users.id as user_id',
            'users.last_name as last_name',
            'enrollments.created_at as created_at',
            'enrollments.payment as payment',
            'enrollments.date_payment as date_payment',
            'enrollments.type_payment as type_payment',
            'enrollments.success as success',
            'enrollments.id_student as id_student',
            'enrollments.id_course as id_course',
            ];
        return \core\Core::getInstance()->getDB()->Select('students', $fields, $join, ['students.id' => $params['stud'], 'enrollments.id_course' => $params['course']])[0];
    }


    public static function getLessonsWithParams($params, $page = 1)
    {
        $join = " INNER JOIN teachers on lessons.id_teacher = teachers.id INNER JOIN users on teachers.user_id = users.id";

        $ConstOffset = 5;
        $offset = ($page - 1) * $ConstOffset;

        $fields = [
            'DISTINCT users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'lessons.start as start',
            'lessons.finish as finish',
            'lessons.name as lessons_name',
            'lessons.type as type',
            'lessons.id as lessons_id',
        ];

        if($params != null){
            $params = \models\Admin::getWhereString($params);
            $user['users'] = \core\Core::getInstance()->getDB()->Select('lessons', $fields, $join, $params, null, $offset, $ConstOffset);
            $user['count'] = \core\Core::getInstance()->getDB()->Select('lessons', 'Count(*) as count', $join, $params)[0];
        }else{
            $user['users'] = \core\Core::getInstance()->getDB()->Select('lessons', $fields, $join,  null, null, $offset, $ConstOffset);
            $user['count'] = \core\Core::getInstance()->getDB()->Select('lessons', 'Count(*) as count', $join,  null, null)[0];
        }
        return $user;
    }

    public static function getOneLesson($params)
    {
        $fields = [
            'lessons.start as start',
            'lessons.finish as finish',
            'lessons.name as lessons_name',
            'lessons.type as type',
            'lessons.id as lessons_id',
            'lessons.description as description',
            'lessons.link as link'
        ];


        $user = \core\Core::getInstance()->getDB()->Select('lessons', $fields, null, ['id'=>$params])[0];
        return $user;
    }


    public static function createСategory($userParams)
    {
        if(!$userParams['name'] || $userParams['name'] == '') {
            return "Перевірте назву";
        }
        if(!$userParams['description']) {
            $userParams['description'] = null;
        }

        $result = \core\Core::getInstance()->getDB()->Insert('categories',
            [
                'name' => $userParams['name'],
                'description' => $userParams['description'],
            ]);
        return $result;
    }

    public static function createLanguage($userParams)
    {
        if(!$userParams['name'] || $userParams['name'] == '') {
            return "Перевірте назву";
        }
        if(strlen($userParams['code']) != 2) {
            return "Перевірте код";
        }
        $result = \core\Core::getInstance()->getDB()->Insert('languages',
            [
                'name' => $userParams['name'],
                'code' => $userParams['code'],
            ]);
        return $result;
    }

    public static function updateСategory($userParams)
    {
        if(!$userParams['name'] || $userParams['name'] == '') {
            return "Перевірте назву";
        }
        if(!$userParams['description']) {
            $userParams['description'] = null;
        }

        $result = \core\Core::getInstance()->getDB()->Update('categories',
            [
                'name' => $userParams['name'],
                'description' => $userParams['description'],
            ], ['id'=>$userParams['id']]);
        return $result;
    }

    public static function updateLanguage($userParams)
    {
        if(!$userParams['name'] || $userParams['name'] == '') {
            return "Перевірте назву";
        }
        if(strlen($userParams['code']) != 2) {
            return "Перевірте код";
        }
        $result = \core\Core::getInstance()->getDB()->Update('languages',
            [
                'name' => $userParams['name'],
                'code' => $userParams['code'],
            ], ['id'=>$userParams['id']]);
        return $result;
    }

    //Получение языков
    public static function getLangAjax($params = null, $page = 1)
    {
        $ConstOffset = 5;
        $offset = ($page - 1) * $ConstOffset;


        $where = '';
        if(!empty($params['name'])){
            $where = $where . ' name like \'' . $params['name'] . '%\'';
        }
        if((!empty($params['code']) || $params['code'] === '0')  and $where != '' ){
            $where = $where . ' AND code like \'' . $params['code'] . '%\'';
        } else if(!empty($params['code']) || $params['code'] === '0'){
            $where = $where . ' code like \'' . $params['code'] . '%\'';
        }

        if($where != null){
            $languages['languages'] = \core\Core::getInstance()->getDB()->Select('languages', '*', null, $where, null, $offset, $ConstOffset);
            $languages['count'] = \core\Core::getInstance()->getDB()->Select('languages', 'Count(*) as count', null, $where, null)[0];
        }else{
            $languages['languages'] = \core\Core::getInstance()->getDB()->Select('languages', '*', null, null, null, $offset, $ConstOffset);
            $languages['count'] = \core\Core::getInstance()->getDB()->Select('languages', 'Count(*) as count', null, null, null)[0];
        }
        return $languages;
    }

    public static function getCoursAjax($params = null, $page = 1)
    {
        $ConstOffset = 5;
        $offset = ($page - 1) * $ConstOffset;

        $where = '';
        if(!empty($params['name'])){
            $where = $where . ' name like \'' . $params['name'] . '%\'';
        }
        if((!empty($params['description']) || $params['description'] === '0')  and $where != '' ){
            $where = $where . ' AND description like \'' . $params['description'] . '%\'';
        } else if(!empty($params['description']) || $params['description'] === '0'){
            $where = $where . ' description like \'' . $params['code'] . '%\'';
        }

        if($where != null){
            $category['category'] = \core\Core::getInstance()->getDB()->Select('categories', '*', null, $where, null, $offset, $ConstOffset);
            $category['count'] = \core\Core::getInstance()->getDB()->Select('categories', 'Count(*) as count', null, $where, null)[0];
        }else{
            $category['category'] = \core\Core::getInstance()->getDB()->Select('categories', '*', null, null, null, $offset, $ConstOffset);
            $category['count'] = \core\Core::getInstance()->getDB()->Select('categories', 'Count(*) as count', null, null, null)[0];
        }
        return $category;
    }



    public static function getCategoryById($id)
    {
        $result = \core\Core::getInstance()->getDB()->Select('categories', '*', ['id'=>$id]);
        return $result;
    }

    public static function getLanguageById($id)
    {
        $result = \core\Core::getInstance()->getDB()->Select('languages', '*', ['id'=>$id]);
        return $result;
    }

    public static function getDelCategById($id)
    {
        $result = \core\Core::getInstance()->getDB()->Delete('categories', ['id'=>$id]);
        return $result;
    }

    public static function getDelLanguageById($id)
    {
        $result = \core\Core::getInstance()->getDB()->Delete('languages', ['id'=>$id]);
        return $result;
    }


    public static function MakeDB(){
        global $db;
        \core\Core::getInstance()->getDB()->backup($db['host'], $db['dbname'], $db['user'], $db['password']);
    }


}