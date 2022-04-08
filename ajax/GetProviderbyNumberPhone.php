<?php

/**
 * @author GallerySoft.info
 * @copyright 2018
 */
if(isset($_POST)){
    $typehinhthuc=1;
    $number = getValue("number","str","POST","");
    $number = replaceMQ(trim($number));
   	$typenap = getValue("typenap","str","POST","");
   	$typenap = replaceMQ(trim($typenap)); 
    $startPhone = substr($number,0,3);
    if(!empty($number) && (strlen($number)> 4)){
        switch (strlen($number))
                {
                    case 10:
                        $startPhone = substr($number,0,3);
                        break;
                    case 11:
                        $startPhone=substr($number,0,4);
                        break;
                    default:
                        return "";
                }
                switch($startPhone)
                {
                    
                }
    }        

            $chietkhau = 0;
}


?>