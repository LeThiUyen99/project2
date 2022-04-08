<?
include("config.php"); 
$id_reply =getValue("id_reply","int","POST",0);
$url_comment = getValue("url_comment","str","POST",0);
$comment_user = getValue("comment_user","str","POST",0);
$comment_content = getValue("comment_content","str","POST",0);
$captcha = getValue("captcha","int","POST",0);


if($captcha != $_SESSION['code']){
    $data = array(
        'status' => 0,
        'error' => "Mã captcha chưa đúng"
    );
}else{
    $insert = new db_query("INSERT INTO comment (`parent_cm_id`,`url_cm`,`cm_user`,`Content`,`CreateDate`) VALUES ('$id_reply','$url_comment','$comment_user','$comment_content',NOW())");
    $data = array(
        'status' => 1,
        'html' => '
        <div class="reply" id="">
            <div class="cm_username">
                <div class="img"><img src="/images/may_in_the/mua_sam.png" alt="/images/may_in_the/mua_sam.png"></div>
                <strong>'.$comment_user.'</strong>
            </div>
            <div class="user_comment">'.$comment_content.'</div>
            <div class="reply_cm">
                <span class="reply_user" data-id="">Trả lời</span>
                <span class="date"> | '.date('d/m/Y').'</span>
            </div>
        </div>
        '
    );
}
echo json_encode($data);



                            
                            
                            
                            
                            
                        