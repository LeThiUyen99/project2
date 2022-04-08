<?
include("config.php"); 
$url_comment = getValue("url_comment","str","POST",0);
$comment_user = getValue("comment_user","str","POST",0);
$comment_content = getValue("comment_content","str","POST",0);
$captcha = getValue("captcha","int","POST",0);
$rate  = getValue("rate","int","POST",0);
$id  = getValue("id","int","POST",0);
if($captcha != $_SESSION['code']){
    $data = array(
        'status' => 0,
        'error' => "Mã captcha chưa đúng"
    );
}else{
    $update = new db_query("UPDATE mayinthecao SET `rating` = 'rating' + '$rate' ,`numrate` = 'numrate' + 1 WHERE id = '$id'");
    $insert = new db_query("INSERT INTO comment (`url_cm`,`cm_user`,`Content`,`CreateDate`,`Status`) VALUES ('$url_comment','$comment_user','$comment_content',NOW(),'1')");
    $db_new = new db_query("SELECT CommentID,rating,numrate FROM comment WHERE `url_cm` = '$url_comment' ORDER BY CommentID DESC LIMIT 1");
    $rownew = mysql_fetch_assoc($db_new->result);
    
    $rate_n = ceil($rate/5);
    $rate_n *100;
    $rate_n=$rate_n."%";
    $data = array(
        'status' => 1,
        'html' => '
        <li class="comment_content">
        <div class="cm_username">
            <div class="img"><img src="/images/may_in_the/gia_ca.png" alt="avarta"></div>
            <strong>'.$comment_user.'</strong>
            <div class="bg_rate">
                <div class="rate_range" style="width: '.$rate_n.';"></div>
                <div class="fake_rate"></div>
            </div>
        </div>
        <div class="user_comment">'.$comment_content.'</div>
        <div class="reply_cm">
            <span class="reply_user" data-id="'.$rownew['CommentID'].'">Trả lời</span>
            <span class="date"> | '.date('d/m/Y').'</span>
        </div>
        <div class="list_reply" data-url="'.$url_comment.'">
            
        </div>
        <div class="comment_post reply_post hide">
            <div class="close_cp text-right"><span>✖</span></div>
            <div class="form_group">
                <input type="text" name="fullname" class="form_general" id="cm_user" placeholder="Họ và tên (*)">
                <input type="text" name="captcha" class="form_general" id="captcha" placeholder="Nhập mã Captcha (*)">
                <img src="/classes/securitycode.php" class="img_captcha" alt="captcha">
                <span class="reload_captcha">🗘</span>
            </div>
            <div class="form_group">
                <textarea class="form_general" name="comment_content" id="comment_content" cols="30" rows="10" placeholder="Nhập bình luận của bạn"></textarea>
            </div>
            <div class="form_group text-right pr-4">
                <input type="submit" id="btn_reply" name="btn_reply" value="Gửi" data-id="">
            </div>
        </div>
        </li>
        '
    );
}
echo json_encode($data);



                            
                            
                            
                            
                            
                        