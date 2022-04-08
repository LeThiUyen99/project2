<?
include("config.php");
$inputFileName = '../table/articles.xls';
try {
   $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
   $objReader = PHPExcel_IOFactory::createReader($inputFileType);
   $objPHPExcel = $objReader->load($inputFileName);
   } catch(Exception $e) {
   die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
//Chèn vào bảng
for($row = 2; $row <= $highestRow; $row++){ 
 //Read a row of data into an array
 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                 NULL,
                                 TRUE,
                                 FALSE);
 $db_ex = new db_execute("INSERT INTO articles(Id,categoryid,Title,Description,PublicDate,SortOrder,IsActive,CreateDate,CreateUser,ImageUrl,Intro,CodeCat,ShortTitle,MetaDesc,Meta)
                          VALUES('".mysql_escape_string($rowData[0][0])."','".mysql_escape_string($rowData[0][1])."','".mysql_escape_string($rowData[0][2])."','".mysql_escape_string($rowData[0][3])."',
                                 '".date("Y-m-d H:i:s",strtotime($rowData[0][4]))."','".mysql_escape_string($rowData[0][5])."','".mysql_escape_string($rowData[0][6])."',
                                 '".mysql_escape_string($rowData[0][7])."','".mysql_escape_string($rowData[0][8])."','".mysql_escape_string($rowData[0][9])."',
                                 '".mysql_escape_string($rowData[0][10])."','".mysql_escape_string($rowData[0][11])."','".mysql_escape_string($rowData[0][12])."',
                                 '".mysql_escape_string($rowData[0][13])."','".mysql_escape_string($rowData[0][14])."')");
 echo "Insert thành công ".$row."<pre>";
 echo $rowData[0][4]."<br/>";
 //  Insert row data array into your database of choice here

}
?>