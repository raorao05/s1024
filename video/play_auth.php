<?php

include_once('ganon.php');
include_once('../wp-config.php');
header("Content-type: text/html; charset=utf-8");

//获取必要的参数
$pid = isset($_REQUEST['pid']) ? $_REQUEST['pid'] : false; //文章id
if(!$pid)
{
    $response = array(
        'err' => 1,
        'status' => '0000',
        'msg' => '文章id不能为空'
    );
    echo json_encode($response);
    exit;
}
else
{
    $pid = trim($pid);
}



//获取登录状态
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$db->query("SET NAMES utf8");


/*
$user_info = isset($_SESSION['user_info']) ? $_SESSION['user_info'] : false;
if($user_info)
{
    $user_info = unserialize(serialize($user_info));
    $user_info = json_decode(json_encode($user_info),true);
    if(isset($user_info['errors']))
    {
        need_login();
    }

    $user_id = $user_info['ID'];
    //$sql = "SELECT * FROM wp_vip WHERE uid = {$user_id}";

    //查询用户是否具备vip身份
    $is_vip = false;
    $sql = "SELECT * FROM wp_order WHERE uid={$user_id} AND product='vip' AND status='finish'";
    $result = $db->query($sql);
    if ($result && $result->num_rows > 0)
    {
        $is_vip = true;
        /*
        while ($row = $result->fetch_array()) {
            //判断是否过期
            $is_expired = time() - $row['expire_time'];
            if ($is_expired < 0) {
                $is_vip = true;
            }
        }

    }
    if ($is_vip)
    {
        allow();
    }
    else
    {
        //查询用户是否单点购买了产品
        $is_single = false;
        $pid = addslashes($pid);
        $sql = "SELECT * FROM wp_order WHERE uid={$user_id} AND pid={$pid} AND status='finish' AND product = 'vod'";
        $result = $db->query($sql);
        if ($result && $result->num_rows > 0)
        {
            $is_single = true;
            /*
            while ($row = $result->fetch_array()) {
                $expires = $row['expires'];
                if ((time() - $expires) < 0) {
                    $is_single = true;
                    break;
                }
            }

        }
        if ($is_single)
        {
            allow();
        }
        else
        {
            shikan();
        }
    }
}
else
{
    need_login();

}
*/


shikan();

//返回试看结果
function shikan()
{
    $video_info = get_video_info();
    $response = array(
        'err' => 0,
        'status' => '0000',
        'msg' => array(
            'pass' => 0,
            'magnet' => $video_info['magnet'],
            'video_url' => $video_info['url'],
            'video_title' => $video_info['title']
        )
    );
    echo json_encode($response);
    exit;
}





//返回正式结果
function allow()
{
   $video_info = get_video_info();
    $response = array(
        'err' => 0,
        'status' => '0000',
        'msg' => array(
            'pass' => 1,
            'video_url' => $video_info['url'],
            'video_title' => $video_info['title']
        )
    );
    echo json_encode($response);
    exit;
}

function need_login()
{
    $response = array(
        'err' => 1,
        'status' => '0001',
        'msg' => '账号未登录,请先登录再观看'
    );
    echo json_encode($response);
    exit;
}


//获取视频信息
function get_video_info()
{
    //获取视频的正式地址
    global $pid,$db;
    $pid = addslashes($pid);
    $sql = "SELECT meta_value FROM wp_postmeta WHERE post_id='{$pid}' AND meta_key='play_info'";

    $result = $db->query($sql);
    if ($result && $result->num_rows > 0)
    {
        while ($row = $result->fetch_array())
        {
            $video_info = $row['meta_value'];
            $video_info = json_decode($video_info,true);
        }
    }
    else
    {
        $video_info = array(
            'source' => 'apiv.ga',
            'code' => '3b88883cfa4f39622ad0964ab87d4ef7bf99c8f0',
            'magnet' => 'magnet:?xt=urn:btih:3b88883cfa4f39622ad0964ab87d4ef7bf99c8f0',
            'url' => 'http://tj.btfs.ftn.apiv.ga/ftn_handler/29b69bd86adf2a6c271e73446dd8e29f3b0e86bb3ebbd5d96f574e2847ac346e86542096315851fc66b99e14236eeffcc5f866190da2b969ce75f63cedb1f2e4/apiv.ga.mkv'
        );
    }

    //暂时只抓取 一家的播放串
    if($video_info['source'] == 'apiv.ga')
    {
        if(isset($video_info['url']) && $video_info['url'])
        {
            if(isset($video_info['expire']) && $video_info['expire'])
            {
                $time = time() - $video_info['expire'];
                if($time > 0)
                {
                    $video_info = get_play_url_from_remote($video_info);
                }
            }
            else
            {
                $video_info = get_play_url_from_remote($video_info);
            }
        }
        else
        {
            $video_info = get_play_url_from_remote($video_info);

        }

    }

    $title = '';
    $pid = addslashes($pid);
    $sql = "SELECT * FROM wp_posts WHERE  id='{$pid}'";
    $result = $db->query($sql);
    if ($result && $result->num_rows > 0)
    {
        while ($row = $result->fetch_array())
        {
            $title = $row['post_title'];
        }
    }


    return array(
        'title' => $title,
        'url' => $video_info['url'],
        'magnet' => $video_info['magnet']
    );
}


/**
 * 获取远端的播放串
 * @return mixed
 */
function get_play_url_from_remote($video_info)
{
    $video_info['url'] = '';
    if($video_info['source'] == 'apiv.ga')
    {
        $remote_url = 'http://apiv.ga/magnet/' . $video_info['code'];
        for ($i = 0; $i < 3; $i++)
        {
            $html = file_get_dom($remote_url);
            if($html)
            {
                foreach ($html('a[id="logo"]') as $element) {
                    $video_info['url'] = $element->href;
                    break;
                }
            }

        }
        if ($video_info['url'])
        {
            global $pid, $db;
            $pid = addslashes($pid);
            $video_info['expire'] = time() + 10 * 60 * 60; //缓存10个小时
            $value = json_encode($video_info);
            $sql = "UPDATE wp_postmeta SET meta_value = '{$value}' WHERE post_id='{$pid}' AND meta_key='play_info'";
            $db->query($sql);
        }
    }
    return $video_info;
}