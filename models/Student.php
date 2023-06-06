<?php

namespace models;

class Student
{
    /**
     * Особисті дані студента
     */
    public static function getInfo()
    {
        $join = "INNER JOIN students on users.id = students.user_id";
        $fields = ['students.enrollmentDate as date',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.gender as gender',
            'users.date_birth as date_birth',
            'users.email as email',
            'users.telephone as telephone'];
        return \core\Core::getInstance()->getDB()->Select('users', $fields, $join, ['users.id' => $_SESSION['user']['id']])[0];
//        return \core\Core::getInstance()->getDB()->Select('users', '*', null, ['users.id' => $_SESSION['user']['id']])[0];
    }


    public static function getCourses($params = null, $page = 1)
    {
        $ConstOffset = 10;
        $offset = ($page - 1) * $ConstOffset;

        $join = "INNER JOIN enrollments on courses.id = enrollments.id_course INNER JOIN categories on courses.category = categories.id INNER JOIN levels on courses.level = levels.id INNER JOIN languages on courses.language = languages.id ";
        $join2 = " INNER JOIN users on students.user_id = users.id";

        $id_stud = \core\Core::getInstance()->getDB()->Select('students', 'students.id', $join2, ['users.id'=>$_SESSION['user']['id']])[0]['id'];
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
            'enrollments.success as success',
            'enrollments.type_payment as type_payment'];

        $params = \models\Student::getWhereString($params);

