<?
require_once("inc_security.php");

$list = new fsDataGird($field_id,$field_name,translate_text("Listing"));

$list->add("id","ID","string",0,0, '');

$list->add("nha_mang","Nhà mạng","string",0,0, '');
$list->add("khuyen_mai", "Khuyến mại", "string", 0, 0);
$list->add('thoi_gian', "Thời gian", "string", 0, 0);

$list->add("",translate_text("Sửa"),"edit");

$list->quickEdit 	= false;
$list->ajaxedit($fs_table);

$sql =	$list->sqlSearch();

$db_listing = new db_query("SELECT * FROM " . $fs_table . "
									");
$db_full = new db_query("SELECT * 
									 FROM " . $fs_table . "
									");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<div id="listing">
   <?=$list->showHeader($total_row)?>
   <?
   $i=0;
   while($row = mysql_fetch_assoc($db_listing->result)){
      $i++;
      
      ?>
      <?=$list->start_tr($i, $row[$id_field]);?>

         <td align="center"><?=$row['id']?></td>

         <td align="center"><?=$row['nha_mang']?></td>
   
         <td align="center"><?=$row['khuyen_mai']?></td>

         <td align="center"><?=$row['thoi_gian']?></td>

         <?=$list->showEdit($row['id'])?>         
      <?=$list->end_tr();?>
      <?
   }
   ?>
   <?=$list->showFooter($total_row)?>
</div>
</body>
</html>