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

function jsonKeyClear($json)
{  //去掉jsonKey的引号，适应js数据格式
    $json = preg_replace('/"(\w+)"(\s*:\s*)/is', '$1$2', $json);   //去掉key的双引号
    return $json;
}

$arrTodo = array();
if (!empty($_GET['option'])) {
    switch ($_GET['option']) {
        case 'getodo':
            $stmt = $pdo->prepare("SELECT id,todo,status,start FROM $tableName WHERE name = :name AND status IN (0,1) ORDER BY id DESC");
            $stmt->execute(array('name' => 'lifanko'));

            foreach ($stmt as $note) {
                $buffer = [];
                $buffer['id'] = $note['id'];
                $buffer['label'] = $note['todo'];
                $buffer['done'] = boolval($note['status']);
                $buffer['start'] = $note['start'];
                array_push($arrTodo, $buffer);
            }
            break;
        case 'new':
            $start = time();

            $stmt = $pdo->prepare("INSERT INTO $tableName (name,todo,status,start) VALUES (:name, :todo, :status, :start)");
            $stmt->execute(array('name' => 'lifanko', 'todo' => $_GET['item'], 'status' => 0, 'start' => $start));

            $arrTodo['id'] = $pdo->lastInsertId();
            $arrTodo['label'] = $_GET['item'];
            $arrTodo['done'] = 0;
            $arrTodo['start'] = $start;

            break;
        case 'done':
            $stmt = $pdo->prepare("UPDATE $tableName SET status = :status, end = :end WHERE id = :id");
            $arrTodo['result'] = $stmt->execute(array('status' => intval($_GET['status']), 'end' => time(), 'id' => $_GET['id']));

            break;
        case 'del':
            $arrTodo['result'] = 'delete';
            $stmt = $pdo->prepare("UPDATE $tableName SET status = :status WHERE id = :id");
            $arrTodo['result'] = $stmt->execute(array('status' => $_GET['status'], 'id' => $_GET['id']));

            break;
        default:
            $arrTodo['result'] = 'none';

            break;
    }

    echo jsonKeyClear(json_encode($arrTodo));
}
