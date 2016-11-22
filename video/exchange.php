<?php


include_once('../wp-config.php');
header("Content-type: text/html; charset=utf-8");



//获取必要的参数
$pid = isset($_REQUEST['pid']) ? $_REQUEST['pid'] : false; //文章id
if(!$pid){
    $response = array(
        'err' => 1,
        'status' => '0000',
        'msg' => '文章id不能为空'
    );
    echo json_encode($response);
    exit;
}else{
    $pid = trim($pid);
}

$code = isset($_REQUEST['code']) ? $_REQUEST['code'] : false; //兑换码
if(!$code){
    $response = array(
        'err' => 1,
        'status' => '0000',
        'msg' => '兑换码不能为空'
    );
    echo json_encode($response);
    exit;
}else{
    $code = trim($code);
}



//兑换码算法校验
checkCode();



//获取登录状态
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$user_info = isset($_SESSION['user_info']) ? $_SESSION['user_info'] : false;

if($user_info) {
    $user_info = unserialize(serialize($user_info));
    $user_info = json_decode(json_encode($user_info), true);
    if (isset($user_info['errors'])) {
        need_login();
    }else{
        //查询观影券是否有效,如果有效则生成订单,并把观影券置为已使用状态
        $code = addslashes($code);
        $sql = "SELECT * FROM wp_code WHERE code='{$code}'";
        $result = $db->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                $ctype = $row['ctype'];
                $status = $row['status'];
                $amount = $row['amount'];
                break;
            }
            if($status == 0){ //卡正常

                //卡号置为已使用
                $use_time = date("Y-m-d H:i:s",time());
                $order_id = createOrderId();
                $sql1 = "UPDATE wp_code SET status=1,use_time='{$use_time}',order_id='{$order_id}' WHERE code='{$code}'";
                $db->query($sql1);

                //订单表里插入数据
                $uid = $user_info['data']['ID'];
                if($ctype == 1){
                    $product = 'vod';
                }elseif ($ctype == 2){
                    $product = 'vip';
                }
                $sql2 = "INSERT INTO wp_order (order_id,uid,create_time,pay_time,pid,pay_type,status,amount,product) VALUES ('{$order_id}',{$uid},'{$use_time}','{$use_time}',{$pid},'code','finish',{$amount},'{$product}')";
                $db->query($sql2);

                $response = array(
                    'err' => 0,
                    'status' => '0000',
                    'msg' => '兑换成功,即将为您播放正片'
                );
                echo json_encode($response);
                exit;
            }else{
                $response = array(
                    'err' => 1,
                    'status' => '0002',
                    'msg' => '兑换码已被使用,请购买新的兑换码'
                );
                echo json_encode($response);
                exit;
            }
        }else{
            $response = array(
                'err' => 1,
                'status' => '0003',
                'msg' => '不存在的兑换码!官网购买是获取兑换码码的唯一途径'
            );
            echo json_encode($response);
            exit;
        }
    }
}else{
    need_login();
}


function need_login(){
    $response = array(
        'err' => 1,
        'status' => '0001',
        'msg' => '账号未登录,请先登录'
    );
    echo json_encode($response);
    exit;
}




/**
 * 校验兑换码是否正确
 */
function checkCode(){
    global $code;

    $type = substr($code,0,1);
    $random = substr($code,1,8);
    $hash = substr($code,9);
    $my_sign = sha1($type . $random . SHA1_KEY);

    if($my_sign != $hash){
        $response = array(
            'err' => 1,
            'status' => '0004',
            'msg' => '兑换码不合法'
        );
        echo json_encode($response);
        exit;
    }
    return $type;
}

//创建订单号
function createOrderId(){
    return date('YmdHis') . str_pad(mt_rand(1, 9999999), 5, '0', STR_PAD_LEFT);
}