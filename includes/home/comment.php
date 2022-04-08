<div class="div-comment" style="margin-top: 20px;">

<span class="tt_dbl">Đăng bình luận.</span>
<div class="comment-ctn">
  <form id="frm-comment">
    <div class="input-row">
      <textarea class="input-field" type="text" name="Content"
      id="comment" placeholder="Viết bình luận của bạn..">  </textarea>
    </div>
    <div class="input-row">
      <input style="display: none;" id="ip_cm" value="<?=$ip ?>" />
      <input type="hidden" name="comment_id" id="commentId" placeholder="Name" /> 
      <input class="input-field" type="text" name="name" id="name" placeholder="Tên" value="<?=$_SESSION['name_cm'] ?>" />
      <input class="input-field" type="text" name="captcha_code" id='captcha_code' placeholder="Mã captcha" />
      <div class="cap"><img class="captcha_code" src="/classes/securitycode.php"><span title="Đổi mã captcha khác" class="reload_cap" onclick="refreshCaptcha()">&#8635;</span></div>
    </div>
    <div>
      <input type="button" class="btn-submit" id="submitButton"
      value="Đăng Bình Luận" />
      <div id="comment-message">Đăng bình luận thành công!</div>
    </div>
  </form>
</div>   
<div id="output">
  <?
   $client  = @$_SERVER['HTTP_CLIENT_IP'];
   $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
   $remote  = $_SERVER['REMOTE_ADDR'];
   $ip='';
   if(filter_var($client, FILTER_VALIDATE_IP)){
      $ip = $client;
   }
   elseif(filter_var($forward, FILTER_VALIDATE_IP)){
      $ip = $forward;
   }
   else{
      $ip = $remote;
   }

  $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
  $urlcano_cm = 'https://banthe247.com'.$uri_parts[0];

  $arr_cm = $arr_cmp = array();
  $db_cm = new db_query("SELECT * FROM comment WHERE url_cm = '".$urlcano_cm."' ORDER BY parent_cm_id ASC,CreateDate DESC");
  if (mysql_num_rows($db_cm->result)>0) {
    While($row_cm = mysql_fetch_assoc($db_cm->result)) {
      if ($row_cm['parent_cm_id'] == 0) {
        $arr_cm[] = array($row_cm['CommentID'],$row_cm['Content'],$row_cm['cm_user'],$row_cm['CreateDate'],$row_cm['ip_cm']);
      }else{
        if (!isset($arr_cmp[$row_cm['parent_cm_id']])) {
          $arr_cmp[$row_cm['parent_cm_id']]= array();
        }
        $arr_cmp[$row_cm['parent_cm_id']][] = array($row_cm['CommentID'],$row_cm['Content'],$row_cm['cm_user'],$row_cm['CreateDate'],$row_cm['ip_cm']);
      }
    }
    echo '<ul class="outer-comment">';
    foreach ($arr_cm as $key => $value) {

      if (@$_SESSION["admin_id"] == 4) {
        $del = '<a class="btn-reply" onclick="delReply('.$value[0].')" >Xóa phản hồi</a>';
      }else{
        $del = '';
      }
      $img_cm ='';
      if (in_array($value[4], $arr_ip)){
        $img_cm = '/images/img/logo_cm.png';
      }
      else{
        $img_cm = '/images/dk_s.png';
      }

      echo '<li data-id="'.$value[0].'" ><div class="img_cm"><img src="'.$img_cm.'" alt="timviec365"></div><div class="comment-row"><div class="comment-info"><span class="posted-by">'.$value[2].' </span>  <span class="posted-at">'.date('H:i d/m/Y',$value[3]).'</span></div><div class="comment-text">'.strip_tags($value[1]).' </div><div><a class="btn-reply" onclick="postReply('.$value[0].')" >Trả lời</a>'.$del.'</div></div><div class="com"><ul class="reply_'.$value[0].'</div>">';

    foreach ($arr_cmp[$value[0]] as $key => $value) {

      if (@$_SESSION["admin_id"] == 4) {
        $del = '<div><a class="btn-reply" onclick="delReply('.$value[0].')" >Xóa phản hồi</a></div>';
      }else{
        $del = '';
      }
      $img_cm2 ='';
      if (in_array($value[4], $arr_ip)){
        $img_cm2 = '/images/img/logo_cm.png';
      }
      else{
        $img_cm2 = '/images/dk_s.png';
      }
      echo '<li data-id="'.$value[0].'" style="border:none"><div class="img_cm"><img src="'.$img_cm2.'" alt="timviec365"></div><div class="comment-row"><div class="comment-info"> <span class="posted-by">'.$value[2].' </span> - <span class="posted-at">'.date('H:i d/m/Y',$value[3]).'</span></div><div class="comment-text">'.strip_tags($value[1]).' </div>'.$del.'</div></li>';
      }
      echo '</ul></li>';
    }
    echo '</ul>';
  }
  ?>
</div>                     
</div>

<style type="text/css">
.comment-text{ padding: 5px 0px; font-size: 14px;}
.input-row #name,.input-row #captcha_code{width: 30%;display: inline-block;margin-right: 7px;}
.input-row .captcha_code{ margin: 0px!important;position: relative;top: 10px;height: 30px; }
.reload_cap{font-size: 26px;color: #ff9a00;margin-left: 10px;position: relative;top: 5px;cursor: pointer;}
#output .btn-reply{margin-right: 8px;}
@media screen and (max-width:480px) {
  .input-row #name,.input-row #captcha_code{width: 70%;}
}
</style>

<script>
function delReply(id){  
$.ajax({
  cache:false,
    type:"POST",  
    url:"/ajax/delete_comment.php", 
    data:{id:id},
    success:function(html){
      alert('đã xóa bình luận !!');
      $("[data-id='"+id+"']").hide();
    }                                                          
});
}
</script>