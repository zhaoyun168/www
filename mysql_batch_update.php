<?php

/**
 * 批量更新函数
 * @param $table_name string 表名
 * @param $data array 待更新的数据，二维数组格式
 * @param array $params array 值相同的条件，键值对应的一维数组
 * @param string $field string 值不同的条件，默认为id
 * @return bool|string
 */
function batchUpdate($table_name, $data, $field, $params = [])
{
   if (!is_array($data) || !$field || !is_array($params)) {
      return false;
   }

    $updates = parseUpdate($data, $field);
    $where = parseParams($params);

    $fields = array_column($data, $field);
    $fields = implode(',', array_map(function($value) {
        return "'".$value."'";
    }, $fields));

    $sql = sprintf("UPDATE `%s` SET %s WHERE `%s` IN (%s) %s", $table_name, $updates, $field, $fields, $where);

   return $sql;
}

/**
 * 将二维数组转换成CASE WHEN THEN的批量更新条件
 * @param $data array 二维数组
 * @param $field string 列名
 * @return string sql语句
 */
function parseUpdate($data, $field)
{
    $sql = '';
    $keys = array_keys(current($data));
    foreach ($keys as $column) {

        $sql .= sprintf("`%s` = CASE `%s` \n", $column, $field);
        foreach ($data as $line) {
            $sql .= sprintf("WHEN '%s' THEN '%s' \n", $line[$field], $line[$column]);
        }
        $sql .= "END,";
    }

    return rtrim($sql, ',');
}

/**
 * 解析where条件
 * @param $params
 * @return array|string
 */
function parseParams($params)
{
   $where = [];
   foreach ($params as $key => $value) {
      $where[] = sprintf("`%s` = '%s'", $key, $value);
   }
   
   return $where ? ' AND ' . implode(' AND ', $where) : '';
}


$data = [
    ['id' => 31083, 'update_time' => 1600419663, 'create_time' => 1600419663, 'status' => 2],
    ['id' => 31084, 'update_time' => 1600419663, 'create_time' => 1600419663, 'status' => 2],
    ['id' => 31085, 'update_time' => 1600419663, 'create_time' => 1600419663, 'status' => 2],
    ['id' => 31086, 'update_time' => 1600419663, 'create_time' => 1600419663, 'status' => 2],
    ['id' => 31087, 'update_time' => 1600419663, 'create_time' => 1600419663, 'status' => 2],
];


echo batchUpdate('yb_hospital_schedule_sequence', $data, 'id', $params = []);