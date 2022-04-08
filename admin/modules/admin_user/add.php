<?
require_once("inc_security.php");
//check quyền them sua xoa
checkAddEdit("add");

$ff_action 					= $_SERVER['REQUEST_URI'];
$ff_redirect_succ 		= "listing.php";
$ff_redirect_fail 		= "";


$Action 						= getValue("Action","str","POST","");
$arelate_select  			= getValue("arelate_select","arr","POST",array());
$menuid 				= new menu();
$menuid->getAllRecodeNew("categories","CategoryID","",0,"Status >=0" ,"CategoryID,CategoryName,Description,Status,Code,Meta,MetaDesc","CategoryID ASC");//getArray("categories_multi","cat_id","cat_parent_id"," lang_id = " . $lang_id);
$adm_access_category 	= '';
foreach($arelate_select as $key=>$value){
	$adm_access_category .= '[' . str_replace(",","][",$menuid->getAllChildId($value)) . ']';
}

$errorMsg = "";
$allow_insert = 1;
$myform = new generate_form();
$myform->add("UserName","UserName",4,0,"",1,"",0,"");
$myform->add("FullName","FullName",0,0,"",0," Điền tên đại diện !",0,"");
$myform->add("UserNameCode","UserNameCode",0,0,"",0," Namecode !",0,"");
$myform->add("Password","Password",0,0,"",0,"",0,"");
$myform->add("Note","Note",1,0,0,0,"",0,"");
$myform->add("GroupId","GroupId",1, 0, 0, 1, translate_text("Bạn chưa chọn danh mục"), 0, "");
$myform->add("Status","Status",1, 0, 1, 0, "", 0, "");
$myform->addTable("useradmin");
//get vaule from POST
$adm_loginname = getValue("adm_loginname","str","POST","",1);
//password hash md5 --> only replace \' = '
$adm_password = getValue("adm_password","str","POST","",1);
//get Access Module list
$module_list			= "";
$module_list  			= getValue("mod_id","arr","POST","");
$arelate_select  		= getValue("arelate_select","arr","POST","");

if ($Action =='insert')
{
	if ($module_list ==""){
		$allow_insert = 0;
		$errorMsg 			.= translate_text("Please_select_modules!");
	}
	
	//insert new user to database
	if ($allow_insert == 1){
		//Call Class generate_form();
        //{ ["UserName"]=> string(6) "test01" 
        //["FullName"]=> string(6) "test01" 
        //["UserNameCode"]=> string(4) "0033" 
        //["Password"]=> string(9) "longtt123" 
        //["Password_con"]=> string(9) "longtt123" 
        //["Note"]=> string(1) "a" ["GroupId"]=> string(1) "1" 
        //["Status"]=> string(1) "1" 
        //["mod_id"]=> array(1) { [0]=> string(2) "23" } ["Action"]=> string(6) "insert" }
        
		//$myform->generate_insert_SQL();
		$errorMsg .= $myform->checkdata();
		$last_id = 0;
        if($_POST['UserName']!='' && $_POST['Password']!=''){
            $querystr = "INSERT INTO useradmin(UserNameCode,UserName,Password,FullName,GroupId,Note,Status) VALUES('".$_POST["UserNameCode"]."',
            '".$_POST["UserName"]."','".md5($_POST["Password"])."','".$_POST["FullName"]."','".intval($_POST["GroupId"])."','".$_POST["Note"]."','".intval($_POST["Status"])."')";
        }
        //var_dump($querystr);die();
		if($errorMsg == ""){
			$db_ex = new db_execute_return();
			$last_id = $db_ex->db_execute($querystr);
			unset($db_ex);
			if($last_id!=0){
				//insert user right\
				if(isset($module_list[0])){
					for ($i=0; $i< count($module_list); $i++){
						$query_str = "INSERT INTO admin_user_right VALUES(" . $last_id . "," . $module_list[$i] . ", " . getValue("adu_add" . $module_list[$i] , "int","POST") . ", " . getValue("adu_edit" . $module_list[$i] , "int","POST") . ", " . getValue("adu_delete" . $module_list[$i] , "int","POST") . ")";
						$db_ex = new db_execute($query_str);
						unset($db_ex);
					}
				}
				//if(isset($user_lang_id_list[0])){
//					for ($i=0; $i< count($user_lang_id_list); $i++){
//						$query_str = "INSERT INTO admin_user_language VALUES(" . $last_id . "," . $user_lang_id_list[$i] .")";
//						$db_ex = new db_execute($query_str);
//						unset($db_ex);
//					}
//				}
				//category right
			
			redirect($ff_redirect_succ);
			exit();
			}
		}
	}
}
$myform->evaluate();
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
<?=template_top(translate_text("Add new member"))?>
		<? /*---------Body------------*/ ?>
			<form ACTION="<?=$ff_action;?>" METHOD="POST" name="add_user" enctype="multipart/form-data">
			<table cellpadding="5" cellspacing="0" style="border-collapse:collapse" border="0" bordercolor="<?=$fs_border?>">
			<tr valign="baseline"> 
			<td class="textBold" colspan="2" align="center">
			<font color="#FF0000"><?=$errorMsg;?></font>
			</td>
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
			<table cellpadding="2" cellspacing="0" style="border-collapse:collapse" border="1" bordercolor="<?=$fs_border?>">
				<tr bgcolor="#E0EAF3" height="30">
					<td class="textBold"><?=translate_text("Chọn")?></td>
					<td class="textBold"><?=translate_text("Danh sách")?></td>
					<td class="textBold"><?=translate_text("Thêm")?></td>
					<td class="textBold"><?=translate_text("Sửa")?></td>
					<td class="textBold"><?=translate_text("Xóa")?></td>
				</tr>
				<?
				while ($row=mysql_fetch_array($db_getallmodule->result)){
					if(file_exists("../../modules/" . $row["mod_path"] . "/inc_security.php")===true){
					?>
						<tr>
							<td align="center"><input type="checkbox" name="mod_id[]" id="mod_id" value="<?=$row['mod_id'];?>"></td>
							<td class="textBold"><?=translate_text($row['mod_name']);?></td>
							<td align="center"><input type="checkbox" name="adu_add<?=$row['mod_id'];?>" id="adu_add<?=$row['mod_id'];?>" value="1"></td>
							<td align="center"><input type="checkbox" name="adu_edit<?=$row['mod_id'];?>" id="adu_edit<?=$row['mod_id'];?>" value="1"></td>
							<td align="center"><input type="checkbox" name="adu_delete<?=$row['mod_id'];?>" id="adu_delete<?=$row['mod_id'];?>" value="1"></td>
						</tr>
					<?
					}
				}
				unset($db_getall_channel);
				?>
			</table>
			</td>
			</tr>
			 
			
			<tr valign="baseline"> 
			<td nowrap align="right"> </td>
			<td> <input type="button" class="bottom" onClick="document.add_user.submit();" value="<?=translate_text("Cập nhật")?>"> 
			</td>
			</tr>
			</table>
			<input type="hidden" name="Action" value="insert">
			</form>
		<? /*---------Body------------*/ ?>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
<?
$db_getallmodule->close();
unset($db_getallmodule);
?>