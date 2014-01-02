<?php
if(!class_exists('uwpqsfclass')){
  class uwpqsfclass{
	function __construct(){
				
		}

	function utaxo_display(){
	    $fields =  array('dropdown' => 'Drop Down', 'radio' => 'Radio', 'checkbox' => 'Check Box');
	    $output = apply_filters( 'uwpqsftaxo_field', $fields );
	    return $output;
	}

	function ucmf_display(){
			$fields =  array('dropdown' => 'Drop Down', 'radio' => 'Radio', 'checkbox' => 'Check Box');
			$output = apply_filters( 'uwpqsfcmf_field', $fields );
			return $output;
	}

	function cmf_compare(){
			 $campares = array( '1' => '=', '2' =>'!=', '3' =>'>', '4' =>'>=', '5' =>'<', '6' =>'<=', '7' =>'LIKE', '8' =>'NOT LIKE', '9' =>'IN', '10' =>'NOT IN', '11' =>'BETWEEN', '12' =>'NOT BETWEEN','13' => 'NOT EXISTS');	
			 return apply_filters( 'ucmf_compare',  $campares );
		}

	function orderby_options(){
		 $orderyby  = array('date'=> "Date", 'title' => "Post Title", 'name' => "Name (Post Slug)", 'modified' => "Modified Date", 'parent' => "Post Parent ID" , 'rand' => "Random", 'meta_value' => "Meta Value", 'meta_value_num' => "Numeric Meta Value");

		 return apply_filters( 'uwpqsf_orderby',  $orderyby );

	}
	
	function get_all_metakeys(){
		global $wpdb;
		$table = $wpdb->prefix.'postmeta';
		$keys = $wpdb->get_results( "SELECT meta_key FROM $table GROUP BY meta_key",ARRAY_A);

		foreach($keys as $key){
			if($key['meta_key']=='uwpqsf-cpt' || $key['meta_key']=='uwpqsf-taxo' || $key['meta_key']=='uwpqsf-relbool' || $key['meta_key']=='uwpqsf-cmf'){
			}
			else{
				$meta_keys[] = 	$key['meta_key'];		 
				}
		}
		return $meta_keys;
	}

	function get_all_metavalue($metakey){
		global $wpdb;
		$table = $wpdb->prefix.'postmeta';
		$values = $wpdb->get_results( "SELECT meta_value FROM $table WHERE meta_key = '$metakey' GROUP BY meta_value", ARRAY_A);
		foreach($values as $value){
			 $metavalue[] = $value['meta_value'].'::'.$value['meta_value']; 
			}
		
		return $metavalue;
	}

	function uwpqsf_theme(){
			$theme = array(
				array(
					'name' => __('Default Theme','UWPQSF'),
					'themeid' => 'udefault',
					'link' => plugins_url( '/themes/default.css', dirname(__FILE__)) ,
					'id'   => 'uwpqsf_id',
					'class' => 'uwpqsf_class',
					'thumb' => plugins_url( '/themes/default.png', dirname(__FILE__))
					)
			);
			$output = apply_filters( 'uwpqsf_theme_opt', $theme );
			return $output;
	}
	

	function uwpqsf_theme_val(){
		global $wpdb;
		$table = $wpdb->prefix.'postmeta';
		$values = $wpdb->get_results( "SELECT meta_value FROM $table WHERE meta_key = 'uwpqsf-theme' GROUP BY meta_value", ARRAY_A);
		if($values){
		foreach($values as $value){
			$extract = explode('|', $value['meta_value']);
			$return[] = $extract[0];
		  }
		  return  $return; 
		}
	    
	  }

  }//end class
}//end check class
global $uwpqsfapi;
$uwpqsfapi = new uwpqsfclass();
?>