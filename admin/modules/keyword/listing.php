<?php
require_once("inc_security.php");
//gọi class DataGird
$list = new fsDataGird($field_id,$field_name,translate_text("Listing"));
$new_category_id	= array();
$class_menu			= new menu();

$array_capbac = array(0 => "Chọn cấp bậc",
                      1 => "Thực tập",
                      3 => "Nhân viên",
                      5 => "Trưởng nhóm",
                      2 => "Trưởng Phòng",
                      4 => "Giám Đốc",
                      );


// $listAll				= $class_menu->getAllChild("categories_multi", "cat_id", "cat_parent_id", 0, "cat_active = 1 AND lang_id = " . $lang_id, "cat_id,cat_name,cat_type", "cat_order ASC,cat_name ASC", "cat_has_child", 0);
// unset($class_menu);
// if($listAll != '') foreach($listAll as $key=>$row) $new_category_id[$row["cat_id"]] = $row["cat_name"];
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
$list->add("key_id","ID","string",0,0, '');
$list->add("key_name","Tên tag","string",0,0, '');
$list->add("key_cate_id","Ngành nghề","string",0,0, '');
$list->add("key_city_id","Tỉnh thành","string",0,0, '');
$list->add("key_qh_id","Quận Huyện","string",0,0, '');
$list->add("key_cb_id","Cấp Bậc","string",0,0, '');

$list->add("","Link Tag","string",0,0, '');

$list->add("key_teaser","Mô tả","string",0,0, '');
$list->add("key_err", "Hủy link", "checkbox", 0, 0);



$list->add("",translate_text("Sửa"),"edit");
$list->add("",translate_text("Xóa"),"delete");

$list->quickEdit 	= false;
$list->ajaxedit($fs_table);

$total      = new db_count("SELECT count(*) AS count 
                            FROM " . $fs_table);
                               
$total_row = $total->total;   
						 
$db = new db_query("SELECT * FROM " . $fs_table." ORDER BY " . $list->sqlSort() . $field_id . " DESC ".$list->limit($total_row));

function rewriteKey($key_id,$key_name,$key_cate_id,$cate_name,$key_city_id,$city_name,$key_qh_id,$qh_name,$key_cb_id,$cb_name,$key_type,$key_err){
  $linkrt = "";

  if ($key_err != 0) {
    $linkrt = "/home/404.php";
  }
  else if($key_qh_id != 0 && $key_city_id != 0 && $key_cate_id != 0 && $key_name == Null && $key_cb_id == 0 && $key_type == 0)
  {
     $linkrt = "/tag2/viec-lam-".replaceTitle($cate_name)."-tai-".replaceTitle($qh_name)."-".replaceTitle($city_name)."-".$key_id;
  }
  else if($key_qh_id != 0 && $key_city_id != 0 && $key_name != Null && $key_cate_id == 0 && $key_cb_id == 0 && $key_type == 0 )
  {
     $linkrt = "/tag6/viec-lam-".replaceTitle($key_name)."-tai-".replaceTitle($qh_name)."-".replaceTitle($city_name)."-".$key_id;
  }
  else if($key_cb_id != 0 && $key_cate_id != 0 && $key_city_id != 0 && $key_name == Null && $key_qh_id == 0 && $key_type == 0)
  {
     $linkrt = "/tag3/tuyen-dung-viec-lam-".replaceTitle($cb_name)."-".replaceTitle($cate_name)."-tai-".replaceTitle($city_name)."-".$key_id;
  }
  else if($key_cb_id != 0 && $key_name != Null && $key_city_id != 0 && $key_cate_id == 0 && $key_qh_id == 0 && $key_type == 0)
  {
     $linkrt = "/tag4/viec-lam-".replaceTitle($cb_name)."-".replaceTitle($key_name)."-tai-".replaceTitle($city_name)."-".$key_id;
  }
  else if($key_name != Null && $key_city_id != 0 && $key_type == 0 && $key_cate_id == 0 && $key_qh_id == 0 && $key_cb_id == 0)
  {
     $linkrt = "/tag5/tuyen-dung-viec-lam-".replaceTitle($key_name)."-tai-".replaceTitle($city_name)."-".$key_id;
  }
  else if( $key_qh_id != 0 && $key_city_id != 0 && $key_cb_id == 0 && $key_cate_id == 0 && $key_name == Null && $key_type == 0)
  {
     $linkrt = "/tag1/viec-lam-tai-".replaceTitle($qh_name)."-".replaceTitle($city_name)."-".$key_id;
  }
  else if( $key_name != Null && $key_type == 0 && $key_cate_id == 0 && $key_qh_id == 0 && $key_city_id == 0 && $key_cb_id == 0)
  {
     $linkrt = "/tag7/DS-viec-lam-tuyen-dung-".replaceTitle($key_name)."-".$key_id;
  }
  else if( $key_name != Null && $key_type != 0 && $key_cate_id == 0 && $key_qh_id == 0 && $key_city_id == 0 && $key_cb_id == 0)
  {
     $linkrt = "/tuyen-dung-viec-lam/".$key_id."-".replaceTitle($key_name);
  }
  return  $linkrt;
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
   <?
   $db_qrr = new db_query("SELECT cit_id,cit_name FROM city2 ORDER BY cit_count DESC,cit_name ASC");
   $arrcity  = $db_qrr->result_array('cit_id');
   $db_qr = new db_query("SELECT cat_id,cat_name FROM category WHERE cat_active = 1 ORDER BY cat_count DESC");
   $db_cat  = $db_qr->result_array('cat_id');

   $i=0;
   while($row = mysql_fetch_assoc($db->result)){
      $i++;
      $link = "https://timviec365.vn".rewriteKey($row['key_id'],$row['key_name'],$row['key_cate_id'],$row['key_cate_id'] != 0?$db_cat[$row['key_cate_id']]['cat_name']:"",$row['key_city_id'],$row['key_city_id'] != 0?$arrcity[$row['key_city_id']]['cit_name']:"",$row['key_qh_id'],$row['key_qh_id'] != 0?$arrcity[$row['key_qh_id']]['cit_name']:"",$row['key_cb_id'],$row['key_cb_id'] != 0?$array_capbac[$row['key_cb_id']]:"",$row['key_type'],$row['key_err']);
      ?>
      <?=$list->start_tr($i, $row[$id_field]);?>  
         <td align="center"><?=$row['key_id']?></td>                                                        
         <td align="center"><?=$row['key_name']?></td>
         <td align="center"><?= $row['key_cate_id'] != 0?$db_cat[$row['key_cate_id']]['cat_name']:""?></td>
         <td align="center"><?= $row['key_city_id'] != 0?$arrcity[$row['key_city_id']]['cit_name']:""?></td>
         <td align="center"><?= $row['key_qh_id'] != 0?$arrcity[$row['key_qh_id']]['cit_name']:""?></td>
         <td align="center"><?= $row['key_cb_id'] != 0?$array_capbac[$row['key_cb_id']]:""?></td>
         <td align="center"><a href="<?=$link ?>" target="_blank"><?=$link ?></a></td>
         <td><?= cut_string($row['key_teaser'],'160','...') ?></td>
         <?=$list->showCheckbox("key_err",$row['key_err'],$row['key_id'])?>


         <?=$list->showEdit($row['key_id'])?>
         <?=$list->showDelete($row['key_id'])?>                         
      <?=$list->end_tr();?>
      <?
   }
   ?>
   <?=$list->showFooter($total_row)?>
</div>
</body>
</html>