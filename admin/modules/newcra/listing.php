<?php
function replaceTitle($title){
   $title   = remove_accent($title);
   $arr_str = array( "&lt;","&gt;","/","\\","&apos;", "&quot;","&amp;","lt;", "gt;","apos;", "quot;","amp;","&lt", "&gt","&apos", "&quot","&amp","&#34;","&#39;","&#38;","&#60;","&#62;");
   $title   = str_replace($arr_str, " ", $title);
   $title = preg_replace('/[^0-9a-zA-Z\s]+/', ' ', $title);
   //Remove double space
   $array = array(
      '    ' => ' ',
      '   ' => ' ',
      '  ' => ' ',
   );
   $title = trim(strtr($title, $array));
   $title   = str_replace(" ", "-", $title);
   $title   = urlencode($title);
   // remove cac ky tu dac biet sau khi urlencode
   $array_apter = array("%0D%0A","%","&");
   $title   =  str_replace($array_apter,"-",$title);
   $title   = strtolower($title);
   return $title;
}
function remove_accent($mystring){
   $marTViet=array(
   "à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
   "è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
   "ì","í","ị","ỉ","ĩ",
   "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
   "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
   "ỳ","ý","ỵ","ỷ","ỹ",
   "đ",
   "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
   "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
   "Ì","Í","Ị","Ỉ","Ĩ",
   "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
   "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
   "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
   "Đ",
   "'");
   
   $marKoDau=array(
   "a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
   "e","e","e","e","e","e","e","e","e","e","e",
   "i","i","i","i","i",
   "o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
   "u","u","u","u","u","u","u","u","u","u","u",
   "y","y","y","y","y",
   "d",
   "A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
   "E","E","E","E","E","E","E","E","E","E","E",
   "I","I","I","I","I",
   "O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
   "U","U","U","U","U","U","U","U","U","U","U",
   "Y","Y","Y","Y","Y",
   "D",
   "");
   
   return str_replace($marTViet,$marKoDau,$mystring);

}
require_once("inc_security.php");
require_once('../../../classes/PHPExcel.php');
//gọi class DataGird
$iCat             = getValue("iCat");
$iCate             = getValue("iCate");
$list = new fsDataGird($field_id,$field_name,translate_text("Listing"));
$new_category_id	= array(0=>"Tất cả");
$class_menu			= new menu();
$arrayWeb = array(0=>"Tất cả",
                  3=>"https://www.timviecnhanh.com",
                  6=>"https://www.careerlink.vn",
                  7=>"https://mywork.com.vn",
                  8=>"https://vieclam24h.vn");
$startdate		= getValue("startdate", "str", "GET", "dd/mm/yyyy");
$enddate			= getValue("enddate", "str", "GET", "dd/mm/yyyy");
$listAll				= $class_menu->getAllChild("category", "cat_id", "cat_parent_id", 0, "cat_active = 1 ", "cat_id,cat_name", "cat_order ASC,cat_name ASC", "", 0);
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
$list->add("new_id","ID","string",0,1);
$list->add($field_name, translate_text("Tiêu đề"), "string", 0, 0);
$list->add("usc_company","Link","string",0,0);
$list->add("new_cra","Nguồn lấy tin","string",0,0,1);
$list->add("new_cat_id","Danh mục","int",0,0,1);
$list->add("new_create_time","Ngày lấy tin","string",0,0,1);
$list->add("",translate_text("Sửa"),"edit");
$list->add("",translate_text("Xóa"),"delete");
$list->addSearch("Nguồn lấy tin","iCat","array",$arrayWeb,$iCat);
$list->addSearch("Danh mục","iCate","array",$new_category_id,$iCate);
$list->addSearch("Từ", "startdate", "date", $startdate, "dd/mm/yyyy");
$list->addSearch("Đến", "enddate", "date", $enddate, "dd/mm/yyyy");
$list->quickEdit 	= true;
$list->ajaxedit($fs_table);

