<?php
	
    $berkas = "data.json";
    $dataJson = file_get_contents($berkas);
    $dataMobilAll = json_decode($dataJson, true);

	//	Instruksi Kerja Nomor 1.
	//	Variabel $mobil berisi data jenis mobil yang dipesan dalam bentuk array.
	$daftarMobil = array("Avanza", "Rush", "Alphard", "Inova", "Fortuner");

	//	Instruksi Kerja Nomor 2.
	//	Mengurutkan array $mobil sesuai abjad A-Z.
	array_multisort($daftarMobil, SORT_ASC);		

	//	Instruksi Kerja Nomor 4.
	//	Function ini untuk menghitung total tagihan, dengan mengambil jarak yang diinputkan dan mereturn hasil menjadi total tagihan
	function total_tagihan($jarak)
	{	
		if ($jarak > 10) {
				$tarif10 = 10000;
				$selisihjarak = $jarak - 10;
				$tariftambahan = $selisihjarak * 5000;
				$total_tagihan = $tarif10 + $tariftambahan;
				return $total_tagihan;
			} else {
				return $total_tagihan = $jarak * 1000;
			}
	}
?>

<!DOCTYPE html>
<html>
	<head>
				<title>Pemesanan Taxi Online</title>
		<!-- Instruksi Kerja Nomor 3. -->
		<!-- Menghubungkan dengan library/berkas CSS. -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	    <title>Laundry</title>
	    <link rel="stylesheet" type="text/css" href="npm i bootstrap-icons">

	</head>
	
	<body>
	<div class="container border">
		<!-- Menampilkan judul halaman -->

		<h3>Pemesanan Taxi Online</h3>
		
		<!-- Instruksi Kerja Nomor 7. -->
		<!-- Menampilkan logo Taxi Online -->
		<img src="asset/logo.jpg" alt="">
		
		<!-- Form untuk memasukkan data pemesanan. -->
		<form action="index.php" method="post" id="formPemesanan">
			<div class="row">
				<!-- Masukan data nama pelanggan. Tipe data text. -->
				<div class="col-lg-2"><label for="nama">Nama Pelanggan:</label></div>
				<div class="col-lg-2"><input type="text" id="nama" name="nama"></div>
			</div>
			<div class="row">
				<!-- Masukan data nomor HP pelanggan. Tipe data number. -->
				<div class="col-lg-2"><label for="nomor">Nomor HP:</label></div>
				<div class="col-lg-2"><input type="number" id="noHP" name="noHP" maxlength="16"></div>
			</div>
			<div class="row">
				<!-- Masukan pilihan jenis mobil. -->
				<div class="col-lg-2"><label for="tipe">Jenis Mobil:</label></div>
				<div class="col-lg-2">
					<select id="mobil" name="mobil">
					<option value="">- Jenis mobil -</option>
				        <?php foreach ($daftarMobil as $mobil) { ?>
				            <option value="<?php echo $mobil; ?>"><?php echo $mobil; ?></option>
				        <?php } ?>
					</select>
				</div>
			</div>
			
			<div class="row">
				<!-- Masukan data Jarak Tempuh. Tipe data number. -->
				<div class="col-lg-2"><label for="nomor">Jarak:</label></div>
				<div class="col-lg-2"><input type="number" id="jumlahPesanan" name="jarak" maxlength="4"></div>
			</div>
			<div class="row">
				<!-- Tombol Submit -->
				<div class="col-lg-2"><button class="btn btn-primary" type="submit" form="formPemesanan" value="Pesan" name="Pesan">Pesan</button></div>
				<div class="col-lg-2"></div>		
			</div>
		</form>
	</div>
	<?php
		if(isset($_POST['Pesan'])) {
		    $nama = $_POST['nama'];
		    $nohp = $_POST['noHP'];
		    $mobil = $_POST['mobil'];
		    $jarak = $_POST['jarak'];
		    $total_tagihan = total_tagihan($jarak);

		    $data_input = [$nama, $nohp, $mobil, $jarak, $total_tagihan];

		    array_push($dataMobilAll, $data_input);

		    $dataJsonBaru = json_encode($dataMobilAll);

		    file_put_contents($berkas, $dataJsonBaru);

		     echo "<div class='container'>";
        echo "<div class='alert alert-success' role='alert'>";
        echo "Data Berhasil Disimpan";
        echo "</div>";
        echo "</div>";
			echo "
				<br/>
				<div class='container'>
					
					<div class='row'>
						<!-- Menampilkan nama pelanggan. -->
						<div class='col-lg-2'>Nama Pelanggan:</div>
						<div class='col-lg-2'>".$nama."</div>
					</div>
					<div class='row'>
						<!-- Menampilkan nomor HP pelanggan. -->
						<div class='col-lg-2'>Nomor HP:</div>
						<div class='col-lg-2'>".$nohp."</div>
					</div>
					<div class='row'>
						<!-- Menampilkan Jenis mobil Taxi Online. -->
						<div class='col-lg-2'>Jenis Mobil:</div>
						<div class='col-lg-2'>".$mobil."</div>
					</div>
					<div class='row'>
						<!-- Menampilkan jumlah Jarak Tempuh. -->
						<div class='col-lg-2'>Jarak(km):</div>
						<div class='col-lg-2'>".$jarak." km</div>
					</div>
					<div class='row'>
						<!-- Menampilkan Total Tagihan. -->
						<div class='col-lg-2'>Total:</div>
						<div class='col-lg-2'>Rp".number_format($total_tagihan, 0, ".", ".").",-</div>
					</div>
					
			</div>
			";
		}
	?>
	</body>
</html>