<?
$db_qr = new db_query("SELECT * FROM `newstable` WHERE Type = '201' AND IsActive='1'");
if(mysql_num_rows($db_qr->result) > 0)
    {
        $row=mysql_fetch_assoc($db_qr->result);
?>
<div style="float:left;width:100%;">
            <?=$row['Description']?>
        </div>
<?  }
?>