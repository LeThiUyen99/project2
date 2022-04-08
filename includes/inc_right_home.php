<div class="right-home">
   <div class="full-right-home">
      <div class="tinmoinhat">
         <div class="listthongbao">
            <div class="title-2">Tin tức</div>
            <div class="listitem">
               <?
               $db_qrnew = new db_query("SELECT Id,articles.categoryid,ImageUrl,Title,categoryname,ShortTitle
                                         FROM articles 
                                         LEFT JOIN categories ON articles.categoryid = categories.categoryid
                                         WHERE IsActive = 1 AND articles.categoryid = 1 
                                         ORDER BY Id DESC LIMIT 4");
               While($rownew = mysql_fetch_assoc($db_qrnew->result))
               {
               if($rownew['ShortTitle'] != NULL)
               {
                  $urlshort = $rownew['ShortTitle'];
               }
               else
               {
                  $urlshort = $rownew['Title'];
               }
               $src=$rownew['ImageUrl'];
                     if(strpos($rownew['ImageUrl'],'/upload/files') === false)
                     {
                        $src="/pictures/news/".$rownew['ImageUrl'];
                     }
               ?>
               <div class="itemnews">
                  <a rel="nofollow" href="<?= rewrite_news($rownew['Id'],$urlshort,$rownew['categoryname']) ?>">
                  <img src="<?= $src ?>" title="<?= $rownew['Title'] ?>"/></a>  
                  <h4 class="panel-title"><a rel="nofollow" href="<?= rewrite_news($rownew['Id'],$urlshort,$rownew['categoryname']) ?>"><?= $rownew['Title'] ?></a></h4>
               </div>
               <?
               unset($urlshort);
               }
               unset($db_qrnew,$rownew);
               ?>
            </div>
         </div>
      </div>
      <div style="clear: both; position: relative; width: 102%; background-color: #e8e8e8;height:17px;margin:1px 0px;left:-2px;"></div>
      <div class="cauhoithuonggap">
         <div class="titel-faq">CÂU HỎI THƯỜNG GẶP</div>
         <div class="listhuongdan">
            <ul>
               <?
               $db_qrnew = new db_query("SELECT * FROM faqs ORDER BY createdate DESC LIMIT 4");
               while($rownew = mysql_fetch_assoc($db_qrnew->result))
               {
               ?>
               <li><a rel="nofollow" href="<?= rewrite_news($rownew['FaqID'],$rownew['Title'],"chuyen-muc-hoi-dap")  ?>"><?= $rownew['Title'] ?></a></li>
               <?
               }
               unset($db_qrnew,$rownew);
               ?>
            </ul>
         </div>
      </div>
      <div style="clear: both; position: relative; width: 102%; background-color: #e8e8e8;height:17px;margin:1px 0px;left:-2px;"></div>
      <div class="support_right">
         <h3 class="support_title">Liên hệ trực tiếp</h3>
         <div><span class="support_phone">0972.022.116</span><span class="support_name">Hỗ trợ</span></div>
      </div>
      <div style="clear: both; position: relative; width: 102%; background-color: #e8e8e8;height:17px;margin:1px 0px;left:-2px;"></div>
      
   </div>
</div>