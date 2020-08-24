<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="oop-gaji-selected.php" method="POST">
		<select name="nama">
			<option value="0">pilih</option>
			<option value="1">ahmad</option>
			<option value="2">burhan</option>
			<option value="3">ceci</option>
			<option value="4">doi</option>
			<option value="5">tambah lagi</option>
		</select>
		<input type="submit" name="hitung" value="hitung">
	</form>


<?php
	class Potongan{
		public function hitungPotongan($gol,$gj){
			return self::hitungPajak($gol,$gj) + self::hitungAsuransi($gj);
		}
		
		private static function hitungPajak($gol,$gj){
			switch($gol)
			{
				case 1 : return 0.4* $gj;break;
				case 2 : return 0.3* $gj;break;
				case 3 : return 0.2* $gj;break;
				case 4 : return 0.1* $gj;break;
				default : return 0;break;
			}
		}
		
		private static function hitungAsuransi($gj){
			return 0.2* $gj;
		}
		
		
	}
	
	class Tunjangan{

		public function hitungTunjangan($gol,$gj){
			return self::tunjanganJabatan($gol,$gj) + self::tunjanganTransport();
		}
		
		private static function tunjanganJabatan($gol,$gj){
			switch($gol)
			{
				case 1 : return 0.10 * $gj;break;
				case 2 : return 0.8 * $gj;break;
				case 3 : return 0.5 * $gj;break;
				case 4 : return 0.3 * $gj;break;
				default : return 0;break;
			}
		}

		public function tunjanganTransport(){
			return 500000;
		}
	}

	class TotalGaji{
		private $potongan;
		private $tunjangan;
		private $gol;

		function __construct($gol){
			$this->potongan = new Potongan;
			$this->tunjangan = new Tunjangan;
			$this->gol = $gol;
		}

		public function hitungGaji(){
			return (self::getGajiPokok($this->gol) + self::getTunjangan($this->gol)) - self::getPotongan($this->gol);
		}

		private static function gajiPokok($gol){
			switch ($gol) {
				case 1: return 10000000; 
					break;

				case 2: return 5000000; 
					break;

				case 3: return 1500000; 
					break;

				case 4: return 1000000; 
					break;	
				
				default: return 0;  
					break;
			}
		}

		public function getGajiPokok($gol){
			return $this->gajiPokok($gol);
		}

		public function getTunjangan($gol){
			return $this->tunjangan->hitungTunjangan($gol,$this->gajiPokok($gol));
		}

		public function getPotongan($gol){
			return $this->potongan->hitungPotongan($gol,$this->gajiPokok($gol));
		}
	}

	class Pegawai{
		private $nama; 
		private $gol;
		private $totalgaji;

		function __construct($nama,$gol){
			$this->nama = $nama;
			$this->gol = $gol;
			$this->totalgaji = new TotalGaji($gol);  
		}

		public function namaPegawai($nama)
		{
			switch ($nama) {
				case 1 : return 'Ahmad';
					# c
					break;
				case 2 : return 'Burhan';
					break;
				case 3 : return 'Ceci';
					break;
				case 4 : return 'Doi';
					break;
				default: return 0;
					# code...
					break;
			}
		}

		public function namaGolongan($gol)
		{
			switch ($gol) {
				case 1: return 'A';
					break;
				case 2: return 'B';
					break;
				case 3: return 'C';
					break;
				case 4: return 'D';
					break;
				default:0;
					
					break;
			}
		}

		public function cetakDataPegawai(){
			
			echo "Nama ".$this->namaPegawai($this->nama)."<br/>";
			echo "Golongan ".$this->namaGolongan($this->gol)."<br/>";
			echo "Gaji Pokok ".number_format($this->totalgaji->getGajiPokok($this->gol))."<br/>";
			echo "Tunjangan ".number_format($this->totalgaji->getTunjangan($this->gol))."<br/>";
			echo "Potongan ".number_format($this->totalgaji->getPotongan($this->gol))."<br/>";
			echo "Total Gaji ".number_format($this->totalgaji->hitungGaji())."<br/>"."<br/>";
		}
	}

	$pegawai1 = new Pegawai(1,1);
	$pegawai2 = new Pegawai(2,2);
	$pegawai3 = new Pegawai(3,3);
	$pegawai4 = new Pegawai(4,4);

	$gol = '';
	if (isset($_POST['nama'])) {
		$gol = $_POST['nama'];
	}

	if ($gol == 1) {
		$pegawai1->cetakDataPegawai();
		# code...
	}elseif ($gol == 2) {
		# code...
		$pegawai2->cetakDataPegawai();
	}elseif ($gol == 3) {
		$pegawai3->cetakDataPegawai();
		# code...
	} elseif ($gol == 4) {
		$pegawai4->cetakDataPegawai();
		# code...
	} else{
		echo "kosong";
	}

?>

</body>
</html>