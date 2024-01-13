<?php
require_once '../Connection/Connection.php';
require_once '../Connection/MyConnection.php';


/**
 * 取得取名人數前10多的名字
 *
 * @param integer $limit
 * @return void
 */
function getLimitData() {

    /**
     * code 1 撰寫取得連線方法
     */
    $pgConn = Connection::getConnection();

    $result = [
        'code' => 200,
        'msg'  => 'success'
    ];

    /**
     * code 2 撰寫SQL，從資料表內取得前10個同名人數(count)最多的姓名資料
     * 使用 SELECT 、 FROM 、 ORDER BY 、LIMIT 、 GREATEST(取出最大值)、DESC等關鍵字完成SQL
     */
    $sql = "SELECT * FROM genderbyname ORDER BY GREATEST(count) DESC LIMIT 10";

    $stmt = $pgConn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($row) {
        $result['data'] = $row;
    }else {
        $result['code'] = 404;
        $result['msg']  = "error";
        $result['data'] = [];
    }
    return json_encode($result);
}

/**
 * 搜尋名字
 *
 * @param string $name
 * @param string $gender
 * @return void
 */
function search($name = null, $gender = '') {
    /**
     * code 1 撰寫取得連線方法
     */
    $pgConn = Connection::getConnection();

    $result = [
        'code' => 200,
        'msg'  => 'success'
    ];

    /**
     * code 2 撰寫SQL，從資料表內取得某個人名與性別的姓名資料
     * 使用 SELECT 、 FROM 、 WHERE AND 等關鍵字完成SQL
     * 需使用資料綁定方式傳入參數，如果你忘記如何實作的話可參考 https://shorturl.at/gluzC，lesson2資料夾內的"大數據2.pdf"第16頁
     */
    $sql = "SELECT * FROM genderbyname WHERE name = :name AND gender = :gender";
    
    $stmt = $pgConn->prepare($sql);
   
    /**
     * code 3 使用 bindValue 實作name欄位的資料綁定
     */

    $stmt->bindValue(':gender',$gender);
    $stmt->bindValue(':name',$name);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $result['data'][] = [
            'name' => $row['name'],
            'gender' => $row['gender'],
            'count' => $row['count'],
            'probability' => $row['probability'],
        ];
    }else {
        $result['code'] = 404;
        $result['msg']  = "error";
        $result['data'] = [];
    }

    return json_encode($result);
}


/**
 * 自訂的API方法
 *
 * @return void
 */
function myAPImethod() {

    #Todo : ur api logic    

}
?>