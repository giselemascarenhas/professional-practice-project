<?php
error_reporting(E_ALL); // - Error Reporting
ini_set('display_errors', 1); // - Display Errors
ini_set('html_errors', 1);
ini_set('session.gc_maxlifetime', 32400); // server should keep session data for AT LEAST 1 hour = 3600
session_set_cookie_params(32400); // each client should remember their session id for EXACTLY 1 hour

$pagetitle			= 'SchoolFreq | 5x5';
$email_from			= 'info@grupo5x5.cloud';
$production			= 1;
$manut 				= 0;
$version			='0.5';

//define horário correto a ser utilizado e Locale
header('Content-type: text/html; charset=utf-8');
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");

session_start();
date_default_timezone_set('America/Sao_Paulo');

spl_autoload_register( function ($className) {
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
	echo "filename: " . $fileName;
    require $fileName;
});

class Template {
    protected $file;
    protected $values = array();

    public function __construct($file) {
        $this->file = $file;
    }

	public function set($key, $value) {
	    $this->values[$key] = $value;
	}

	public function get($key) {
	    if ( isset( $this->values[$key] ) ) return $this->values[$key];
	}

	public function output() {
	    if (!file_exists($this->file)) {
	        return "Error loading template file ($this->file).";
	    }
	    $output = file_get_contents($this->file);
	    foreach ($this->values as $key => $value) {
	        $tagToReplace = "[@$key]";
	        $output = str_replace($tagToReplace, $value, $output);
	    }
	    return $output;
	}
}

class TemplateString {
    protected $file;
    protected $values = array();

    public function __construct($file) {
        $this->file = $file;
    }

	public function set($key, $value) {
	    $this->values[$key] = $value;
	}

	public function get($key) {
	    if ( isset( $this->values[$key] ) ) return $this->values[$key];
	}

	public function output() {
	    $output = $this->file;
	    foreach ($this->values as $key => $value) {
	        $tagToReplace = "{{{$key}}}";
	        $output = str_replace($tagToReplace, $value, $output);
	    }
	    return $output;
	}
}

// - Shutdown Handler
function ShutdownHandler() {
    if(@is_array($error = @error_get_last())) { return(@call_user_func_array('ErrorHandler', $error)); }; return(TRUE);
}; register_shutdown_function('ShutdownHandler');

// - Error Handler
function ErrorHandler($type, $message, $file, $line) {
    $_ERRORS = Array(
		0x0001 => 'E_ERROR', 			0x0002 => 'E_WARNING', 			0x0004 => 'E_PARSE', 		0x0008 => 'E_NOTICE', 			0x0010 => 'E_CORE_ERROR', 	0x0020 => 'E_CORE_WARNING',
		0x0040 => 'E_COMPILE_ERROR',	0x0080 => 'E_COMPILE_WARNING',	0x0100 => 'E_USER_ERROR',	0x0200 => 'E_USER_WARNING',		0x0400 => 'E_USER_NOTICE',	0x0800 => 'E_STRICT',
		0x1000 => 'E_RECOVERABLE_ERROR',0x2000 => 'E_DEPRECATED',		0x4000 => 'E_USER_DEPRECATED'
	);
    if(!@is_string($name = @array_search($type, @array_flip($_ERRORS)))) { $name = 'E_UNKNOWN'; };
    return(print(@sprintf("%s Error in file \xBB%s\xAB at line %d: %s\n", $name, @basename($file), $line, $message)));
}; $old_error_handler = set_error_handler("ErrorHandler");

//dados de acesso - banco de dados
$db = $msdb = array();
$server = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';

if ( $server == 'localhost' ) { 
	$db['host'] 	= "localhost";
	$db['name'] 	= "adm_pentagono";
	$db['user'] 	= "root";
	$db['pass'] 	= "rootroot";
	$base_url		= 'http://localhost/5x5';
	$production		= 0;
} else {
	$db['host'] 	= "localhost";
	$db['name'] 	= "u167225891_5x5";
	$db['user'] 	= "u167225891_mackenzie";
	$db['pass'] 	= "sOyW=^P0u|";
	
	$base_url	= 'https://grupo5x5.cloud';
}

try {
	$conexao  = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);
	$conexao->set_charset("utf8");
}
catch (Exception $e) {
	$manut = 1;
	$errorMessage = $e->getMessage();
}
$arr_meses = ['janeiro','fevereiro','março','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro'];

