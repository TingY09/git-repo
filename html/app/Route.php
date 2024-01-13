<?php 
ini_set('memory_limit', '44M');
require_once '../app/API.php';

if (!is_null($_GET)) {
    $route = $_GET["route"];
    switch($route){
        case 'getLimitData' :
            /**
             * code 1 呼叫API.php中的 "取得取名人數前10多的名字" 方法
             */
            echo getLimitData();
            break;
        case 'searchName' : 
            if (!isset($_GET["name"]) || !isset($_GET["gender"])) {
                $result['code'] = 500;
                $result['msg']  = "error";
                $result['data'] = [];
                echo json_encode($result);
            }else{

                /**
                 * code 2 呼叫API.php中的 "搜尋名字" 方法，並將相關參數帶入，如人名與性別
                 */
                echo (search($_GET["name"], GET["gender"]));
            }
            break;
        // other API if u wanna try...   
        #Todo : Define your API route    
        // case 'your_route_name' : 
        //     break;
        
        default : 
            $result['code'] = 500;
            $result['msg']  = "You didn't search for anything.";
            $result['data'] = [];
            echo json_encode($result);
    }    
}
?>