<?
$module_id	= 14;

$fs_table   = "bieu_mau";
$field_id   = "bm_id";
$field_name = "bm_name";
$id_field   = "bm_id";

$fs_filepath		= "../../../pictures/".date("Y",time())."/".date("m",time())."/".date("d",time())."/";
$pathimage = "../../../pictures/";
$extension_list 	= "jpg,gif,png,swf";
$limit_size			= 300000;
#+
$small_width		= 	125;
$small_heght		=	97;
$small_quantity		=	100;
#+
$medium_width		= 	250;
$medium_heght		=	100;
$medium_quantity	=	90;

require_once("../../resource/security/security.php");
//Check user login...
checkLogged();
//Check access module...
	
$arrCatType =	array("static"	=> translate_text("Trang tĩnh"),
                  	);
                  	
$cat_type_select	= '';
foreach($arrCatType as $key => $value) $cat_type_select[]	= "'" . $key . "'";
$cat_type_select = implode(',', $cat_type_select);

$array_config		= array("image"=>1,"upper"=>1,"order"=>1,"description"=>1);	
function replaceTitle($title){
   	$title	= removeAccent($title);
   	$arr_str	= array( "&lt;","&gt;","/","\\","&apos;", "&quot;","&amp;","lt;", "gt;","apos;", "quot;","amp;","&lt", "&gt","&apos", "&quot","&amp","&#34;","&#39;","&#38;","&#60;","&#62;");
   	$title	= str_replace($arr_str, " ", $title);
   	$title = preg_replace('/[^0-9a-zA-Z\s]+/', ' ', $title);
   	//Remove double space
   	$array = array(
   		'    ' => ' ',
   		'   ' => ' ',
   		'  ' => ' ',
   	);
   	$title = trim(strtr($title, $array));
   	$title	= str_replace(" ", "-", $title);
   	$title	= urlencode($title);
   	// remove cac ky tu dac biet sau khi urlencode
   	$array_apter = array("%0D%0A","%","&");
   	$title	=	str_replace($array_apter,"-",$title);
   	$title	= strtolower($title);
   	return $title;
   }
?>