if ($conexao->connect_error) { 
	//trigger_error('Falha na Conexão: '  . $conexao->connect_error, E_USER_ERROR); 
	$manut = 1;
    $errorMessage = $conexao->connect_error;
}

//obtém oneSignal IDs do administrador para cópia das notificações
//$additionalIds = $conexao->query("SELECT st_onesignal FROM sys_usuarios WHERE id_usuario = 1")->fetch_object()->st_onesignal;

function anti_injection($sql) {
	$str = "/([Ff][Rr][Oo][Mm]|[Ss][Ee][Ll][Ee][Cc][Tt]|[Ii][Nn][Ss][Ee][Rr][Tt]|[Dd][Ee][Ll][Ee][Tt][Ee]|[Ww][Hh][Ee][Rr][Ee]|[Dd][Rr][Oo][Pp]\[Ss]*[Tt][Aa][Bb][Ll][Ee]|[Ss][Hh][Oo][Ww] [Tt][Aa][Bb][Ll][Ee][Ss]|--|undefined|\\\\)/";
	$sql = preg_replace( $str , "" , $sql );
	if ( is_array($sql) ) $sql = implode(",",$sql);
	//$sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql);
	return $sql;
}

function array2csv(array &$array) {
   if (count($array) == 0) { return null; }
   ob_start();
   $df = fopen("php://output", 'w');
   //fputcsv($df, array_keys(reset($array)));
   foreach ($array as $row) { fputcsv($df, $row); }
   fclose($df);
   return ob_get_clean();
}

function check_date($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download
    header("Content-Type: application/force-download; charset=utf-8");
    header("Content-Type: application/octet-stream; charset=utf-8");
    header("Content-Type: application/download; charset=utf-8");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}

function dynamicColors() {
	$r = floor( random() * 255 );
	$g = floor( random() * 255 );
	$b = floor( random() * 255 );
	return "rgb(" . $r . "," . $g . "," . $b . ")";
}

function ellipsis( $in , $length ) {
	$out = strlen($in) > $length ? mb_substr($in,0,$length)."..." : $in;
	return $out;
}

function fillString($input, $length, $pad, $align) {
	switch ($align) {
		case "left"   : $salign = STR_PAD_LEFT; break;
		case "center" : $salign = STR_PAD_BOTH; break;
		default		  : $salign = "";
	}
	return str_pad ( $input , $length , $pad , $salign );
}

function formata_data($date,$type='',$size='') {
	if ($date != '0000-00-00' && $date != '1969-12-31' && $date != '') {
		$date = substr($date,0,19);
		//return date_format( date_create_from_format('Y-m-d H:i:s', $date ) , 'd/m/Y H:i:s' );
		$date = strtotime( str_replace('/','-',$date) );
		switch($size) {
			case 'shorter':
			switch($type) {
				case "mysql": return date( 'm-d' , $date ); break;
				case "usa"	: return date( 'm/d' , $date ); break;
				default		: return date( 'd/m' , $date ); break;
			}
			break;
			
			case 'short':
			switch($type) {
				case "mysql": return date( 'Y-m-d' , $date ); break;
				case "usa"	: return date( 'm/d/Y' , $date ); break;
				default		: return date( 'd/m/Y' , $date ); break;
			}
			break;

			case 'shortYear':
			switch($type) {
				case "mysql": return date( 'y-m-d' , $date ); break;
				case "usa"	: return date( 'm/d/y' , $date ); break;
				default		: return date( 'd/m/y' , $date ); break;
			}
			break;
			
			case 'shortTime':
			switch($type) {
				case "mysql": return date( 'Y-m-d H:i' , $date ); break;
				case "usa"	: return date( 'm/d/Y H:i' , $date ); break;
				default		: return date( 'd/m/Y H:i' , $date ); break;
			}
			break;
			
			default:
			switch($type) {
				case "mysql": return date( 'Y-m-d H:i:s' , $date ); break;
				case "usa"	: return date( 'm/d/Y H:i:s' , $date ); break;
				default		: return date( 'd/m/Y H:i:s' , $date ); break;
			}
			break;
		}
	} else { return 'N/A'; }
}

function formata_idade( $bdayDate ) {
	if ( isDate($bdayDate) ) {
		$date = new DateTime($bdayDate);
		$now = new DateTime();
		$interval = $now->diff($date);
		return $interval->y . 'a ' . $interval->m . 'm ' . $interval->d . 'd';
	} else {
		return false;
	}
}

