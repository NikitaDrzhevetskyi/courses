<?php

namespace models;

class Teacher
{
    public static function getInfo()
    {
        $join = "INNER JOIN teachers on users.id = teachers.user_id";
        $fields = ['teachers.hireDate as date',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.gender as gender',
            'users.date_birth as date_birth',
            'users.email as email',
            'users.telephone as telephone'];
        return \core\Core::getInstance()->getDB()->Select('users', $fields, $join, ['users.id' => $_SESSION['user']['id']])[0];
    }


    public static function getCourses($params = null, $page = 1)
    {
        $ConstOffset = 10;
        $offset = ($page - 1) * $ConstOffset;

        $join = "INNER JOIN lessons on teachers.id = lessons.id_teacher INNER JOIN courses on lessons.id_course = courses.id INNER JOIN categories on courses.category = categories.id INNER JOIN levels on courses.level = levels.id INNER JOIN languages on courses.language = languages.id  ";
        $fields = [' DISTINCT courses.id as id',
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

        if ($params != '') {
            $params = $params . ' AND teachers.user_id = ' . $_SESSION['user']['id'];
        } else {
            $params = $params . ' teachers.user_id = ' . $_SESSION['user']['id'];
        }
        $user['course'] = \core\Core::getInstance()->getDB()->Select('teachers', $fields, $join, $params, null, $offset, $ConstOffset);

        if($params != null){
            $user['count'] = \core\Core::getInstance()->getDB()->Select('teachers', 'Count(DISTINCT courses.id) as count', $join, $params, null)[0];
        }else{
            $user['count'] = \core\Core::getInstance()->getDB()->Select('teachers', 'Count(DISTINCT courses.id) as count', $join, null, null)[0];
        }
        return $user;
    }

    public static function getLessons($id, $param)
    {
        $join = " INNER JOIN teachers on lessons.id_teacher = teachers.id INNER JOIN users on teachers.user_id = users.id";
        if ($param != null) {
            return \core\Core::getInstance()->getDB()->Select('lessons', '*', $join, $param, 'start');
        }
        return \core\Core::getInstance()->getDB()->Select('lessons', '*', $join, ['id_course' => $id], 'start');
    }


    public static function getDISTINCTLessonsTime($id, $param)
    {
        $join = " INNER JOIN teachers on lessons.id_teacher = teachers.id INNER JOIN users on teachers.user_id = users.id";
        if ($param != null) {
            return \core\Core::getInstance()->getDB()->Select('lessons', 'DISTINCT start', $join, $param, 'start');
        }
        return \core\Core::getInstance()->getDB()->Select('lessons', 'DISTINCT start', $join, ['id_course' => $id], 'start');
    }

    public static function getAllStudents($id)
    {
        $join = " INNER JOIN students on users.id = students.user_id INNER JOIN enrollments on students.id = enrollments.id_student";
        $fields = [
            'DISTINCT users.id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.gender as gender',
            'users.date_birth as date_birth',
            'users.email as email',
            'users.telephone as telephone'
        ];
        return \core\Core::getInstance()->getDB()->Select('users', $fields, $join, ['id_course' => $id, 'role' => '3', 'students.is_active' => '1']);
    }

    public static function getStudents($params)
    {
        $join = " INNER JOIN students on users.id = students.user_id INNER JOIN enrollments on students.id = enrollments.id_student";

        $fields = [
            'DISTINCT users.id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.gender as gender',
            'users.date_birth as date_birth',
            'users.email as email',
            'users.telephone as telephone'
        ];
        $course['id'] = $params['id_course'];
        $params = \models\Teacher::getWhereString($params);

        if($params != ''){
            $params = $params . ' AND users.role = 3 AND students.is_active = 1 AND id_course = ' . $course['id'];
        } else {
            $params = $params . ' users.role = 3 AND students.is_active = 1 AND id_course = ' . $course['id'];;
        }

        return \core\Core::getInstance()->getDB()->Select('users', $fields, $join, $params);

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
            $where = $where . ' AND users.gender = ' . $params['gender'];
        } else if (!empty($params['gender'])) {
            $where = $where . ' users.gender = ' . $params['gender'];
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

        return $where;

    }



    public static function getInfoLessons($id)
    {
        $join = "INNER JOIN teachers on lessons.id_teacher = teachers.id INNER JOIN users on teachers.user_id = users.id";
        $fields = ['lessons.start as start',
            'lessons.finish as finish',
            'lessons.type as type',
            'lessons.link as link',
            'lessons.description as description',
            'lessons.id as id',
            'users.id as id_user'];
        return \core\Core::getInstance()->getDB()->Select('lessons', $fields, $join, ['lessons.id' => $id])[0];
    }

    public static function upd($lessonParams)
    {
        if($lessonParams['start'] == null){
            return "Перевірте дату";
        }
        if($lessonParams['finish'] == null){
            return "Перевірте дату";
        }
        if($lessonParams['finish'] <= $lessonParams['start']){
            return "Перевірте дату";
        }
        if($lessonParams['link'] == null){
            return "Перевірте посилання";
        }

        $result = \core\Core::getInstance()->getDB()->Update('lessons',
            [
                'start' => $lessonParams['start'],
                'finish' => $lessonParams['finish'],
                'type' => $lessonParams['type'],
                'link' => $lessonParams['link'],
                'description' => $lessonParams['description'],
                'updated_at' => date_create()->format('Y-m-d H:i:s'),
            ], ['id' => $lessonParams['id']]);
        return $result;
    }


}