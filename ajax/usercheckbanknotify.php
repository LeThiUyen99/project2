<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");

require_once '../functions/FunctionUser.php';
if(isset($_POST)){
    if(isset($_SESSION['UserInfo']))
    {
        $udata = $_SESSION['UserInfo'];
        $userid=$udata['UserId'];
        $bankcode="";
        $result=CheckBankSendNotify($userid,$bankcode);
        echo json_encode($result);
    }else{
        $bankcode="";
        $result=CheckBankSendNotify(14,$bankcode);
        echo json_encode($result);
    }
}

?>