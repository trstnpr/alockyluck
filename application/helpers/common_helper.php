<?php


/*


function array_to_object($array) {


    if(!is_array($array)) {


        return $array;


    }


    


    $object = new stdClass();


    if (is_array($array) && count($array) > 0) {


      foreach ($array as $name=>$value) {


         $name = strtolower(trim($name));


         if (!empty($name)) {


            $object->$name = array_to_object($value);


         }


      }


      return $object; 


    }


    else {


      return FALSE;


    }


}





*/

function _isset(&$argument, $default="") {
   if(isset($argument)) {
       return $argument;
   }else{
	   return $default;
   }
}

function get_category_children($category_id,$options=array('order_by'=>'label ASC')){
	$that =& get_instance();
	$that->load->model('category_model');
	return $that->category_model->get_children($category_id,$options);
}
function count_category_child($id) {
	$that =& get_instance();
	$that->load->model('category_model');
	return $that->category_model->count_children($id);
}
function have_child($id) {
	$that =& get_instance();
	$that->load->model('category_model');
	$count = $that->category_model->count_children($id);		
	if($count > 0) {
		return true;
	} else {
		return false;
	}
}
function is_parent($id) {
	$that =& get_instance();
	$that->load->model('category_model');
	$count = $that->category_model->count_children($id);		
	if($count <= 0) {
		return true;
	} else {
		return false;
	}
}
function get_roles(){
	$that =& get_instance();
	$that->load->database();
	$that->db->select('*');
	$roles = $that->db->get('user_roles');
	if($roles->num_rows()){
		return $roles->result();
	}
}

function get_main_categories($options=null){
	$that =& get_instance();
	$that->load->model('category_model');
	return $that->category_model->get_all(array('parent'=>0, 'order_by'=>'label ASC'));
}
function get_main_articles($options=null){
	$that =& get_instance();
	$that->load->model('article_model');
	return $that->article_model	->get_all(array('order_by'=>'title ASC'));
}




function format_date($date, $format='Y-m-d') {
	$created = new DateTime($date);
	$created = date_format($created, $format);
	return $created;
}


function array_to_object($d) {


	if (is_array($d)) {


		/*


		* Return array converted to object


		* Using __FUNCTION__ (Magic constant)


		* for recursive call


		*/


		return (object) array_map(__FUNCTION__, $d);


	}


	else {


		// Return object


		return $d;


	}


}








function object_to_array($object) {


    if( !is_object( $object ) && !is_array( $object ) ) {


        return $object;


    }


    if( is_object( $object ) ) {


        $object = (array) $object;


    }


    return array_map( 'object_to_array', $object );


}





function slugify($text){ 


	  // replace non letter or digits by -


	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);


	


	  // trim


	  $text = trim($text, '-');


	


	  // transliterate


	  //$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);


	


	  // lowercase


	  $text = strtolower($text);


	


	  // remove unwanted characters


	  $text = preg_replace('~[^-\w]+~', '', $text);


	


	  if (empty($text))


	  {


	    return 'n-a-'.rand(1,99999);


	  }


	  return $text;


}





function format_title($params){


	


}





function _echo(&$argument, $default="") {


   if(isset($argument)) {


       echo $argument;


   }else{


	   echo $default;


   }


}











/**


 * trims text to a space then adds ellipses if desired


 * @param string $input text to trim


 * @param int $length in characters to trim to


 * @param bool $ellipses if ellipses (...) are to be added


 * @param bool $strip_html if html tags are to be stripped


 * @return string 


 */


function trim_text($input, $length, $ellipses = true, $strip_html = true) {


    //strip tags, if desired


    if ($strip_html) {


        $input = strip_tags($input);


    }


  


    //no need to trim, already shorter than trim length


    if (strlen($input) <= $length) {


        return $input;


    }


  


    //find last space within length


    $last_space = strrpos(substr($input, 0, $length), ' ');


    $trimmed_text = substr($input, 0, $last_space);


  


    //add ellipses (...)


    if ($ellipses) {


        $trimmed_text .= '...';


    }


  


    return $trimmed_text;


}





