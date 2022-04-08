<?
require_once("inc_security.php");
//check quyền them sua xoa
checkAddEdit("edit");


$ff_action				= getURL();
$ff_redirect_succ 	= "listing.php";
$ff_redirect_fail 	= "";
$iAdm 					= getValue("iAdm");
$ff_table 				= "useradmin";

$fs_redirect			= base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
$record_id				= getValue("iAdm","int","GET");
$field_id				= "UserId";
$errorMsg				= "";
$Action 					= getValue("Action","str","POST","");

$arelate_select  			= getValue("arelate_select","arr","POST",array());
$menuid 				= new menu();
$menuid->getAllRecodeNew("categories","CategoryID","",0,"Status >=0" ,"CategoryID,CategoryName,Description,Status,Code,Meta,MetaDesc","CategoryID ASC");//getArray("categories_multi","cat_id","cat_parent_id"," lang_id = " . $lang_id);
$adm_access_category 	= '';
foreach($arelate_select as $key=>$value){
	$adm_access_category .= '[' . str_replace(",","][",$menuid->getAllChildId($value)) . ']';
}


//Call Class generate_form();
$myform = new generate_form();
$myform->add("UserNameCode","UserNameCode",0,0,"",0," Namecode !",0,"");
$myform->add("UserName","UserName",0,0,"",0,"",0,"");
//$myform->add("Password","Password",0,0,"",0,"",0,"");
$myform->add("FullName","FullName",0,0,"",0," Điền tên đại diện !",0,"");
$myform->add("GroupId","GroupId",1, 0, 0, 1, translate_text("Bạn chưa chọn danh mục"), 0, "");
$myform->add("Note","Note",1,0,0,0,"",0,"");
$myform->add("Status","Status",1, 0, 1, 0, "", 0, "");

$myform->addTable($fs_table);

//Edit user profile
if ($Action =='update')
{
		$errorMsg .= $myform->checkdata();
		if($errorMsg == ""){
			//echo $myform->generate_update_SQL("adm_id",$iAdm); exit();
			$db_ex = new db_execute($myform->generate_update_SQL("UserId",$iAdm));
			unset($db_ex);
			$module_list  			= getValue("mod_id","arr","POST","");			
			$arelate_select  		= getValue("arelate_select","arr","POST","");
			var_dump($module_list,$arelate_select);
			$db_delete = new db_execute("DELETE FROM admin_user_right WHERE adu_admin_id =" . $iAdm);		
			unset($db_delete);
			if(isset($module_list[0])){
				for ($i=0; $i< count($module_list); $i++){
					$query_str = "INSERT INTO admin_user_right VALUES(" . $iAdm . "," . $module_list[$i] . ", " . getValue("adu_add" . $module_list[$i] , "int","POST") . ", " . getValue("adu_edit" . $module_list[$i] , "int","POST") . ", " . getValue("adu_delete" . $module_list[$i] , "int","POST") . ")";
					$db_ex = new db_execute($query_str);
					unset($db_ex);
				}
			}
			$db_delete = new db_execute("DELETE FROM admin_user_language WHERE aul_admin_id =" . $iAdm);		
			unset($db_delete);
			if(isset($user_lang_id_list[0])){
				for ($i=0; $i< count($user_lang_id_list); $i++){
					$query_str = "INSERT INTO admin_user_language VALUES(" . $iAdm . "," . $user_lang_id_list[$i] .")";
					$db_ex = new db_execute($query_str);
					unset($db_ex);
				}
			}
			redirect($ff_redirect_succ);
			exit();
		}
}

//Edit user password
$errorMsgpass = '';
if ($Action =='update_password')
{
	$myform = new generate_form();
	$myform->add("Password","Password",3,0,"",1,translate_text("Please enter new password"),0,"");
	$myform->addTable($fs_table);
	$errorMsgpass .= $myform->checkdata();
    //var_dump($_POST['Password']);die();
    
	if($errorMsgpass == ""){
		$db_ex = new db_execute("Update useradmin set Password='".md5($_POST['Password'])."' Where UserId='".$iAdm."'");
		unset($db_ex);
		echo '<script>alert("' . translate_text("Your_new_password_has_been_updated") . '")</script>';
		redirect($ff_redirect_succ);
	}
}




