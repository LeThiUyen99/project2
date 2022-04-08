<?php
require_once("inc_security.php");
require_once('../../../classes/PHPExcel.php');
//gọi class DataGird
$list = new fsDataGird($field_id,$field_name,translate_text("Listing"));
$new_category_id	= array();
$class_menu			= new menu();
$startdate		= getValue("startdate", "str", "GET", "dd/mm/yyyy");
$enddate			= getValue("enddate", "str", "GET", "dd/mm/yyyy");
$listAll				= $class_menu->getAllChild("categories_multi", "cat_id", "cat_parent_id", 0, "cat_active = 1 AND lang_id = " . $lang_id, "cat_id,cat_name,cat_type", "cat_order ASC,cat_name ASC", "cat_has_child", 0);
unset($class_menu);
if($listAll != '') foreach($listAll as $key=>$row) $new_category_id[$row["cat_id"]] = $row["cat_name"];
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
$list->add("usc_id","ID","string",0,1, '');
$list->add("usc_logo","Logo","string",0,0, '');
$list->add($field_name, "Tên công ty", "string", 0, 1);
$list->add("usc_phone","Số điện thoại","string",0,1);
$list->add("usc_email","Email","string",0,1);
$list->add("usc_website","Website","string",0,0,1);
$list->add("usc_address","Địa chỉ","string",0,0,1);
$list->add("usc_create_time","Ngày đăng ký","string",0,0,1);
$list->add("",translate_text("Sửa"),"edit");
$list->add("",translate_text("Xóa"),"delete");
$list->addSearch("Từ", "startdate", "date", $startdate, "dd/mm/yyyy");
$list->addSearch("Đến", "enddate", "date", $enddate, "dd/mm/yyyy");
$list->quickEdit 	= false;
$list->ajaxedit($fs_table);

$sql =	$list->sqlSearch();
if($startdate != "dd/mm/yyyy"){
	$intdate		=	convertDateTime($startdate, "0:0:0");
	$sql			.= " AND usc_create_time >= " . $intdate;
	}
if($enddate != "dd/mm/yyyy"){
	$intdate		=	convertDateTime($enddate, "23:59:59");
	$sql			.= " AND usc_create_time <= " . $intdate;
}	
$total		= new db_count("SELECT count(*) AS count 
									 FROM " . $fs_table . "
									 WHERE (usc_email = '' OR usc_phone = '') " . $sql);
										 
$total_row = $total->total;							 
$db_listing = new db_query("SELECT * 
									 FROM " . $fs_table . "
									 WHERE (usc_email = '' OR usc_phone = '') " . $sql . "
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
      
      ?>
      <?=$list->start_tr($i, $row[$id_field]);?>
         <td align="center"><?=$row['usc_id']?></td>
         <td align="center" width="72">
            <?
            if($row['usc_logo'] != NULL)
            {
            ?>
            <img src="../../<?= geturlimageAvatar($row['usc_create_time']).$row['usc_logo'] ?>" onerror='this.onerror=null;this.src="/images/no-image.png";' alt="<?= name_company($row['usc_company'])?>"/>
            <?
            }
            else
            {
            ?>
            <img src='/images/no-image.png' alt='no image'/>
            <?
            }
            ?>	
			</td>                                                              
         <td style="padding-left: 20px;"><b><a href="https://timviec365.vn/<?= replaceTitle($row['usc_company']) ?>-co<?= $row['usc_id'] ?>" target="_blank"><?=$row['usc_company']?></a></b></td>  
         <td style="padding-left: 20px;"><?=$row['usc_phone']?></td>    
         <td align="center"><?=$row['usc_email']?></td>
         <td align="center"><?= $row['usc_website']!=''?$row['usc_website']:'Chưa cập nhật'?></td> 
         <td ><?= $row['usc_address']!=''?$row['usc_address']:'Chưa cập nhật'?></td> 
         <td align="center"><?=date("d/m/Y",$row['usc_create_time'])?></td>
         <?=$list->showEdit($row['usc_id'])?>         
         <?=$list->showDelete($row['usc_id'])?>                      
      <?=$list->end_tr();?>
      <?
   }
   ?>
   <?=$list->showFooter($total_row)?>
</div>
</body>
</html>