        if($params != ''){
            $params = $params . ' AND enrollments.id_student = ' . $id_stud;
        } else {
            $params = $params . ' enrollments.id_student = ' . $id_stud;
        }
        $user['course'] = \core\Core::getInstance()->getDB()->Select('courses', $fields, $join, $params, null, $offset, $ConstOffset);
        if($params != null){
            $user['count'] = \core\Core::getInstance()->getDB()->Select('courses', 'Count(*) as count', $join, $params, null)[0];
        }else{
            $user['count'] = \core\Core::getInstance()->getDB()->Select('courses', 'Count(*) as count', $join, null, null)[0];
        }
        return $user;
    }

    public static function getWhereString($params)
    {
        $where = '';
        if(!empty($params['courses_name'])){
            $where = $where . ' courses.name like \'' . $params['courses_name'] . '%\'';
        }

        if((!empty($params['courses_language']) || $params['courses_language'] === '0')  and $where != '' ){
            $where = $where . ' AND courses.language = ' . $params['courses_language'];
        } else if(!empty($params['courses_language']) || $params['courses_language'] === '0'){
            $where = $where . ' courses.language = ' . $params['courses_language'];
        }

        if(!empty($params['courses_category'] || $params['courses_category'] === '0') and $where != '' ){
            $where = $where . ' AND courses.category = ' . $params['courses_category'];
        } else if(!empty($params['courses_category']) || $params['courses_category'] === '0'){
            $where = $where . ' courses.category = ' . $params['courses_category'];
        }

        if(!empty($params['courses_level'] || $params['courses_level'] === '0') and $where != '' ){
            $where = $where . ' AND courses.level = ' . $params['courses_level'];
        } else if(!empty($params['courses_level']) || $params['courses_level'] === '0'){
            $where = $where . ' courses.level = ' . $params['courses_level'];
        }

        if(!empty($params['courses_lessons']) and $where != '' ){
            $where = $where . ' AND courses.lessons like \'' . $params['courses_lessons'] . '%\'';
        } else if(!empty($params['courses_lessons'])){
            $where = $where . ' courses.lessons like \'' . $params['courses_lessons'] . '%\'';
        }

        if(!empty($params['courses_price']) and $where != '' ){
            $where = $where . ' AND courses.price like \'' . $params['courses_price'] . '%\'';
        } else if(!empty($params['courses_price'])) {
            $where = $where . ' courses.price like \'' . $params['courses_price'] . '%\'';
        }

        if(!empty($params['courses_start']) and $where != '' ){
            $where = $where . ' AND courses.start = \'' . $params['courses_start'] . '\'';
        } else if(!empty($params['courses_start'])) {
            $where = $where . ' courses.start = ' . $params['courses_start'];
        }

        if(!empty($params['courses_finish']) and $where != '' ){
            $where = $where . ' AND courses.finish = \'' . $params['courses_finish'] . '\'';
        } else if(!empty($params['courses_finish'])){
            $where = $where . ' courses.finish = \'' . $params['courses_finish'] . '\'';
        }

        if( (!empty($params['enrollments_success']) || $params['enrollments_success'] === '0') and $where != '' ){
            $where = $where . ' AND enrollments.success = ' . $params['enrollments_success'];
        } else if(!empty($params['enrollments_success']) || $params['enrollments_success'] === '0'){
            $where = $where . ' enrollments.success = ' . $params['enrollments_success'];
        }

        if( (!empty($params['enrollments_type_payment']) || $params['enrollments_type_payment'] === '0') and $where != '' ){
            $where = $where . ' AND enrollments.type_payment = ' . $params['enrollments_type_payment'];
        } else  if(!empty($params['enrollments_type_payment']) || $params['enrollments_type_payment'] === '0'){
            $where = $where . ' enrollments.type_payment = ' . $params['enrollments_type_payment'];
        }

        if( (!empty($params['courses_active']) || $params['courses_active'] === '0') and $where != '' ){
            $where = $where . ' AND courses.is_active = ' . $params['courses_active'];
        } else  if(!empty($params['courses_active']) || $params['courses_active'] === '0'){
            $where = $where . ' courses.is_active = ' . $params['courses_active'];
        }
        if( (!empty($params['gender']) || $params['gender'] === '0') and $where != '' ){
            $where = $where . ' AND users.gender = \'' . $params['gender'] . '\'';
        } else  if(!empty($params['gender']) || $params['gender'] === '0'){
            $where = $where . ' users.gender = \'' . $params['gender'] . '\'';
        }

        return  $where;
    }


    public static function getCourse($id)
    {
        $join = " LEFT JOIN categories on courses.category = categories.id "
            . "LEFT JOIN levels on courses.level = levels.id LEFT JOIN languages on courses.language = languages.id"
            . " LEFT JOIN lessons on courses.id = lessons.id_course";

        $fields = [
            'courses.name as name',
            'languages.name as language',
            'levels.name as level',
            'categories.name as category',
            'courses.lessons as lessons',
            'courses.price as price',
            'courses.start as start',
            'courses.finish as finish',
            'courses.description as description'
            ];

        return \core\Core::getInstance()->getDB()->Select('courses', $fields, $join, ['courses.id'=>$id]);
    }


    public static function ChesckedUser($id)
    {
        $join2 = " INNER JOIN students on enrollments.id_student = students.id";
        $fields = [
            ' enrollments.success',
        ];
        return \core\Core::getInstance()->getDB()->Select('enrollments', $fields, $join2, ['user_id'=>$_SESSION['user']['id'], 'id_course'=>$id], null, null, 1)[0]['success'];
    }

    public static function getLessons($id, $param)
    {
        $join = " INNER JOIN teachers on lessons.id_teacher = teachers.id INNER JOIN users on teachers.user_id = users.id";
        if($param != null){
            return \core\Core::getInstance()->getDB()->Select('lessons', '*', $join, $param, 'start');
        }
        return \core\Core::getInstance()->getDB()->Select('lessons', '*', $join, ['id_course'=> $id], 'start');
    }




    public static function getDISTINCTLessonsTime($id, $param)
    {
        $join = " INNER JOIN teachers on lessons.id_teacher = teachers.id INNER JOIN users on teachers.user_id = users.id";
        if($param != null){
            return \core\Core::getInstance()->getDB()->Select('lessons', 'DISTINCT start', $join, $param, 'start');
        }
        return \core\Core::getInstance()->getDB()->Select('lessons', 'DISTINCT start', $join, ['id_course'=> $id], 'start');
    }

    public static function getTeachers($id)
    {
        $join = " INNER JOIN lessons on teachers.id = lessons.id_teacher INNER JOIN users on teachers.user_id = users.id";
        $fields = [
            'DISTINCT users.id',
            'lessons.id_teacher as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
        ];
        return \core\Core::getInstance()->getDB()->Select('teachers', $fields, $join, ['id_course'=>$id]);
    }

    public static function deleteCourseStudent($id)
    {
        return \core\Core::getInstance()->getDB()->Update('enrollments', ['success' => 0, 'updated_at'=>date_create()->format('Y-m-d H:i:s')], ['id_course'=>$id, 'id_student'=>$_SESSION['user']['id']]);
    }

}