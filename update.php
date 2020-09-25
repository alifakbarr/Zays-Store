<?php 
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$id_jenis = $_POST['id_jenis'];
$nama_jenis = $_POST['nama_jenis'];
$kode_jenis = $_POST['kode_jenis'];
$keterangan = $_POST['keterangan'];

// update data ke database
mysqli_query($koneksi,"update jenis set nama_jenis='$nama_jenis', kode_jenis='$kode_jenis', keterangan='$keterangan' where id_jenis='$id_jenis'");

// mengalihkan halaman kembali ke index.php
header("location:jenis.php");

?>