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
    $insert = new db_query("INSERT INTO comment (`parent_cm_id`,`url_cm`,`CreateBy`,`Content`,`CreateDate`) VALUES ('$id_reply','$url_comment','$comment_user','$comment_content',NOW())");
    // $db_new = new db_query("SELECT CommentID,numrate FROM comment WHERE `url_cm` = '$url_comment' ORDER BY CommentID DESC LIMIT 1");
    // $rownew = mysql_fetch_assoc($db_new->result);
    $data = array(
        'status' => 1,
        'html' => '

        <div class="reply" id="">
        <div class="cm_user">
            <div class="img">
                <img src="/images/may_in_the/user1.png" alt="avarta">
            </div>
            <div class="name">
                <strong>'.$comment_user.'</strong>
            </div>
        </div>
        <div class="comment_content">'.$comment_content.'</div>
        <div class="reply_cm">
            <span class="reply_user" data-id="">trả lời</span>
            <span class="date"> | '.date('d/m/Y').'</span>
        </div>
    </div>

        '
    );
}
echo json_encode($data);



                            
                            
                            
                            
                            
                        