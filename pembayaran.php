<?php 
session_start();
//koneksi database
include 'koneksi.php';

//jika tidak ada seasson pelanggan (blm Login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}

//mendapatkan id_pembelian dari url
$idpem = $_GET["id"];
$ambil= $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian = '$idpem'");
$detpem = $ambil->fetch_assoc();

//mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
//mendapatkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !==$id_pelanggan_beli)
{
	echo "<script>alert('TIDAK SEMUDAH ITU FERGUSOO');</script>";
	echo "<script>location='riwayat.php'</script>";
	exit();
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>pembayaran</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">

 </head>
 <body>
 	<?php include 'menu.php'; ?>

 	<div class="container">
 		<h2>Konfirmasi Pembayaran</h2>
 		<p>Kirim bukti pembayaran anda disini</p>
 		<div class="alert alert-info">Total tagihan anda <strong>Rp. <?php echo number_format
 		($detpem["total_pembelian"]) ?></strong></div>

 		<form method="post" enctype="multipart/form-data">
 			<div class="form-group">
 				<label>Nama Penyetor</label>
 				<input type="text" name="nama" class="form-control">
 			</div>
 			<div class="form-group">
 				<label>Bank</label>
 				<input type="text" name="bank" class="form-control">
 			</div>
 			<div class="form-group">
 				<label>Jumlah</label>
 				<input type="number" name="jumlah" min="1" class="form-control">
 			</div>
 			<div class="form-group">
 				<label>Foto Bukti</label>
 				<input type="file" class="form-control" name="bukti">
 				<p class="text-danger">Foto bukti harus JPG maksimal 2MB</p>
 			</div>
 			<button class="btn btn-primary" name="kirim">Kirim</button>
 		</form>
 	</div>

 	<?php 
 		//jika ada tombol kirim
 		if (isset($_POST["kirim"]))
 		{
 			//upload dulu foto bukti
 			$namabukti = $_FILES["bukti"]["name"];
 			$lokasibukti = $_FILES["bukti"]["tmp_name"];
 			$namafiks = date("YmdHis").$namabukti;
 			move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

 			$nama = $_POST["nama"];
 			$bank = $_POST["bank"];
 			$jumlah = $_POST["jumlah"];
 			$tanggal = date("Y-m-d");

 			//simpan pembayaran
 			$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES 
 				('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks') ");

 			//update data pembelianya dari pending menjadi sudah kirim pembayaran
 			$koneksi->query("UPDATE pembelian SET status_pembelian = 'Sudah kirim pembayaran'
 				WHERE id_pembelian = '$idpem'");

 				echo "<script>alert('Terima kasih sudah mengirimkan bukti pembayaran');</script>";
			echo "<script>location='riwayat.php'</script>";
 		}
 	?>	

 </body> 
 </html>