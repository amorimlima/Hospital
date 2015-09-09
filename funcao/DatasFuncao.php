<?php
class DatasFuncao {

	public static function dataTimeUSA($dataBr) {
		$dataUSA = '0000-00-00';
		$tamanho = strlen($dataBr);
		if ($tamanho < 19) {
			$data = explode("/", $dataBr);
			$dataUSA = $data[2] . "-" . $data[1] . "-" . $data[0];
		}
		else {
			$tipo = explode(" ", $dataBr);
			$data = explode("/", $tipo[0]);
			$dataUSA = $data[2] . "-" . $data[1] . "-" . $data[0] . " " . $tipo[1];
		}
		return $dataUSA;
	}
	
	public static function dataUSA($dataBr) {
		$dataUSA = '0000-00-00';
		$tamanho = strlen($dataBr);
		if ($tamanho < 19) {
			$data = explode("/", $dataBr);
			$dataUSA = $data[2] . "-" . $data[1] . "-" . $data[0];
		}
		else {
			$tipo = explode(" ", $dataBr);
			$data = explode("/", $tipo[0]);
			$dataUSA = $data[2] . "-" . $data[1] . "-" . $data[0];
		}
		return $dataUSA;
	}

	public static function dataTimeBR($dataUsa) {
		$dataBR = '00/00/0000';
		$tamanho = strlen($dataUsa);
		if ($tamanho < 19) {
			$data = explode("-", $dataUsa);
			$dataBR = $data[2] . "/" . $data[1] . "/" . $data[0];
		}
		else {
			$tipo = explode(" ", $dataUsa);
			$data = explode("-", $tipo[0]);
			$dataBR = $data[2] . "/" . $data[1] . "/" . $data[0] . " " . $tipo[1];
		}
		return $dataBR;
	}
	
	public static function dataBR($dataUsa) {
		$dataBR = '00/00/0000';
		$tamanho = strlen($dataUsa);
		if ($tamanho < 19) {
			$data = explode("-", $dataUsa);
			$dataBR = $data[2] . "/" . $data[1] . "/" . $data[0];
		}
		else {
			$tipo = explode(" ", $dataUsa);
			$data = explode("-", $tipo[0]);
			$dataBR = $data[2] . "/" . $data[1] . "/" . $data[0];
		}
		return $dataBR;
	}
	
	
	public static function dataTimeBRExibicao($dataUsa) {
		$dataBR = '00/00/0000';
		$tamanho = strlen($dataUsa);
		if ($tamanho < 19) {
			$data = explode("-", $dataUsa);
			$dataBR = $data[2] . "/" . $data[1] . "/" . $data[0];
		}
		else {
			$tipo = explode(" ", $dataUsa);
			$data = explode("-", $tipo[0]);
			$dataBR = $data[2] . "/" . $data[1] . "/" . $data[0] . " às " . $tipo[1];
		}
		return $dataBR;
	}


}
