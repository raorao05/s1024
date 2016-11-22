<?php

/**
 * 批量创建兑换码,并导出为txt文件
 * 兑换码规则为 type + code + hash校验值
 *     type = 1 为单点券 ; type=2 为vip券
 *     code为随机生成的8位字符串
 *     hash = sha1(type+code+key)
 */


include_once('../wp-config.php');
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);




/**
 * 生成单点券并导入到数据库
 */
function createVod($num){
    global $db;
    for($i=0;$i<$num;$i++){
        $code = getRandChar(8);
        $hash = sha1('1' . $code . SHA1_KEY);
        $real_code = '1' . $code . $hash;
        $create_time = date('Y-m-d H:i:s',time());
        $sql = "INSERT INTO wp_code (ctype,code,status,create_time,use_time,amount) VALUES (1,'{$real_code}',0,'{$create_time}','',2)";
        $db->query($sql);
        if(mysqli_insert_id($db)){
            file_put_contents('vod.txt',$real_code."\n",FILE_APPEND);
        }else{
            echo 'insert error'.'<br>';
        }
    }
}

/**
 * 生成vip券并导入到数据库
 */
function createVip($num){
    global $db;
    for($i=0;$i<$num;$i++){
        $code = getRandChar(8);
        $hash = sha1('2' . $code . SHA1_KEY);
        $real_code = '2' . $code . $hash;
        $create_time = date('Y-m-d H:i:s',time());
        $sql = "INSERT INTO wp_code (ctype,code,status,create_time,use_time,amount) VALUES (2,'{$real_code}',0,'{$create_time}','',28)";
        $db->query($sql);
        if(mysqli_insert_id($db)){
            file_put_contents('vip.txt',$real_code."\n",FILE_APPEND);
        }else{
            echo 'insert error'.'<br>';
        }
    }

}



function getRandChar($length){
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol)-1;

    for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
    }

    return $str;
}


createVod(10);
createVip(10);