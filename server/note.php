<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/31
 * Time: 18:34
 */
header("Content-type: text/html;charset=utf-8");

$tableName = "note";

try {   //创建pdo连接对象，全局使用
    $pdo = new PDO("mysql:host=localhost;dbname=lifanko", "root", "");
} catch (PDOException $e) {
    die("Unable to connect to the database, please contact manager: lifankohome@163.com");
}
$pdo->query("set names utf8");

$sql = "SELECT todo,status,start FROM $tableName WHERE name='lifanko'";

$arrTodo = array();
foreach ($pdo->query($sql) as $note) {
    $buffer = [];
    $buffer['label'] = $note['todo'];
    $buffer['done'] = boolval($note['status']);
    $buffer['start'] = $note['start'];
    array_push($arrTodo, $buffer);
}
echo jsonKeyClear(json_encode($arrTodo));

function jsonKeyClear($json)
{  //去掉jsonKey的引号，适应js数据格式
    $json = preg_replace('/"(\w+)"(\s*:\s*)/is', '$1$2', $json);   //去掉key的双引号
    return $json;
}