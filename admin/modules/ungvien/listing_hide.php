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
$list->add("use_logo","Logo","string",0,0, '');
$list->add($field_name, "Tên ứng viên", "string", 0, 1);
$list->add("use_phone","Số điện thoại","string",0,1);
$list->add("use_email","Email","string",0,1);
$list->add("use_update_time","Ngày đăng ký","string",0,0,1);
$list->add("",translate_text("Làm mới"),"Làm mới");
$list->add("",translate_text("Sửa"),"edit");
$list->add("",translate_text("Xóa"),"delete");
$list->addSearch("Từ", "startdate", "date", $startdate, "dd/mm/yyyy");
$list->addSearch("Đến", "enddate", "date", $enddate, "dd/mm/yyyy");
$list->quickEdit 	= false;
$list->ajaxedit($fs_table);

$sql =	$list->sqlSearch();
if($startdate != "dd/mm/yyyy"){
	$intdate		=	convertDateTime($startdate, "0:0:0");
	$sql			.= " AND use_update_time >= " . $intdate;
	}
if($enddate != "dd/mm/yyyy"){
	$intdate		=	convertDateTime($enddate, "23:59:59");
	$sql			.= " AND use_update_time <= " . $intdate;
}	
$total		= new db_count("SELECT count(*) AS count 
									 FROM " . $fs_table . " LEFT JOIN cv ON user.use_id = cv.cv_user_id
									 WHERE (use_first_name = '' OR cv_title = '') " . $sql);
										 
$total_row = $total->total;							 
$db_listing = new db_query("SELECT * 
									 FROM " . $fs_table . " LEFT JOIN cv ON user.use_id = cv.cv_user_id
									 WHERE (use_first_name = '' OR cv_title = '') " . $sql . "
									 ORDER BY " . $list->sqlSort() . " use_update_time DESC " . 
									 $list->limit($total_row));
$db_full = new db_query("SELECT * 
									 FROM " . $fs_table . " LEFT JOIN cv ON user.use_id = cv.cv_user_id
									 WHERE (use_first_name = '' OR cv_title = '') " . $sql . "
									 ORDER BY " . $list->sqlSort()  . "use_update_time DESC ");
$xuatex = getValue("postexcel","str","POST","");
if($xuatex != "")
{
$objPHPExcel = new PHPExcel();
 
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Tên ứng viên')
->setCellValue('B1', 'Email')
->setCellValue('C1', 'Số điện thoại')
->setCellValue('D1', 'Ngày đăng ký');
while($rowx = mysql_fetch_assoc($db_full->result))
{
   $listsss = 
   array(
   'name' => $rowx['use_first_name'],
   'email' => $rowx['use_email'],
   'phone' => $rowx['use_phone'],
   'time'  => date("d/m/Y",$rowx['use_create_time']),
   );
   $lists[]	=	$listsss;
}
//set gia tri cho cac cot du lieu
$i = 2;
foreach ($lists as $row2)
{
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A'.$i, $row2['name'])
->setCellValue('B'.$i, $row2['email'])
->setCellValue('C'.$i, $row2['phone'])
->setCellValue('D'.$i, $row2['time']);
$i++;
}
//ghi du lieu vao file,định dạng file excel 2007
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$full_path = 'data_ungvien_an.xlsx';//duong dan file
$objWriter->save($full_path);
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=data_ungvien_an.xlsx");
readfile("https://timviec365.vn/admin/modules/ungvien/data_ungvien_an.xlsx");

}
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
   <form method="post" name="form_ab">
      <input type="submit" name="postexcel" class="bottom" style="float: left!important;margin-left: 13px!important;margin: 3px 13px 8px;!" value="Xuất Excel" />
   </form>
   <?
   $i=0;
   while($row = mysql_fetch_assoc($db_listing->result)){
      $i++;
      
      ?>
      <?=$list->start_tr($i, $row[$id_field]);?>
         <td align="center" width="72">
            <?
            if($row['use_logo'] != NULL)
            {
            ?>
            <img width="69px" src="../../..<?= getlogouv($row['use_create_time']).$row['use_logo'] ?>" onerror='this.onerror=null;this.src="/images/no-image.png";' alt="<?= name_company($row['use_first_name'])?>"/>
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
         <td style="padding-left: 20px;"><b><a href="https://timviec365.vn/ung-vien/<?= replaceTitle($row['use_first_name']) ?>-uv<?= $row['use_id'] ?>.html" target="_blank"><?=$row['use_first_name']?></a></b></td>  
         <td style="padding-left: 20px;"><?=$row['use_phone']?></td>    
         <td align="center"><?=$row['use_email']?></td>
         <td align="center"><?=date("d/m/Y",$row['use_update_time'])?></td>    
         <?=$list->showRenew($row['use_id'])?>   
         <?=$list->showEdit($row['use_id'])?>        
         <?=$list->showDelete($row['use_id'])?>                      
      <?=$list->end_tr();?>
      <?
   }
   ?>
   <?=$list->showFooter($total_row)?>
</div>
</body>
</html>