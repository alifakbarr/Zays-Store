<?php 
session_start();
//koneksi database
include 'koneksi.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Zays Store</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
</head>
<body>
	<!-- <ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="keranjang.php">Keranjang</a></li>
		<li><a href="login.php">Login</a></li>
		<li><a href="checkout.php">Checkout</a></li>
	</ul>
 -->
	
	<?php include 'menu.php'; ?>

	<section class="konten">
		<div class="container">
			<hr><h1>Produk Terbaru</h1><hr>
			<div class="row">

				<?php $ambil = $koneksi->query("SELECT * FROM produk ");?>
				<?php while ($perproduk = $ambil->fetch_assoc()) { ?>
				

				<div class="col-sm-6 col-md-4">
					<div class="thumnail">
						<img src="foto_produk/<?php echo $perproduk['foto_produk'];?>" width="190";>
						<div class="caption">
							<h3><?php echo $perproduk['nama_produk'];?></h3>
							<h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
							<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
							<a href="detail.php?id=<?php echo $perproduk["id_produk"]; ?>" class="btn btn-default">Detail</a>
						</div>
					</div>
				</div>
				<?php } ?>

			</div>
		</div>
	</section>



</body>
</html>