function formata_numero($float, $casas = 2,$padrao = 'br') {
	if ( strpos($float,",") ) {
		$float = str_replace( ['.',' '] , '' , $float);
		$float = str_replace(',', '.', $float);
	}
	switch($padrao){
		case 'br': return number_format( $float, $casas, ',', '' ); break;
		default:   return number_format( $float, $casas, '.', '' ); break;
	}
}

function getFirstLastDateOfWeek($year, $month, $week) {

    $thisWeek = 1;

    for($i = 1; $i < $week; $i++) { $thisWeek = $thisWeek + 7; }

    $currentDay = date('Y-m-d',mktime(0,0,0,$month,$thisWeek,$year));

    $monday = strtotime('monday this week', strtotime($currentDay));
    $sunday = strtotime('sunday this week', strtotime($currentDay));

    $weekStart = date('d M y', $monday);
    $weekEnd = date('d M y', $sunday);

    return $weekStart . ' - ' . $weekEnd;
}

function getIP($ip = null, $deep_detect = TRUE){
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
        	if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        		if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
        	if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        	    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) $ip = $_SERVER['HTTP_CLIENT_IP'];
			}
        }
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    return $ip;
}

function getWeekRange($date) {
    $ts = strtotime($date);
    $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
    return array(date('Y-m-d', $start), date('Y-m-d', strtotime('next saturday', $start)));
}

function getWorkdays($date1, $date2, $ibge_cidade, $conexao, $workSat = FALSE, $patron = NULL) {
	if (!defined('SATURDAY')) define('SATURDAY', 6);
	if (!defined('SUNDAY')) define('SUNDAY', 0);

	// Array of all public festivities
	$publicHolidays = array();
	if ($ibge_cidade) {
		$sql = "SELECT dt_feriado FROM sys_feriados WHERE id_cidade_ibge = $ibge_cidade AND dt_feriado BETWEEN now() AND DATE_ADD( now() , INTERVAL 1 YEAR);";
		$fRS = $conexao->query($sql);
		while ( $row = $fRS->fetch_assoc() ) { $publicHolidays[] = formata_data($row["dt_feriado"],'mysql','shorter'); }
	}
	
	if ($patron) { $publicHolidays[] = $patron; } // The Patron day (if any) is added to public festivities
		
	/* Array of all Easter Mondays in the given interval */
	$yearStart = date('Y', strtotime($date1));
	$yearEnd   = date('Y', strtotime($date2));
	for ($i = $yearStart; $i <= $yearEnd; $i++) {
		$easter = date('Y-m-d', easter_date($i));
		list($y, $m, $g) = explode("-", $easter);
		$monday = mktime(0,0,0, date($m), date($g)+1, date($y));
		$easterMondays[] = $monday;
	}
	$start = strtotime($date1);
	$end   = strtotime($date2);
	$workdays = 0;
	for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
		$day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
		$mmgg = date('m-d', $i);
		if ($day != SUNDAY && 
			!in_array($mmgg, $publicHolidays) && 
			!in_array($i, $easterMondays) && 
			!($day == SATURDAY && $workSat == FALSE)) { $workdays++; }
	}
	return intval($workdays);
}

function humanDateRanges($start, $end){
	$startTime	= is_object($start)	? $start->getTimestamp()	: strtotime($start);
    $endTime	= is_object($end)	? $end->getTimestamp()		: strtotime($end);

    if( date('Y',$startTime) != date('Y',$endTime) ){
        return strftime('%d de %B de %Y',$startTime) . " a " . strftime('%d de %B de %Y',$endTime);
    }else{
        if((date('j',$startTime)==1)&&(date('j',$endTime)==date('t',$endTime))){
            return strftime('%B',$startTime) . " a " . strftime('%B de %Y',$endTime);
        }else{
            if(date('m',$startTime)!=date('m',$endTime)){
                return strftime('%d de %B',$startTime) . " a " . strftime('%d de %B de %Y',$endTime);
            }else{
                return strftime('%d',$startTime) . " a " . strftime('%d de %B de %Y',$endTime);
            }
        }
    }
}

