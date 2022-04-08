<?php
require_once("inc_security.php");

$list = new fsDataGird($field_id,$field_name,translate_text("Listing"));
$new_category_id	= array();
$class_menu			= new menu();
$list->add("bm_id","ID","string",0,0, '');

$list->add("bm_cate","Danh mục","string",0,0, '');

$list->add("bm_title","Title","string",0,0, '');
$list->add("bm_description","Description","string",0,0, '');
$list->add("bm_keyword","Keyword","string",0,0, '');



$list->add("",translate_text("Sửa"),"edit");
$list->add("",translate_text("Xóa"),"delete");

$list->quickEdit 	= false;
$list->ajaxedit($fs_table);

$total      = new db_count("SELECT count(*) AS count 
                            FROM " . $fs_table);
                               
$total_row = $total->total;   
						 
$db = new db_query("SELECT * FROM " . $fs_table." ORDER BY " . $list->sqlSort() . $field_id . " DESC ".$list->limit($total_row));

?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<?=$load_header?>
	<?=$list->headerScript()?>
</head>
<body>
<div id="listing">
   <?=$list->showHeader($total_row)?>
   <?
   $i = 0;
   while($row = mysql_fetch_assoc($db->result)){
      $i++;
      ?>
      <?=$list->start_tr($i, $row[$id_field]);?>      
         <td align="center"><?=$row['bm_id']?></td>
                                                         
         <td align="center"><?=$row['bm_cate']?></td>
         <td><?= cut_string($row['bm_title'],'160','...') ?></td>
         <td><?=$row['bm_description']?></td>
         <td><?=$row['bm_keyword']?></td>
         <?=$list->showEdit($row['bm_id'])?>
         <?=$list->showDelete($row['bm_id'])?>                         
      <?=$list->end_tr();?>
      <?
   }
   ?>
   <?=$list->showFooter($total_row)?>
</div>
</body>
</html>