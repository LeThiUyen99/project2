<?php
require_once("../functions/functions.php"); 
require_once("../classes/database.php");
$sql = "SELECT * FROM comment ORDER BY parent_cm_id asc, CommentID asc";
$result = mysqli_query($conn, $sql);
$record_set = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($record_set, $row);
}
mysqli_free_result($result);
mysqli_close($conn);
echo json_encode($record_set);
?>