$sql =	$list->sqlSearch();
if($startdate != "dd/mm/yyyy"){
	$intdate		=	convertDateTime($startdate, "0:0:0");
	$sql			.= " AND new_create_time >= " . $intdate;
	}
if($enddate != "dd/mm/yyyy"){
	$intdate		=	convertDateTime($enddate, "23:59:59");
	$sql			.= " AND new_create_time <= " . $intdate;
}	
if($iCat != 0)
{
   $sql .= " AND new_cra = ".$iCat."";
}
if($iCate != 0)
{
   $sql .= " AND new_cat_id = ".$iCate."";
}
$total		= new db_count("SELECT count(*) AS count 
									 FROM " . $fs_table . "
                            JOIN user_company ON new.new_user_id = user_company.usc_id
									 WHERE usc_type = 1 AND new_cra > 0 " . $sql);
										 
$total_row = $total->total;							 
$db_listing = new db_query("SELECT * 
									 FROM " . $fs_table . "
                            JOIN user_company ON new.new_user_id = user_company.usc_id
									 WHERE usc_type = 1 AND new_cra > 0 " . $sql . "
									 ORDER BY " . $list->sqlSort() . $field_id . " DESC " . 
									 $list->limit($total_row));
$db_full = new db_query("SELECT * 
                            FROM " . $fs_table . "
                            JOIN user_company ON new.new_user_id = user_company.usc_id
                            WHERE usc_type = 1 AND new_cra > 0 " . $sql . "
                            ORDER BY " . $list->sqlSort() . $field_id . " DESC");
$xuatex =          getValue("postexcel","str","post","");
echo $xuatex;
if($xuatex != "")
{

$objPHPExcel = new PHPExcel();
 
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Tiêu đề')
->setCellValue('B1', 'Link')
->setCellValue('C1', 'Nguồn Lấy Tin')
->setCellValue('D1', 'Ngày lấy tin');
while($rowx = mysql_fetch_assoc($db_full->result))
{
   $listsss = 
   array(
   'name' => $rowx['new_title'],
   'email' => "https://timviec365.vn/".replaceTitle($row['new_title'])."-p".$row['new_id'].".html",
   'phone' => $arrayWeb[$row['new_cra']],
   'time'  => date("d/m/Y",$rowx['use_create_time']),
   );
   $lists[] =  $listsss;
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
$full_path = 'data_linkcra.xlsx';//duong dan file
$objWriter->save($full_path);
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=data_linkcra.xlsx");
readfile("https://timviec365.vn/admin/modules/newcra/data_linkcra.xlsx");

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
         <td style="padding-left: 20px;"><?=$row['new_id']?></td>                                                               
         <td style="padding-left: 20px;"><a style="text-decoration: underline;" href="https://timviec365.vn/<?= replaceTitle($row['new_title']) ?>-p<?= $row['new_id'] ?>.html" target="_blank"><?=$row['new_title']?></a></td>  
         <td style="padding-left: 20px;">https://timviec365.vn/<?= replaceTitle($row['new_title']) ?>-p<?= $row['new_id'] ?>.html</td> 
         <td align="center"><?
         if($row['new_cra'] == 3)
         {
            echo "https://www.timviecnhanh.com";
         }
         else if($row['new_cra'] == 6)
         {
            echo "https://www.careerlink.vn";
         }
         else if($row['new_cra'] == 7)
         {
            echo "https://mywork.com.vn";
         }
         else if($row['new_cra'] == 8)
         {
            echo "https://vieclam24h.vn";
         }
         else
         {
            echo "Không xác định";
         }
         ?></td>
         <td><?= $new_category_id[$row['new_cat_id']] ?></td>
         <td align="center"><?=date("d/m/Y",$row['new_create_time'])?></td>
         <?=$list->showEdit($row['new_id'])?> 
         <?=$list->showDelete($row['new_id'])?>                      
      <?=$list->end_tr();?>
      <?
   }
   ?>
   <?=$list->showFooter($total_row)?>
</div>
</body>
</html>