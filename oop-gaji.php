<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="oop-gaji.php" method="POST">
		<select name="">
			<option value="0">pilih</option>
			<option value="1">ahmad</option>
			<option value="2">burhan</option>
			<option value="3">ceci</option>
			<option value="4">doi</option>
		</select>
		<input type="submit" name="hitung" value="hitung">
	</form>


<?php
	class Potongan{
		public function hitungPotongan($gol,$gj){
			return self::hitungPajak($gol,$gj) + self::hitungAsuransi($gj);
		}
		
		private static function hitungPajak($gol,$gj){
			switch(strtoupper($gol))
			{
				case "A" : return 0.4* $gj;break;
				case "B" : return 0.3* $gj;break;
				case "C" : return 0.2* $gj;break;
				case "D" : return 0.1* $gj;break;
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
			switch(strtoupper($gol))
			{
				case "A" : return 0.10 * $gj;break;
				case "B" : return 0.8 * $gj;break;
				case "C" : return 0.5 * $gj;break;
				case "D" : return 0.3 * $gj;break;
				default : return 0;break;
			}
		}

		private static function tunjanganTransport(){
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
			switch (strtoupper($gol)) {
				case 'A': return 10000000; 
					break;

				case 'B': return 5000000; 
					break;

				case 'C': return 1500000; 
					break;

				case 'D': return 1000000; 
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

		public function cetakDataPegawai(){
			
			// echo "Nama ".$this->nama."<br/>";
			// echo "Golongan ".$this->gol."<br/>";
			echo "Gaji Pokok Rp : ".number_format($this->totalgaji->getGajiPokok($this->gol))."<br/>";
			echo "Tunjangan Rp : ".number_format($this->totalgaji->getTunjangan($this->gol))."<br/>";
			echo "Potongan Rp : ".number_format($this->totalgaji->getPotongan($this->gol))."<br/>";
			echo "Total Gaji Rp : ".number_format($this->totalgaji->hitungGaji())."<br/>"."<br/>";
		}
	}

	$pegawai1 = new Pegawai('as','a');
	// $pegawai2 = new Pegawai("Burhan","B");
	// $pegawai3 = new Pegawai("Ceci","C");
	// $pegawai4 = new Pegawai("Doi","D");

	$pegawai1->cetakDataPegawai();
?>

</body>
</html>