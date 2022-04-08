<?php
require_once("inc_security.php");

//gọi class DataGird
$list = new fsDataGird($field_id,$field_name,translate_text("Listing"));

$pro_category_id	= array();
$class_menu			= new menu();
$listAll				= $class_menu->getAllChild("categories_pro", "cat_id", "cat_parent_id", 0, "lang_id = " . $lang_id, "cat_id,cat_name,cat_type", "cat_order ASC,cat_name ASC", "cat_has_child", 0);
unset($class_menu);
if($listAll != '') foreach($listAll as $key=>$row) $pro_category_id[$row["cat_id"]] = $row["cat_name"];

/*
1: Ten truong trong bang
2: Tieu de header
3: kieu du lieu ( vnd 	: kiểu tiền VNĐ, usd : kiểu USD, date : kiểu ngày tháng, picture : kiểu hình ảnh, 
				array : kiểu combobox có thể edit, arraytext : kiểu combobox ko edit,
				copy : kieu copy, checkbox : kieu check box, edit : kiểu edit, delete : kiểu delete, string : kiểu text có thể edit, 
				number : kiểu số, text : kiểu text không edit
4: co sap xep hay khong, co thi de la 1, khong thi de la 0
5: co tim kiem hay khong, co thi de la 1, khong thi de la 0
*/
//$list->add("thi_picture","Image","picture",0,0);

$sql =	$list->sqlSearch();
	
$total		= new db_count("SELECT count(*) AS count 
									 FROM " . $fs_table . "
									 WHERE 1 " . $sql);
										 
$total_row = $total->total;
										 
$db_listing = new db_query("SELECT * 
									 FROM " . $fs_table . "
									 WHERE 1 " . $sql . "
									 ORDER BY " . $list->sqlSort() . $field_id . " DESC " . 
									 $list->limit($total_row));

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
   $i=0;
   while($row = mysql_fetch_assoc($db_listing->result)){
      $i++;
      $urlpros = createLink('detail_pros', $row);
      ?>
       <?=$list->start_tr($i, $row[$id_field]);?>  
         <td align="center">
				<?
				$path = $fs_filepath . $row["pro_picture_1"];
				if($row["pro_picture_1"] != "" && file_exists($path)){
					?>
                    <a target="_blank" onMouseOver="showtip('<img src=\'<?=$fs_filepath?><?=$row["pro_picture_1"]?>\' />')" onMouseOut="hidetip()">
                    	<img src="<?=$fs_filepath?><?=$row["pro_picture_1"]?>" height="100" width="100" />
                    </a>
               <?
				}
				?>		
			</td>                                                    
         <td><a href="<?=$urlpros?>" target="_blank"><?=$row['pro_title']?></a></td>  
         <?=$list->checkType($row,2)?> 
         <?=$list->checkType($row,3)?>    
         <?=$list->showCheckbox("pro_active",$row['pro_active'],$row['pro_id'])?> 
         <?=$list->showCheckbox("pro_hot", $row['pro_hot'], $row['pro_id']);  ?>
         <?=$list->showCheckbox("pro_fast", $row['pro_fast'], $row['pro_id']);  ?>
         <?=$list->showEdit($row['pro_id'])?>  
         <?=$list->showDelete($row['pro_id'])?>                      
      <?=$list->end_tr();?>
      <?
   }
   ?>
   <?=$list->showFooter($total_row)?>
</div>
</body>
</html>