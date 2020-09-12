<!DOCTYPE html>
<html>
<head>
	<title>Kode Otomatis PHP dan MySQLi </title>
</head>
<body>

	<h2><a href="#">Kode Otomatis PHP dan MySQLi </a></h2>

	<style>
		body{
			font-family: 'Roboto';
		}
		table {
			border-collapse: collapse;
		}

		table, th, td {
			border: 1px solid black;
			padding: 10px;
		}
	</style>
	

	<?php
	
	include 'koneksi.php';

	

$query = mysqli_query($koneksi, "SELECT max(mid(kode,9,4)) as invoice_no 
									FROM barang
									WHERE mid(kode,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')");
									
$data = mysqli_fetch_array($query);
$kodeBarang = $data['invoice_no'];
$urutan = ((int)$kodeBarang) ;
$urutan++;
$nourut = sprintf("%'.04d", $urutan);
//$data = $this->db->query($query);
$kodeBarang = "MP".date('ymd').$nourut;
echo $kodeBarang;







 



 


 

?>

	<form method="post" action="simpan.php">
		<label>Kode Barang</label><br/>
		<input type="text" name="kode" required="required" value="<?php echo $kodeBarang ?>" readonly>

		<br>

		<label>Nama Barang</label><br/>
		<input type="text" name="nama" required="required">
		
		<br>

		<label>Jumlah</label><br/>
		<input type="number" name="jumlah" required="required">

		<br>

		<label>Harga</label><br/>
		<input type="number" name="harga" required="required">

		<br>

		<input type="submit" value="Simpan">
	</form>

	<br>
	<hr>
	<br>

	<table border="1">
		<thead>
			<tr>
				<th>Kode</th>
				<th>Nama Barang</th>
				<th>Jumlah</th>
				<th>Harga</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$barang = mysqli_query($koneksi,"SELECT * FROM barang");
			while($b = mysqli_fetch_array($barang)){
				?>
				<tr>
					<td><?php echo $b['kode']; ?></td>
					<td><?php echo $b['nama_barang']; ?></td>
					<td><?php echo $b['jumlah']; ?></td>
					<td><?php echo "Rp. ".number_format($b['harga'])." ,-"; ?></td>
				</tr>
				<?php 
			}
			?>
		</tbody>
	</table>
</body>
</html>
