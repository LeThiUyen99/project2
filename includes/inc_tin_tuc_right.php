      <div class="col-md-4 col-xs-12 main-tintuc-right">
        <div class="title1"><span>Tin tức</span></div>
        <div class="clearfix"></div>
        <div class="news">
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
               
               ?>
               <div class="caption">
            <a rel="nofollow" href="<?= rewrite_news($rownew['Id'],$urlshort,$rownew['categoryname']) ?>">
              <i class="fa fa-hand-o-right"></i> <?= $rownew['Title'] ?>
            </a>
          </div>
               
               <?
               unset($urlshort);
               }
               unset($db_qrnew,$rownew);
               ?>
          
          
        </div>
      
      <div class="banner">
        <a rel="nofollow">
          <img src="/images/bannerjp.png" alt="banner mua thẻ cào online">
        </a>
      </div>
      <div class="question">
        <div class="title1"><span>Câu hỏi thường gặp</span></div>
        <div class="clearfix"></div>
        <div class="news">
             <?
               $db_qrnew = new db_query("SELECT * FROM faqs ORDER BY createdate DESC LIMIT 4");
               while($rownew = mysql_fetch_assoc($db_qrnew->result))
               {
               ?>
               <div class="caption">
            <a rel="nofollow" href="<?= rewrite_news($rownew['FaqID'],$rownew['Title'],"chuyen-muc-hoi-dap")  ?>">
              <i class="fa fa-hand-o-right"></i> <?= $rownew['Title'] ?>
            </a>
          </div>               
               <?
               }
               unset($db_qrnew,$rownew);
               ?>
          
          
        </div>
      </div>
    </div>