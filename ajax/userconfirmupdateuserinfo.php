<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

include("config.php");

require_once '../functions/247User.php';
if(isset($_POST))
{
    $code = getValue("c","str","POST","");
    $code = trim(replaceMQ($code));
    $code = removeHTML($code);
    $username = getValue("u","str","POST","");
    $username = trim(replaceMQ($username));
    $username=removeHTML($username);   
    //$udata = $_SESSION['UserInfo'];
    //$userid=$udata['UserId'];
    $result=updateuserinfo($code,$username);
    echo json_encode($result);
    
}

?>