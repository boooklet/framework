<?php
class MysqlORMQueryString
{
    public static function where($table_name, $query, $params = [])
    {
        if (isset($params['count'] == true)) {
            $query_string = 'SELECT count(*) FROM `' . $table_name . '`';
        } else {
            $query_string = 'SELECT `' . $table_name.'`.* FROM `' . $table_name . '`';
        }

        if ($query != '') {
            $query_string .= " WHERE " . $query;
        }

        return $query_string;
    }
}