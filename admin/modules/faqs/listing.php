<?
require_once("inc_security.php");

$list = new fsDataGird($field_id,$field_name,translate_text("Listing"));

$cat_type 			= getValue("cat_type","str","GET","");
$iCat		 			= getValue("iCat");
if($cat_type=="") $cat_type=getValue("cat_type","str","POST","");
$sql="1";
if($cat_type!="")  $sql="cat_type = '" . $cat_type . "'";
$menu = new menu();
//$menu->show_count = 1; //tính count sản phẩm
$listAll = $menu->getAllRecodeNew("faqs","FaqID","",0,"1=1" ,"FaqID,Title,Question,Answer,FullAnswer,CreateUser,CreateDate,MetaKeyword,MetaDescription","FaqID ASC");

$arrayCat = array(0=>translate_text("Category"));


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------$list->urlsearch()*/ ?>
<?=template_top(translate_text("Category listing"),"")?>
	<?
	if(!is_array($listAll)) $listAll = array();
	?>
	<table border="1" cellpadding="3" cellspacing="0" class="table" width="100%">
		<tr class="bg"> 
			<td class="bold" width="5"><input type="checkbox" id="check_all" onClick="check('1','<?=count($listAll)+1?>')"></td>
			<td class="bold" width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.png" border="0"></td>
			<td class="bold"><?=translate_text("Tên")?></td>
			<td class="bold" align="center"><?="Câu hỏi"?></td>		
			<td class="bold" align="center" width="16"><?=translate_text("Sửa")?></td>
			<td class="bold" align="center" width="16"><?=translate_text("Xóa")?></td>
		</tr>
		<form action="quickedit.php?returnurl=<?=base64_encode(getURL())?>" method="post" name="form_listing" id="form_listing" enctype="multipart/form-data">
		<input type="hidden" name="iQuick" value="update">	
		<? 
		
		$i=0;
		$cat_type = '';
		foreach($listAll as $key=>$row){
			$i++;
		?>
		<tr <? if($i%2==0) echo ' bgcolor="#FAFAFA"';?>>
			<td>
				<input type="checkbox" name="record_id[]" id="record_<?=$row["FaqID"]?>_<?=$i?>" value="<?=$row["FaqID"]?>">
			 </td>
			<td width="2%" nowrap="nowrap" align="center"><img src="<?=$fs_imagepath?>save.png" border="0" style="cursor:pointer" onClick="document.form_listing.submit()" alt="Save"></td>
			<td nowrap="nowrap">
				<?=$row['Title']?>
			</td>
			<td><?=$row['Question'] ?></td>
         	<td align="center" width="16"><a class="text" href="edit.php?record_id=<?=$row["FaqID"]?>&returnurl=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>edit.png" alt="EDIT" border="0"/></a></td>
			<td align="center"><img src="<?=$fs_imagepath?>delete.png" alt="DELETE" border="0" onclick="if (confirm('Are you sure to delete?')){ window.location.href='delete.php?record_id=<?=$row["FaqID"]?>&returnurl=<?=base64_encode(getURL())?>'}" style="cursor:pointer"/></td>
		</tr>
		<? } ?>
		</form>
		</table>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>