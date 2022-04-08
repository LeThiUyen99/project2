<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");

require_once '../functions/247User.php';
if(isset($_SESSION['UserInfo']))
    {
        $udata = $_SESSION['UserInfo'];
        $userid=$udata['UserId'];
        $userinfo=GetUserInfo($userid);
        if(count($userinfo) > 0){
            $kq=array("Success"=>true,"uinfo"=>$userinfo);
            echo json_encode($kq);
        }
        
        }

?>