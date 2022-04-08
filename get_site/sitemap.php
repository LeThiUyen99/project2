<?

include("../home/config.php");
date_default_timezone_set("Asia/Bangkok");

$urls = array();

$day = date('Y-m-d\TH:i:sP', time());

$urls[] = array('https://banthe24h.vn/' , $day,  'daily', '1');

$urls[] = array('https://banthe24h.vn/tien-ich/mua-the-dien-thoai' , $day,  'daily', '0.9');
$urls[] = array('https://banthe24h.vn/tien-ich/mua-the-game' , $day,  'daily', '0.8');
$urls[] = array('https://banthe24h.vn/tien-ich/nap-tien-dien-thoai' , $day,  'daily', '0.8');
$urls[] = array('https://banthe24h.vn/thong-bao-mua-tcoin' , $day,  'daily', '0.8');
$urls[] = array('https://banthe24h.vn/chiet-khau' , $day,  'daily', '0.1');

$urls[] = array('https://banthe24h.vn/giai-quyet-khieu-nai' , $day,  'daily', '0.1');
$urls[] = array('https://banthe24h.vn/dieu-khoan-su-dung' , $day,  'daily', '0.1');


$urls[] = array('https://banthe24h.vn/tin-tuc-1.html' , $day,  'daily', '0.7');
$urls[] = array('https://banthe24h.vn/huong-dan-8.html' , $day,  'daily', '0.7');
$urls[] = array('https://banthe24h.vn/chuyen-muc-hoi-dap' , $day,  'daily', '0.7');


$result = new db_query("SELECT Id,articles.categoryid,ImageUrl,Intro,articles.Description,Title,categoryname,ShortTitle,articles.Meta,PublicDate,articles.MetaDesc
                                         FROM articles 
                                         LEFT JOIN categories ON articles.categoryid = categories.categoryid
                                         WHERE IsActive = 1 AND link_301 = ''");

while($row = mysql_fetch_assoc($result->result)) {

    if($row['ShortTitle'] != NULL)
    {
       $urlshort = $row['ShortTitle'];
    }
    else
    {
       $urlshort = $row['Title'];
    }

    $day = date('Y-m-d\TH:i:sP', strtotime($row['PublicDate']));
    $link = $urlwebsite.rewrite_news($row['Id'],$row[''],$row['categoryname']);

    preg_match_all('/<img[^>]+src=(?:\"|\')\K(.[^">]+?)(?=\"|\')/', $row['Description'], $imgs);
    $imgs = $imgs[1];
    $imgs = array_unique($imgs);
    $urls[] = array($link , $day,  'hourly', '0.6',$imgs);

    unset($imgs);
}


$xml = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="https://banthe24h.vn/css/css-sitemap.xsl"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach ($urls as $key => $value) {	
	$xml .= '<url><loc>'.$value['0'].'</loc><lastmod>'.$value['1'].'</lastmod><changefreq>'.$value['2'].'</changefreq><priority>'.$value['3'].'</priority>';

  if (count($value['4']) > 0) {
      foreach ($value['4'] as $keys => $values) {
          $xml .= '<image:image><image:loc>https://banthe24h.vn'.$values.'</image:loc></image:image>';
      }
  }
  $xml .= '</url>';


}

$xml .= '</urlset>';

$fp = fopen($file1,"w"); 
fputs($fp, $xml); 
fclose($fp);

unset($urls);


echo 'done';

?>