function stateToAbbr($stateName){


	$stateLists = array('alabama' => 'al','alaska' => 'ak','arizona' => 'az','arkansas' => 'ar','california' => 'ca','colorado' => 'co','connecticut' => 'ct','delaware' => 'de','florida' => 'fl','georgia' => 'ga','hawaii' => 'hi','idaho' => 'id','illinois' => 'il','indiana' => 'in','iowa' => 'ia','kansas' => 'ks','kentucky' => 'ky','louisiana' => 'la','maine' => 'me','maryland' => 'md','massachusetts' => 'ma','michigan' => 'mi','minnesota' => 'mn','mississippi' => 'ms','missouri' => 'mo','montana' => 'mt','nebraska' => 'ne','nevada' => 'nv','new hampshire' => 'nh','new jersey' => 'nj','new mexico' => 'nm','new york' => 'ny','north carolina' => 'nc','north dakota' => 'nd','ohio' => 'oh','oklahoma' => 'ok','oregon' => 'or','pennsylvania' => 'pa','rhode island' => 'ri','south carolina' => 'sc','south dakota' => 'sd','tennessee' => 'tn','texas' => 'tx','utah' => 'ut','vermont' => 'vt','virginia' => 'va','washington' => 'wa','west virginia' => 'wv','wisconsin' => 'wi','wyoming' => 'wy','american samoa' => 'as','district of columbia' => 'dc','federated states of micronesia' => 'fm','guam' => 'gu','marshall islands' => 'mh','northern mariana islands' => 'mp','palau' => 'pw','puerto rico' => 'pr','virgin islands' => 'vi','armed forces americas' => 'aa','armed forces pacific' => 'ap');


	if(array_key_exists(strtolower($stateName),$stateLists)){


		return $stateLists[strtolower($stateName)];


	}else{


		return '';


	}


}





function str_to_csv($input, $delimiter = ',', $enclosure = '"', $escape = '\\', $eol = '\n') {


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


function exclude_pages($url=null) {
  $exclude = array('about-us', 'privacy-policy');

  if(in_array($url, $exclude)) {
    return 0;
  } else {
    return 1;
  }
}


function get_page_description($id=null) {
	$that =& get_instance();
	$that->load->model('page_model');
	$page = $that->page_model->get($id);
	return $page->content;
}


function get_all_articles_tags(){
	$that =& get_instance();
	$that->load->model('article_model');
	$articles = $that->article_model->get_all();
	$tags = "";
	foreach ($articles as $article) {
		if($article->tags){
			$tags[] = $article->tags;
		}
	}

	if($tags){
		$tags = implode(",", $tags);
	}
	
	return $tags;
}
function get_all_articles_author(){
	$that =& get_instance();
	$that->load->model('article_model');
	$articles = $that->article_model->get_all();
	$author = "";
	foreach ($articles as $article) {
		if($article->author){
			$author[] = $article->author;
		}
	}

	if($author){
		$author = implode(",", $author);
	}
	
	return $author;
}
function get_all_articles_categories(){
	$that =& get_instance();
	$that->load->model('article_model');
	$articles = $that->article_model->get_all();
	$category = "";
	foreach ($articles as $article) {
		if($article->category){
			$category[] = $article->category;
		}
	}

	if($category){
		$category = implode(",", $category);
	}
	
	return $category;
}
function get_all_articles_with_tags($tag=null){
	$that =& get_instance();
	$that->load->model('article_model');
	$articles = $that->article_model->get_all_articles_with_tags(array('tag'=>$tag));
	return $articles;
}
function get_all_articles_with_author($author=null){
	$that =& get_instance();
	$that->load->model('article_model');
	$articles = $that->article_model->get_all_articles_with_tags(array('author'=>$author));
	return $articles;
}
function get_all_articles_with_categories($category=null){
	$that =& get_instance();
	$that->load->model('article_model');
	$articles = $that->article_model->get_all_articles_with_categories(array('category'=>$category));
	return $articles;
}

function tags_category_url_format($url){
	$tags_category_url_format = str_replace("-"," ",$url);
	$tags_category_url_format = ucwords($tags_category_url_format);

	return $tags_category_url_format;
}
