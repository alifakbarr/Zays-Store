<nav class="navbar navbar-default">
		<div class="container">
			
		<ul class="nav navbar-nav" >
			<li><a href="index.php"><font color="black"><b>	Home</b></font></a></li>
			<li><a href="keranjang.php"><font color="black"><b>Keranjang</b></font></a></li>
			<!-- jika sudah login(ada session pelanggan) -->
			<?php if (isset($_SESSION["pelanggan"])): ?>
				<li><a href="riwayat.php"><font color="black"><b>Riwayat Belanja</b></font></a></li>
				<li><a href="logout.php"><font color="black"><b>Logout</b></font></a></li>

			<!-- selain itu(blm logi || blm ada session pelanggan) -->
		<?php else: ?>
			<li><a href="login.php"><font color="black"><b>Login</b></font></a></li>
			<li><a href="daftar.php"><font color="black"><b>Daftar</b></font></a></li>
		<?php endif	 ?>
			<li><a href="checkout.php"><font color="black"><b>Checkout</b></font></a></li>
			
		</ul>
		</div>
	</nav>

