<?php
include_once('config.php');
$tgl = $_POST['tgl'];
$sql = "INSERT INTO `kegiatan_history` VALUES ";
foreach ($_POST['id_keg'] as $id => $v) {
  $sql.= "(null,'$id', '$tgl', '', 'ya'),";
}
$sql = substr($sql,0,-1);
echo $sql;
mysqli_query($mysqli,$sql) or die('gagal simpan'.mysqli_error());
header("Location:index.php");
 ?>
