<?
// text file cache 
$file = '../cache_file/sql_cache.json'; 
$expire = 1; // 24 hours 
// Nếu có cache file và còn trong thời gian chưa hết $expire 
if (file_exists($file) && filemtime($file) > (time() - $expire)) 
{ 
    // Uunserialize data từ cache file 
    $arraytong       = json_decode(file_get_contents($file),true); 
    $db_result       = $arraytong['db_result'];
    $arrcity         = $arraytong['db_city'];
    $db_cat          = $arraytong['db_cat'];
    $name_tag        = $arraytong['name_tag'];
    $ntd_name_tag    = $arraytong['ntd_name_tag'];
    $cat_only        = $arraytong['cat_only'];
} 
else // Cập nhật cache file 
{ 
    $db_qr = new db_query("SELECT cat_id,cat_name,cat_count,cat_count_vl,cat_ut,cat_lq FROM category WHERE cat_active = 1 ORDER BY cat_order ASC,cat_name ASC");
    $db_result  = $db_qr->result_array();
    $db_qrr = new db_query("SELECT cit_id,cit_name,cit_count,cit_count_vl,cit_count_vlch,postcode FROM city ORDER BY cit_count DESC,cit_name ASC");
    $arrcity  = $db_qrr->result_array('cit_id');
    $db_qr = new db_query("SELECT cat_id,cat_name,cat_tags,cat_count,cat_count_vl,cat_ut,cat_lq FROM category WHERE cat_active = 1 ORDER BY cat_order ASC,cat_count DESC");
    $db_cat  = $db_qr->result_array('cat_id');

    $db_only = new db_query("SELECT cat_id FROM category WHERE cat_active = 1 AND cat_only = 1");
    $cat_only = array();
    While($row_ol = mysql_fetch_assoc($db_only->result))
    {
        $cat_only[] = $row_ol['cat_id']; 
    }

    $db_tag = new db_query("SELECT DISTINCT `key_name` FROM `keyword` WHERE `key_name` != ''");
    $arr_tag = array();
    While($row_tag = mysql_fetch_assoc($db_tag->result))
    {
        $arr_tag[] = $row_tag['key_name']; 
    }
    $name_tag = json_encode($arr_tag);


    $db_tag_ntd = new db_query("SELECT DISTINCT `key_ntd_name` FROM `keyword_ntd` WHERE `key_ntd_name` != ''");
    $arr_ntd = array();
    While($row_ntd = mysql_fetch_assoc($db_tag_ntd->result))
    {
        $arr_ntd[] = $row_ntd['key_ntd_name']; 
    }
    $ntd_name_tag = json_encode($arr_ntd);

    //$db_qrs = new db_query("SELECT tag_id,tag_key FROM tag");
    //$db_tag  = $db_qrs->result_array('tag_id');

    $arraytong = array('db_result' => $db_result,
                       'db_city'   => $arrcity,
                       'db_cat'    => $db_cat,
                       'name_tag'  => $name_tag,
                       'ntd_name_tag' => $ntd_name_tag,
                       'cat_only'    => $cat_only
                   );
    // Serialize data và push vào cache file 
    $OUTPUT = json_encode($arraytong);  
    $fp = fopen($file,"w"); 
    fputs($fp, $OUTPUT); 
    fclose($fp);     
} // end else 

if (isset($_GET['city_id']))
{
    $value = $_GET['city_id'];
     $db_qrcity = new db_query("SELECT cit_id, cit_name FROM city2 WHERE cit_parent = '".$value."' ORDER BY cit_order DESC,cit_name ASC ");
     While($rowcity = mysql_fetch_assoc($db_qrcity->result))
     {
     ?>
     <option class="qh_add" value="<?= $rowcity['cit_id'] ?>"><?= $rowcity['cit_name'] ?></option>
     <?
     }
    exit();
}
?>