<?php

namespace models;

class Charts
{
    public static function studChart()
    {

        $join1 = " INNER JOIN courses on lessons.id_course = courses.id LEFT JOIN enrollments on courses.id = enrollments.id_course LEFT JOIN students on enrollments.id_student = students.id Inner JOIN users on students.user_id = users.id";
        $data1 = \core\Core::getInstance()->getDB()->Select('lessons', 'Count(DISTINCT lessons.id) as count, courses.name', $join1, ['users.id'=> $_SESSION['user']['id']], null, null, null, null, 'courses.id');
        foreach($data1 as $el){
            $label[] = $el['name'];
            $count[] = $el['count'];
        }
        $info['label1'] =  $label;
        $info['count1'] =  $count;

        $join2 = " INNER JOIN courses on enrollments.id_course = courses.id LEFT JOIN students on enrollments.id_student = students.id Inner JOIN users on students.user_id = users.id";
        $data2 = \core\Core::getInstance()->getDB()->Select('enrollments', 'COUNT(courses.id) as count, courses.is_active', $join2, ['users.id'=> $_SESSION['user']['id']], null, null, null, null, 'courses.is_active');
        foreach($data2 as $el){
            $label2[$el['is_active']] = $el['is_active'];
            $count2[] = $el['count'];
        }
        $info['label2'] =  $label2;
        $info['count2'] =  $count2;
        return $info;
    }

    public static function teachChart()
    {

        $join1 = " INNER JOIN courses on lessons.id_course = courses.id LEFT JOIN teachers on lessons.id_teacher = teachers.id Inner JOIN users on teachers.user_id = users.id";
        $data1 = \core\Core::getInstance()->getDB()->Select('lessons', 'Count(DISTINCT lessons.id) as count, courses.name', $join1, ['users.id'=> $_SESSION['user']['id']], null, null, null, null, 'courses.id');
        foreach($data1 as $el){
            $label[] = $el['name'];
            $count[] = $el['count'];
        }
        $info['label1'] =  $label;
        $info['count1'] =  $count;


        return $info;
    }

    public static function studAdmin()
    {
        $admin = \core\Core::getInstance()->getDB()->Select('users', 'Count(*) as count, MONTH(users.create_at) as month', null, ['role'=> 1], null, null, null, null, 'users.role, MONTH(users.create_at)');
        $teacher = \core\Core::getInstance()->getDB()->Select('users', 'Count(*) as count, MONTH(users.create_at) as month', null, ['role'=> 2], null, null, null, null, 'users.role, MONTH(users.create_at)');
        $student = \core\Core::getInstance()->getDB()->Select('users', 'Count(*) as count, MONTH(users.create_at) as month', null, ['role'=> 3], null, null, null, null, 'users.role, MONTH(users.create_at)');

        $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        foreach($admin as $el){
            $label_admin[] = $el['month'];
            $count_admin[$month[$el['month']]] = $el['count'];
        }
        $info['label_admin'] =  $label_admin;
        $info['count_admin'] =  $count_admin;

        foreach($teacher as $el){
            $label_teacher[] = $el['month'];
            $count_teacher[$month[$el['month']]] = $el['count'];
        }

        $info['label_teacher'] =  $label_teacher;
        $info['count_teacher'] =  $count_teacher;

        foreach($student as $el){
            $label_student[] = $el['month'];
            $count_student[$month[$el['month']]] = $el['count'];
        }
        $info['label_student'] =  $label_student;
        $info['count_student'] =  $count_student;

        $money = \core\Core::getInstance()->getDB()->Select('enrollments', 'SUM(enrollments.payment) as sum, MONTH(enrollments.date_payment) as month', null, null, null, null, null, null, 'MONTH(enrollments.date_payment)');
        foreach($money as $el){
            $count_money[$month[$el['month']]] = $el['sum'];
        }
        $info['count_money'] =    $count_money;

        return $info;
    }



}