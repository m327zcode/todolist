<?php
// menambah/memangil file config
include_once('config.php');
?>

<!DOCTYPE html>
<html lang="id">

<!-- Title & CSS -->
<head>
	<title>To Do List</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
</head>
<body>

<!-- Header Judul dan Logo -->
<header name="top">
	<img src="lg.png" alt="todolist.png"/>
	<h1>To Do List</h1>

		<form method="post">
			<div class="fil">
				<select name="bulan">
					<?php
					for ($i=1; $i <= 12; $i++) {
						$bln=sprintf("%02d", $i);
						echo $bln."<br>";
						$string = strtotime(date('Y-').$bln.'-01');
						$tgl = date('F',$string);
						echo "<option value=$i>$tgl</option>";
					}
					?>
				</select>
				<select name="tahun" id="select">
					<?php
					for ($i=2016; $i < 2050; $i++) {
					echo "<option value=$i>$i</option>";
					}
					?>
				</select>
				<input type="submit" name="ok" value="OK  ">
			</div>
		</form>

</header>

<!-- Select filter Bulan & Tahun -->
<section>

	<!-- Perulangan Mengulang kotak sebanyak 31 buah -->
	<?php
	$tgl = date('d');
	for ($i=1; $i <= $tgl; $i++) {
	?>

	<!-- Kotak dengan isi check box untuk inputan data ke database dan text untuk menambah pilihan checkbox-->
	<div class='kotak'>
	<form action="simpan.php" method="post">
		<div>
			<center>
				<label><?php echo $i ." November ". date('Y'); ?></label>
				<hr/>
			</center>
		</div>

		<div name='checkbox' class='checkbox'>

			<!-- menampilkan data dari database -->
			<?php
			$result = mysqli_query($mysqli, "SELECT * FROM kegiatan_jenis ORDER BY id ASC");
			while ($res = mysqli_fetch_array($result)) {
				?>
				<div>
					<?php $tang = date('Y-m-d');
					?>
					<input type="hidden" name="tgl" value="<?php echo $tang ?>">

					<?php
					$que = "SELECT * FROM kegiatan_history";
					$que = mysqli_query($mysqli, $que);
					$real = 'yes';
					if($real == 'yes'){
						?>
						<input type='checkbox' name='id_keg[<?php echo $res['id'] ?>]' checked="checked"><?php echo $res['nama_kegiatan'] ?>
						<?php
					}else{
					 ?>

						<input type='checkbox' name='id_keg[<?php echo $res['id'] ?>]' ><?php echo $res['nama_kegiatan'] ?>
					<?php
					} ?>

				</div>
			<?php
			}
			 ?>

		</div>

		<div>
			<!-- <input type='text' name='input'> -->
			<button type="submit">tambah</button>
		</div>

	</form>
	</div>
	<?php
	}
	?>
</section>

<!-- Membuat footer berada di bawah tidak di bawah 1 kotak saja -->
<div class="clearfix"></div>

<!-- Footer -->
<footer>
	<small>Copyright &copy; <?php echo date('Y'); ?> Muhammad Gufron <a href="#top">Top</a></small>
</footer>
</body>
</html>