function importHolidays($ibge_cidade,$ano,$conexao) {
	$token = 'ZGFucmVndWxhcmlzQGdtYWlsLmNvbSZoYXNoPTUxNjY3MDg2';
	$url = "https://api.calendario.com.br/?ano=$ano&ibge=$ibge_cidade&token=$token";
	$xml = simplexml_load_file($url);
	if (!empty($xml)) {
		foreach ($xml->event as $event) {
			$data = formata_data($event->date,'mysql','short');
			$sql = "INSERT INTO sys_feriados (id_cidade_ibge, dt_feriado, st_feriado, st_descricao, id_tipo_feriado, st_tipo_feriado) 
						SELECT '" . $ibge_cidade . "','" . $data . "','" . $event->name . "','" . $event->description . "','" . $event->type_code . "','" . $event->type . "'
						WHERE NOT EXISTS (SELECT * FROM sys_feriados WHERE id_cidade_ibge = '$ibge_cidade' AND dt_feriado = '" . $data . "' LIMIT 1)";
			$conexao->query($sql);
		}
		return 1;
	} else {
		return 0;
	}
}

function isDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
	/*
    if (!$value) return false;
    try {
        new \DateTime($value);
        return true;
    } catch (\Exception $e) {
        return false;
    }*/
}

function MsDateToMysqlDate($date) {
	return date_create_from_format( 'Y-m-d H:i:s', $date );
}

function querystringAddVar($url, $key, $value) {
	
	$url = preg_replace('/(.*)(?|&)'. $key .'=[^&]+?(&)(.*)/i', '$1$2$4', $url .'&');
	$url = substr($url, 0, -1);
	
	if (strpos($url, '?') === false) {
		return ($url .'?'. $key .'='. $value);
	} else {
		return ($url .'&'. $key .'='. $value);
	}
}

function querystringRemoveVar($url, $key) {
	$url = preg_replace('/(.*)(?|&)'. $key .'=[^&]+?(&)(.*)/i', '$1$2$4', $url .'&');
	$url = substr($url, 0, -1);
	return ($url);
}
function random(){
    return mt_rand() / (mt_getrandmax() + 1);
}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function replace_special($string) {
    $string2 = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç|Ç)/"),explode(" ","a A e E i I o O u U n N c"),$string);
    return $string2;
}

function remove_punctuation($string) {
    $string2 = str_replace(array('.','-','/','(',')',' ',"'"),"",$string);
    return $string2;
}

function searchFileText($file,$searchfor) {
	//header('Content-Type: text/plain'); // the following line prevents the browser from parsing this as HTML.
	$contents = file_get_contents($file); // get the file contents, assuming the file to be readable (and exist)
	$pattern = preg_quote($searchfor, '/'); // escape special characters in the query
	$pattern = "/^.*$pattern.*\$/m"; // finalise the regular expression, matching the whole line
	if(preg_match_all($pattern, $contents, $matches)){
		// search, and store all matching occurences in $matches
		return true; // "Found matches:\n" . implode("\n", $matches[0]) . "<br>";
	}
	else{
		return false; //"No matches found<br>";
	}
}

function setXmlExt($file){
	$ext = pathinfo($file, PATHINFO_EXTENSION);
	if (!$ext || $ext != "xml") { 
		rename($file,$file.'.xml');
	}
}

function switch_segmento($segm) {
	switch($segm) {
		case 'EI' : case 'EI_B'	: 				return 'Infantil'		; break;
		case 'EF1': case 'EF1_B': case 'EFAI':	return 'Anos Iniciais'	; break;
		case 'EF2': case 'EFAF' : 				return 'Anos Finais'	; break;
		case 'EM' : 			  				return 'Médio'			; break;
		case 'I'  : 			  				return "Depto. Int'l"	; break;
		case 'NO'  : 			  				return "Não se Aplica"	; break;
		default	  : return $segm; 										  break;
	}
}
function switch_serie($segm,$ano) {
	switch($segm) {
		case 'EI' : case 'EI_B'	: 
			if ( $ano != '0' && $ano != 'NO' ) {
				return 'G'.$ano;
			} else if ($ano == '0') {
				return 'Todas as Séries';
			} else if ($ano == 'NO') {
				return 'N/A';
			}
		break;
		case 'EF1': case 'EF1_B': case 'EF2': case 'EFAI' : case 'EFAF': case 'I':
			if ( $ano != '0' && $ano != 'NO' ) {
				return $ano.'° Ano';
			} else if ($ano == '0') {
				return 'Todas as Séries';
			} else if ($ano == 'NO') {
				return 'N/A';
			}
		break;
		case 'EM' : return $ano.'ª Série'	; break;
		default	  : if ($ano) return $ano; break;
	}
}

function switch_sexo($sex) {
	switch($sex){
		case 'M': return "Masculino"; break;
		case 'F': return "Feminino" ; break;
	}
}

