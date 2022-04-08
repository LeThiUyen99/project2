
   <div class="article">
      
         <span class="subtitle"></span>
         <h1 class="title"><?= $row1['Title'] ?></h1>
         <span class="date_cate"> <img src="/images/icon_clock.png" alt="Clock"/> Cập nhật: <?= date("d/m/Y h:i:s A",strtotime($row1['CreateDate'])) ?></span> 
         <div style="clear:both;height:15px;"></div>
         <div style="text-align:justify;font-weight:bold;"><?= $row1['Answer'] ?></div>
          <div style="text-align:justify;"><?= $row1['FullAnswer'] ?></div>
      
      <div class="clearThis"></div>
   </div>
   <div style="margin-bottom: 10px; clear: both;">
      <div class="relate-link">
         <span>Các câu hỏi khác</span> 
         <div class="clear">
            <ul>
               <?
               $db_qrnew = new db_query("SELECT * FROM faqs WHERE FaqID <> $newid LIMIT 5");
               While($rownew = mysql_fetch_assoc($db_qrnew->result))
               {
               ?>
               <li><a title="<?= $rownew['Title'] ?>" href="<?= rewrite_news($rownew['FaqID'],$rownew['Title'],"chuyen-muc-hoi-dap") ?>"><?= $rownew['Title'] ?></a></li>
               <?
               }
               unset($db_qrnew,$rownew);
               ?>
            </ul>
         </div>
      </div>
   </div>
   