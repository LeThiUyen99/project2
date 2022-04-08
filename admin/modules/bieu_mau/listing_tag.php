<?php
require_once("inc_security_tag.php");
//gọi class DataGird
error_reporting(E_ERROR | E_PARSE);
$list = new fsDataGird($field_id,$field_name,translate_text("Listing"));
$new_category_id  = array();
$class_menu       = new menu();
$list->add("bmt_id","ID","string",0,0, '');

$list->add("bmt_name","Tên tag","string",0,0, '');



$list->add("",translate_text("Sửa"),"edit");
$list->add("",translate_text("Xóa"),"delete");

$list->quickEdit  = false;
$list->ajaxedit($fs_table);

$total      = new db_count("SELECT count(*) AS count 
                            FROM " . $fs_table);
                               
$total_row = $total->total;   
                   
$db = new db_query("SELECT * 
                            FROM " . $fs_table);
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
   $db_cate = new db_query("SELECT bm_id, bm_cate FROM bieu_mau");
   $cate  = $db_cate->result_array('bm_id');

   $i=0;
   while($row = mysql_fetch_assoc($db->result)){
      $i++;
      ?>
      <?=$list->start_tr($i, $row[$id_field]);?>   
         <td align="center"><?=$row['bmt_id']?></td>                                                       
         <td align="center"><?=$row['bmt_name']?></td>

         <?
         echo '<td width="10" align="center"><a class="edit"  rel="tooltip" title="' . translate_text("Bạn muốn sửa bản ghi") . '" href="edit_tag.php?record_id=' .  $row['bmt_id'] . '&url=' . base64_encode($_SERVER['REQUEST_URI']) . '"><img src="../../resource/images/grid/edit.png" border="0"></a></td>';
         echo '<td width="10"  align="center"><a class="delete" href="#" onclick="if (confirm(\''  . str_replace("'","\'",translate_text("Bạn muốn xóa bản ghi?")) . '\')){ deleteone_tag(' . $row['bmt_id'] . '); }"><img src="../../resource/images/grid/delete.gif" border="0"></a></td>';
         ?>                    
      <?=$list->end_tr();?>
      <?
   }
   ?>
   <?=$list->showFooter($total_row)?>
<script type="text/javascript">
      function deleteone_tag(id) {
      
      event.preventDefault();
      
      $("#tr_" + id).hide(500);
      
      var total_footer = $("#total_footer").text();
      total_footer = total_footer - 1;
      
      $.ajax({
         type: "POST",
         url: "delete_tag.php",
         data: "record_id=" + id,
         success: function(msg) {
            if (msg != '') {
               console.log(msg);
               $("#total_footer").text(total_footer);
               setTimeout(function(){
                  if(!$('#listing').find('input.check:visible').length) window.location.reload();
               }, 600)
            }
         }
      });
   }
</script>
</div>
</body>
</html>