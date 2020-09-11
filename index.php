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

	// mengambil data barang dengan kode paling besar
//$query = mysqli_query($koneksi, "SELECT max(kode) as kodeTerbesar FROM barang");
//$data = mysqli_fetch_array($query);
//$kodeBarang = $data['kodeTerbesar'];

// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
//$urutan = (int) substr($kodeBarang, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
//$urutan++;

// membentuk kode barang baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
//$huruf = "BRG";
//$kodeBarang = $huruf . sprintf("%03s", $urutan);
//echo $kodeBarang;

// coba bikin BR G 001

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







 //if($query->num_rows() > 0) {
//	 $row = $data->row();
//	 $n = ((int)$row->invoice_no) + 1;
//	 $no = sprintf("'%'.04d", $n);
 //} else {
//	 $no = "0001";
 //}
//$invoice = "MP".date('ymd').$no;
// echo $invoice;



 


 

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