function switch_turno($turno) {
	switch($turno) {
		case 'M' : return 'MANHA'		; break;
		case 'T' : return 'TARDE'		; break;
		case 'I' : return 'INTEGRAL'	; break;
	}
}

function switch_unidade($opt) {
	switch($opt) {
		case 8 : return 'Alphaville'			; break;
		case 1 : return 'Bartira'				; break;
		case 7 : return 'Caiubi'				; break;
		case 4 : return 'Morumbi'				; break;
	}
}

function tdrows($elements) {
	$tempArr = array();
	foreach ($elements as $key => $element) {
		$tempArr[] = trim($element->nodeValue);
	}
	return $tempArr;
}


function unzip($file) {
	$path = pathinfo(realpath($file), PATHINFO_DIRNAME);
	$zip = new ZipArchive;
	$res = $zip->open($file);
	if ($res === TRUE) {
		$zip->extractTo($path); // extract it to the path we determined above
		$zip->close();
		unlink($file);
		return "Arquivo '$file' descompactado com sucesso!";
	} else {
		return "Não foi possível descompactar o arquivo '$file'";
	}
}

/**
 * Get number of weeks starting *Monday*, occuring in a given month.
 * A week occurs in a month if any day from that week falls in the month.
 * @param $month_date is expected to be DateTime.
 * @param $count_last count partial week at the end of month as part of month.
 */
function weeks_in_month($month_date, $count_last=true) {
  $fn = $count_last ? 'ceil' : 'floor';
  $start = new DateTime($month_date->format('Y-m'));
  echo "w_i_m - start: " . $start->format('Y-m') . "<br>";
  $days = (clone $start)->add(new DateInterval('P1M'))->diff($start)->days;
  echo "w_i_m - days: $days<br>";
  $offset = $month_date->format('N') - 1;
  echo "w_i_m - offset: $offset<br>";
  return $fn(($days + $offset)/7);
}

/**
 * Wrapper over weeks_in_month() to get weeks in month for each month of a given year.
 * @param $year_date is expected to be a DateTime.
 */
function year_month_weeks($year_date, $count_last=true) {
  $start = new DateTime($year_date->format('Y') . '-01');
  $year_month_weeks = [];
  foreach(new DatePeriod($start, new DateInterval('P1M'), 11) as $month) {
    $year_month_weeks[] += weeks_in_month($month, $count_last);
  }
  return $year_month_weeks;
}

$uf = [
		["sigla"=>"AC" , "nome"=>"Acre"					],		["sigla"=>"AL" , "nome"=>"Alagoas"				],
		["sigla"=>"AM" , "nome"=>"Amazonas"				],		["sigla"=>"AP" , "nome"=>"Amapá"				],
		["sigla"=>"BA" , "nome"=>"Bahia"				],		["sigla"=>"CE" , "nome"=>"Ceará"				],
		["sigla"=>"DF" , "nome"=>"Distrito Federal"		],		["sigla"=>"ES" , "nome"=>"Espírito Santo"		],
		["sigla"=>"GO" , "nome"=>"Goiás"				],		["sigla"=>"MA" , "nome"=>"Maranhão"				],
		["sigla"=>"MG" , "nome"=>"Minas Gerais"			],		["sigla"=>"MS" , "nome"=>"Mato Grosso do Sul"	],
		["sigla"=>"MT" , "nome"=>"Mato Grosso"			],		["sigla"=>"PA" , "nome"=>"Pará"					],
		["sigla"=>"PB" , "nome"=>"Paraíba"				],		["sigla"=>"PE" , "nome"=>"Pernambuco"			],
		["sigla"=>"PI" , "nome"=>"Piauí"				],		["sigla"=>"PR" , "nome"=>"Paraná"				],
		["sigla"=>"RJ" , "nome"=>"Rio de Janeiro"		],		["sigla"=>"RN" , "nome"=>"Rio Grande do Norte"	],
		["sigla"=>"RO" , "nome"=>"Rondônia"				],		["sigla"=>"RR" , "nome"=>"Roraima"				],
		["sigla"=>"RS" , "nome"=>"Rio Grande do Sul"	],		["sigla"=>"SC" , "nome"=>"Santa Catarina"		],
		["sigla"=>"SE" , "nome"=>"Sergipe"				],		["sigla"=>"SP" , "nome"=>"São Paulo"			],
		["sigla"=>"TO" , "nome"=>"Tocantins"			]
	];

?>