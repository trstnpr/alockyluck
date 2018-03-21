<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * http://dev.maxmind.com/geoip/legacy/web-services/#PHP
 * Limited only for : City/ISP/Org service
 * author : Rolando Evaristo
 * 
 * dont autoload this library 
 * 
 * usage : 
 * 
 * add this code to your desired controller
 * $location = $this->maxmind->getInfo();
 * sample output :
 	[country_code] => US
    [region_code] => CA
    [city_name] => Hacienda Heights
    [postal_code] => 91745
    [latitude] => 34.002399
    [longitude] => -117.975700
    [metro_code] => 803
    [area_code] => 626
    [isp_name] => AT&T Services
    [organization_name] => "AT&T Services"
    [error] => 
 * 
 * settings ip and key (NOTE: default ip and key will be used if theres no ip and key set): 
 * $this->maxmind->getInfo(array('ip'=>'12.28.153.0'));
 * $this->maxmind->getInfo(array('key'=>'IOOBOI&O*&O&'));
 * $this->maxmind->getInfo(array('key'=>'IOOBOI&O*&O&', 'ip'=>'12.28.153.0'));
 * 
 * return array()
 * 
 * 
 */ 
class Maxmind{
	
	protected $licenseKey;
	protected $ip;
	protected $keys;
	protected $ci;
	
    function __construct(){
        $this->ci =& get_instance();
		$this->licenseKey  = '';
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->keys = array(
						    'country_code',
						    'region_code',
						    'city_name',
						    'postal_code',
						    'latitude',
						    'longitude',
						    'metro_code',
						    'area_code',
						    'isp_name',
						    'organization_name',
						    'error'
						    );
    }
	
	function setLicensedKey($key){
		$this->key = $key;
	}
	function setIp($ip){
		$this->ip = $ip;
	}
	
	function getInfo($options=null){

		$options['key'] = isset($options['key'])?$options['key']:$this->licenseKey;
		$options['ip'] = isset($options['ip'])?$options['ip']:$this->ip;
		
		$params = getopt('l:i:');
		$params['l'] = $options['key'];
		$params['i'] = $options['ip'];
		$query_url = 'http://geoip.maxmind.com/f?' . http_build_query($params);
		$content = file_get_contents($query_url);
		$geoData = $this->str_getcsv($content);
		if(count($geoData)){
			$geoData = $geoData[0];
			foreach($this->keys as $ctr=>$key){
				$data[$key] = isset($geoData[$ctr])?$geoData[$ctr]:'';
			}
		}else{
			$data = '';
		}
		return $data;
	}
	
	
	function str_getcsv($input, $delimiter = ',', $enclosure = '"', $escape = '\\', $eol = '\n') {
	    if (is_string($input) && !empty($input)) {
	        $output = array();
	        $tmp    = preg_split("/".$eol."/",$input);
	        if (is_array($tmp) && !empty($tmp)) {
	            while (list($line_num, $line) = each($tmp)) {
	                if (preg_match("/".$escape.$enclosure."/",$line)) {
	                    while ($strlen = strlen($line)) {
	                        $pos_delimiter       = strpos($line,$delimiter);
	                        $pos_enclosure_start = strpos($line,$enclosure);
	                        if (
	                            is_int($pos_delimiter) && is_int($pos_enclosure_start)
	                            && ($pos_enclosure_start < $pos_delimiter)
	                            ) {
	                            $enclosed_str = substr($line,1);
	                            $pos_enclosure_end = strpos($enclosed_str,$enclosure);
	                            $enclosed_str = substr($enclosed_str,0,$pos_enclosure_end);
	                            $output[$line_num][] = $enclosed_str;
	                            $offset = $pos_enclosure_end+3;
	                        } else {
	                            if (empty($pos_delimiter) && empty($pos_enclosure_start)) {
	                                $output[$line_num][] = substr($line,0);
	                                $offset = strlen($line);
	                            } else {
	                                $output[$line_num][] = substr($line,0,$pos_delimiter);
	                                $offset = (
	                                            !empty($pos_enclosure_start)
	                                            && ($pos_enclosure_start < $pos_delimiter)
	                                            )
	                                            ?$pos_enclosure_start
	                                            :$pos_delimiter+1;
	                            }
	                        }
	                        $line = substr($line,$offset);
	                    }
	                } else {
	                    $line = preg_split("/".$delimiter."/",$line);
	
	                    /*
	                     * Validating against pesky extra line breaks creating false rows.
	                     */
	                    if (is_array($line) && !empty($line[0])) {
	                        $output[$line_num] = $line;
	                    } 
	                }
	            }
	            return $output;
	        } else {
	            return false;
	        }
	    } else {
	        return false;
	    }
	}
}
