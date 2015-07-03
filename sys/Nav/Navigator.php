<?php

session_start();

class Navigator
{
	public static $urlSys;

	public function __construct() { }

	public static function goPage($mod)
	{
		$url = self::getPage($mod);
		echo "<script>window.location.href=\"$url\"</script>";
	}

	public static function goPageError($error)
	{
		$url = self::getPage('error');
		header("Location: $url?error=" . $error);
	}

	public static function goPageMessage($msg)
	{
		$url = self::getPage('aviso');
		header("Location: $url?msg=" . $msg);
	}

	public static function Redirect($url)
	{
		echo "<script>window.location.href=\"$url\"</script>";
	}

	private function getPage($mod)
	{
		self::$urlSys = $_SESSION['URL_SYS'];
					
	    $url = '';
		
		switch ($mod)
		{			
			case 'logou' :
				
				  $url .= self::$urlSys['ADMIN_URL']."painel_admin.php";
						
			break;
				
			case 'naoLogou':
			
				$url .= self::$urlSys['ADMIN_URL']."index.php";
				break;
				
			case 'error_auth':
			
				$url .= self::$urlSys['ADMIN_URL'].'index.php';
				break;
                        
            case 'categoria':
			
				$url .= self::$urlSys['CATEGORIA_URL'].'categoria.php';
				break;

            case 'erro_categoria':
			
				$url .= self::$urlSys['CATEGORIA_URL'].'categoria.php?erro';
				break;
			
			case 'evento':
			
				$url .= self::$urlSys['EVENTO_URL'].'evento.php';
				break;
            
			case 'erro_evento':
				$url .= self::$urlSys['EVENTO_URL'].'evento.php?erro';
				break;
				
			case 'pontoTuristico':
			
				$url .= self::$urlSys['PONTOTURISTICO_URL'].'pontoTuristico.php';
				break;
										
			case 'erro_pontoTuristico':
			
				$url .= self::$urlSys['PONTOTURISTICO_URL'].'pontoTuristico.php?erro';
				break;	

            case 'patrocinio':
			
				$url .= self::$urlSys['PATROCINIO_URL'].'patrocinio.php';
				break;
				
			case 'erro_patrocinio':
			
				$url .= self::$urlSys['PATROCINIO_URL'].'patrocinio.php?erro';
				break;							
 
            case 'mapa':
			
				$url .= self::$urlSys['MAPA_URL'].'mapa.php';
				break;
				
			case 'erro_mapa':
			
				$url .= self::$urlSys['MAPA_URL'].'mapa.php?erro';
				break;
			
			case 'galeria':
			
				$url .= self::$urlSys['GALERIA_URL'].'galeriaFotos.php';
				break;
				
			case 'erro_galeria':
			
				$url .= self::$urlSys['GALERIA_URL'].'galeriaFotos.php?erro';
				break;	
								
			default:
			
				$url .= self::$urlSys['BASE_URL'].'index.php';			
				break;
		}
		
		return $url;
	}

}

?>
