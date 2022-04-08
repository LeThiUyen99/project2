<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");

require_once '../functions/FunctionUser.php';
if(isset($_POST))
{
    $BankNumber = getValue("BankNumber","str","POST","");
    $BankNumber = trim(replaceMQ($BankNumber));
    $BankNumber = removeHTML($BankNumber);
    $BankAccount = getValue("BankAccount","str","POST","");
    $BankAccount = trim(replaceMQ($BankAccount));
    $BankAccount=removeHTML($BankAccount);   
    $BankCode = getValue("BankCode","str","POST","");
    $BankCode = trim(replaceMQ($BankCode));
    $BankCode=removeHTML($BankCode);
    $BankBranch = getValue("BankBranch","str","POST","");
    $BankBranch = trim(replaceMQ($BankBranch));
    $BankBranch=removeHTML($BankBranch);
    $Name = getValue("Name","str","POST","");
    $Name = trim(replaceMQ($Name));
    $Name=removeHTML($Name);
    $Address = getValue("Address","str","POST","");
    $Address = trim(replaceMQ($Address));
    $Address=removeHTML($Address);
    $Phone = getValue("Phone","str","POST","");
    $Phone = trim(replaceMQ($Phone));
    $Phone=removeHTML($Phone);
    if(isset($_SESSION['UserInfo']))
    {
        $udata = $_SESSION['UserInfo'];
        $userid=$udata['UserId'];
        //var_dump($BankNumber,$BankAccount,$BankCode,$BankBranch,$Name,$Address,$Phone);die();
        $result=updateuserinfoNotConfirm($userid,$BankNumber,$BankAccount,$BankCode,$BankBranch,$Name,$Address,$Phone);
        echo json_encode($result);
    }
}

?>