<?php
class MysqlORMExtraParams 
{
    /**
    * Generate params to sql query
    */
    public static function extraParams(Array $params)
    {
        $sql = '';

        // ORDER ['order'=>'created_at DESC']
        if (isset($params['order'])) {
            $sql .= ' ORDER BY ' . $params['order'];
        }

        // LIMIT ['limit'=>10, 'page'=>2]
        if (isset($params['limit'])) {
            $page = (int)($params['page'] ?? 1);
            $limit = $params['limit'];
            $startpoint = ($page * $limit) - $limit;
            $sql .= ' LIMIT ' . $startpoint . ', ' . $limit;
        }

        return $sql;
    }
}