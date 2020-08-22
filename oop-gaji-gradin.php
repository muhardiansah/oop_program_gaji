<?php 
	/**
	 * 
	 */
	class Gaji
	{
		
		public function hitungGajiPokok($id)
		{
			return self::gajiPokok($id);
		}
		private static function gajiPokok($id)
		{
			switch ($id) 
			{
				case 1 : return 8000000;
						break;
				case 2 :return 5000000;
						break;
				case 3 :return 11000000;
						break;
				case 4 :return 10000000;
						break;
				case 5 :return 2000000;
						break;
				default;0;
						break;
			}
		}
		
	}
	
	class Tambahan
	{
	
		public function hitungTambahan($id,$gj)
		{
			return $this->getTambahan($id,$gj);
		}

		private static function getTambahan($id,$gj)
		{
			switch ($id) {
				case 1: return $gj  * 0.1;
						break;
				case 2: return $gj  * 0.2;
						break;
				case 3: return $gj  * 0.1;
						break;
				case 4: return $gj  * 0.1;
						break;
				case 5: return $gj  * 0.4;
						break;
				
				default: return 0;
						break;
			}
		}
	}

	class BonusLevel
	{
		
		public function hitungBonusLevel($id)
		{
			return self::getBonusLevel($id);
		}

		private static function getBonusLevel($id)
		{
			switch ($id) {
				case 1: return 200000;
						break;
				case 2: return 500000;
						break;
				case 3: return 200000;
						break;
				case 4: return 1000000;
						break;
				case 5: return 500000;
						break;
				
				default:0;
						break;
			}
		}
	}

	/**
	 * 
	 */
	class Potongan
	{	
		protected $gaji;
		protected $tambahan;
		protected $bonuslevel;
		protected $id;

		function __construct($id)
		{
			$this->gaji = new Gaji;
			$this->tambahan = new Tambahan;
			$this->bonuslevel = new BonusLevel;
			$this->id = $id;
		}

		public function hitungPotongan()
		{
			return (self::getGajiPokok($this->id) + self::getTambahan($this->id) + 
				self::getBonusLevel($this->id)) * self::jumlahPotongan($this->id);
		}

		private static function jumlahPotongan($id)
		{
			switch ($id) {
				case 1: return 0.02;
						break;
				case 2: return 0.025;
						break;
				case 3: return 0.02;
						break;
				case 4: return 0.03;
						break;
				case 5: return 0.025;
						break;
				default:0;
						break;
			}
			# code...
		}
		public function getGajiPokok($id)
		{
			return $this->gaji->hitungGajiPokok($id);
		}
		public function getTambahan($id)
		{
			return $this->tambahan->hitungTambahan($id, $this->gaji->hitungGajiPokok($id));
		}
		public function getBonusLevel($id)
		{
			return $this->bonuslevel->hitungBonusLevel($id);
		}

	}

	class Pegawai
	{
		
		public function namaPegawai($id)
		{
			switch ($id) {
				case 1: return 'Anto';
						break;
				case 2: return 'Andi';
						break;
				case 3: return 'Budi';
						break;
				case 4: return 'Nita';
						break;
				case 5: return 'Bagus';
						break;
				
				default:0;
						break;
			}
		}
	}

	class TotalGaji extends Potongan
	{
		private $potongan;
		private $pegawai;
		
		function __construct($id)
		{
			$this->id = $id;
			$this->gaji = new Gaji;
			$this->tambahan = new Tambahan;
			$this->bonuslevel = new BonusLevel;
			$this->potongan = new Potongan($id);
			$this->pegawai = new Pegawai;
		}
		public function hitungTotalGaji()
		{
			return (self::getGajiPokok($this->id) + self::getTambahan($this->id) + self::getBonusLevel($this->id)) - self::getPotongan($this->id);
		}
		public function getPotongan($id)
		{
			return $this->potongan->hitungPotongan($id);
		}
		public function getNama($id)
		{
			return $this->pegawai->namaPegawai($id);
		}
		public function getNo($id)
		{
			return $this->pegawai->noPegawai($id);
		}
		public function cetakData()
		{
			echo $this->getNama($this->id)." : ";
			echo number_format($this->hitungTotalGaji())."<br/><br/>";
		}
	}
	
	for ($j=1; $j <= 5; $j++) { 
		$pegawai[$j] = new TotalGaji($j);
	}
	for ($i=1; $i <= 5 ; $i++){
		$pegawai[$i]->cetakData();
	}

 ?>