//Select access module
$acess_module			= "";
$arrayAddEdit 			= array();
$db_access = new db_query("SELECT * 
									FROM useradmin, admin_user_right, modules
									WHERE useradmin.UserId = admin_user_right.adu_admin_id AND modules.mod_id = admin_user_right.adu_admin_module_id AND UserId =" . $iAdm);
while ($row_access = mysql_fetch_array($db_access->result)){
	$acess_module 			.= "[" . $row_access['mod_id'] . "]";
	$arrayAddEdit[$row_access['mod_id']] = array($row_access["adu_add"],$row_access["adu_edit"],$row_access["adu_delete"]);
}
unset($db_access);

//Select access channel
$access_channel="";
//Select access languages
$access_language="";


//Check user exist or not
$db_admin_sel = new db_query("SELECT *
										  FROM useradmin
										  WHERE UserId = " . $iAdm);
$db_getallmodule = new db_query("SELECT * 
												FROM modules
												ORDER BY mod_order DESC");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top(translate_text("Edit member"))?>
<table cellpadding="5" cellspacing="0" width="100%">
	<tr>
		<td valign="top" class="bold bg">
			<?=translate_text("Sửa thông tin")?>
		</td>
		<td valign="top" class="bold bg">
			<?=translate_text("Thay đổi password")?>
		</td>
	</tr>
	<tr>
		<td>
			<? $row = mysql_fetch_array($db_admin_sel->result); ?>
			<form ACTION="<?=$ff_action;?>" METHOD="POST" name="edit_user">
					<table align="center" cellpadding="4" cellspacing="0" border="0">
						<tr class="bgTableBorder"> 
							<td class="textBold" colspan="2" align="center"></td>
						</tr>
						<tr> 
							<td align="right" nowrap="nowrap" class="textBold"><?=translate_text("Tên đăng nhập")?> :</td>
							<td class="textBold">
								
                                <input type="text" name="UserName" id="UserName" value="<?=$row["UserName"]?>" size="50" maxlength="50" class="form"> 
							</td>
						</tr>
						<tr <?=$fs_change_bg?>> 
							<td align="right" valign="middle" nowrap class="textBold"><?=translate_text("Họ tên")?> :</td>
							<td class="textBold">
							<input type="text" name="FullName" id="FullName" value="<?=$row["FullName"]?>" size="50" maxlength="50" class="form"> 
							</td>
						</tr>
						<tr <?=$fs_change_bg?>> 
							<td align="right" valign="middle" nowrap class="textBold"><?=translate_text("Name Code")?> :</td>
							<td class="textBold">
							<input type="text" name="UserNameCode" id="UserNameCode" value="<?=$row["UserNameCode"]?>" size="50" maxlength="50" class="form"> 
							</td>
						</tr>
						<tr <?=$fs_change_bg?>> 
						<td align="right" valign="middle" nowrap class="textBold"><?=translate_text("Note")?> :</td>
						<td> <input type="text" name="Note" id="Note" value="<?=$row["Note"]?>" size="50" maxlength="50" class="form">
						</td>
						</tr>
                        <tr>
                           <td class="form_name">
                            	<font class="form_asterisk">* </font>Chọn Nhóm
                           </td>
                            <td class="form_text">
                                <select name="GroupId" id="GroupId" class="form_control">
                                	<option value="">Chọn Nhóm</option>
                        			<option value="1">Kế toán</option>
                                    <option value="2">Seo</option>
                                    <option value="3">Kinh Doanh</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="form_name">Trạng thái :</td>
                            <td class="form_text"><input type="checkbox" id="Status" name="Status" value="1" checked="checked">
                            <label for="Status">Kích hoạt</label>
                            </td>
                        </tr>
						<tr <?=$fs_change_bg?>> 
						<td align="right" valign="middle" nowrap class="textBold"><?=translate_text("Quyền quản lý")?> :</td>
						<td> 
						<table cellpadding="2" cellspacing="0" style="border-collapse:collapse" border="1" bordercolor="#DDF8CC">
							<tr bgcolor="#E0EAF3" height="30">
								<td class="textBold"><?=translate_text("Chọn")?></td>
								<td class="textBold"><?=translate_text("Danh sách")?></td>
								<td class="textBold"><?=translate_text("Thêm")?></td>
								<td class="textBold"><?=translate_text("Sửa")?></td>
								<td class="textBold"><?=translate_text("Xóa")?></td>
							</tr>
							<?
							while ($mod=mysql_fetch_array($db_getallmodule->result)){
								if(file_exists("../../modules/" . $mod["mod_path"] . "/inc_security.php")===true){
								?>
									<tr>
										<td align="center"><input type="checkbox" name="mod_id[]" id="mod_id" value="<?=$mod['mod_id'];?>" <? if (strpos($acess_module, "[" . $mod['mod_id'] . "]") !== false) {?> checked="checked"<? } ?> ></td>
										<td class="textBold"><?=translate_text($mod['mod_name']);?></td>
										<td align="center"><input type="checkbox" name="adu_add<?=$mod['mod_id'];?>" id="adu_add<?=$mod['mod_id'];?>" <? if(isset($arrayAddEdit[$mod['mod_id']])){ if($arrayAddEdit[$mod['mod_id']][0]==1) echo ' checked="checked"'; }?> value="1"></td>
										<td align="center"><input type="checkbox" name="adu_edit<?=$mod['mod_id'];?>" id="adu_edit<?=$mod['mod_id'];?>" <? if(isset($arrayAddEdit[$mod['mod_id']])){ if($arrayAddEdit[$mod['mod_id']][1]==1) echo ' checked="checked"'; }?> value="1"></td>
										<td align="center"><input type="checkbox" name="adu_delete<?=$mod['mod_id'];?>" id="adu_delete<?=$mod['mod_id'];?>" <? if(isset($arrayAddEdit[$mod['mod_id']])){ if($arrayAddEdit[$mod['mod_id']][2]==1) echo ' checked="checked"'; }?> value="1"></td>
									</tr>
								<?
								}
							}
							unset($db_getall_channel);
							?>
						</table>
						</td>
						</tr>
						 
						 
						
						<tr> 
							<td nowrap align="right"></td>
							<td>
								<input type="button" class="bottom" onClick="document.edit_user.submit();" value="<?=translate_text("Cập nhật")?>">
							</td>
						</tr>
					</table>
			<input type="hidden" name="Action" value="update">
			<input type="hidden" name="record_id" value="<?=$row["UserId"]; ?>">
			</form>
		</td>
		<td align="center" valign="top">
			<form ACTION="<?=$ff_action;?>?iAdm=<?=$iAdm?>" METHOD="POST" name="edit_password" onSubmit="formchangepass(); return false;">
					<table align="center" cellpadding="4" cellspacing="1" bordercolor="#CCCCCC" border="1" style="border-collapse:collapse">
						<?
						if($errorMsgpass!=''){
						?>
							<tr>
								<td colspan="2" style="color:#FF0000"><?=$errorMsgpass?></td>
							</tr>
						<?
						}
						?>
						<tr> 
							<td align="right" nowrap="nowrap" class="textBold"><?=translate_text("Mật khẩu mới")?> :</td>
							<td>
								<input type="password" name="Password" id="Password" size="20" class="form">
							</td>
						</tr>
						<tr> 
							<td align="right" nowrap="nowrap" class="textBold"><?=translate_text("Nhập lại mật khẩu")?> :</td>
							<td>
								<input type="password" name="Password_con" id="Password_con" size="20" class="form">
							</td>
						</tr>
						<tr> 
							<td nowrap align="right"></td>
							<td> 
								<input type="submit" class="bottom" value="<?=translate_text("Cập nhật")?>" > 
							</td>
						</tr>
					</table>
					<input type="hidden" name="Action" value="update_password">
					<input type="hidden" name="record_id" value="<?=$row["UserId"]; ?>">
			</form>
		</td>
	</tr>
</table>
<script language="javascript">
function formchangepass(){
	if(document.getElementById("adm_password").value==''){
		document.getElementById("adm_password").focus();
		alert("<?=translate_text("Please enter new password")?>");
		return false;
	}
	if(document.getElementById("adm_password").value!=document.getElementById("adm_password_con").value){
		document.getElementById("adm_password_con").focus();
		alert("<?=translate_text("New password and confirm password is not correct")?>");
		return false;
	}
	document.edit_password.submit();
}
</script>
<?=template_bottom() ?>
</body>
<?
$db_admin_sel->close();
unset($db_admin_sel);
?>