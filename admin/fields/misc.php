<?php
	
	
	$string = !empty($options[0]['strchk']) && (sanitize_text_field($options[0]['strchk']) == '1') ? 'checked="checked"' : null;
	$snf = 	!empty($options[0]['snf']) && (sanitize_text_field($options[0]['snf']) == '1') ? 'checked="checked"' : null;
	$slabel = !empty($options[0]['strlabel']) ? sanitize_text_field($options[0]['strlabel']) : __("Search by Keyword","UWPQSF");
	$meta = !empty($options[0]['smetekey']) ? sanitize_text_field($options[0]['smetekey']) : null;
	$ordertype =  !empty($options[0]['otype'])   ? $options[0]['otype']  : null;
	$number =  !empty($options[0]['otype']) && ($options[0]['otype'] == 'meta_value_num' )  ? 'checked="checked"' : null;
	$desc = !empty($options[0]['sorder']) && ($options[0]['sorder'] == 'DESC' )  ? 'checked="checked"' : null; 
	$asc = !empty($options[0]['sorder']) && ($options[0]['sorder'] == 'ASC' )  ? 'checked="checked"' : null; 
	$button = !empty($options[0]['button']) ? sanitize_text_field($options[0]['button']) : 'Search'; 
	$defualtresult = get_option('posts_per_page');
	$result = !empty($options[0]['resultc']) ? sanitize_text_field($options[0]['resultc']) : $defualtresult; 

	$incative = ($ordertype == 'meta_value' || $ordertype == 'meta_value_num' ) ?  '' :  'disabled="disabled" class="inactive"';
	
	$html = '<div class="cbox">';
	$html .= '<h3>'.__("Result Setting and Others","UWPQSF").'</h3>';
	$html .= '<div class="fullwide">';	
	$html .= '<h3>'.__("Add String Search?","UWPQSF").'</h3>';
	$html.= '<p><input '.$string.'  name="uwpname[rel][0][strchk]" type="checkbox" value="1" />'.__("Enabling string search","UWPQSF").'<br>';
        $html.= '<span class="desciption">'.__("This will add string search in the form. Note that when user using this to search, the taxonomy and custom meta filter that defined above will not be used. However, the search will still go through the post type defined above.","UWPQSF").'</span></p>';
       $html.= '<p><label>'.__("Label for string search.","UWPQSF").':</label><br>';
       $html.= '<input type="text"  name="uwpname[rel][0][strlabel]" id="stringlabel" value="'.$slabel.'" /><br></p>';
       $html.= '<p><input '.$snf.'  name="uwpname[rel][0][snf]" type="checkbox" value="1" />'.__("Combine string search with filters above","UWPQSF").'</p>';
       $api = new uwpqsfclass();
	$orderbys = $api->orderby_options();

     $html .= '<h3>'.__("Result Page Setting","UWPQSF").'</h3>';
 
    
     $html.= '<p><label>'.__("Orderby","UWPQSF").':</label><br>';
     $html .= '<select name="uwpname[rel][0][otype]" class="uorderby">';
    	foreach($orderbys as $k => $v){
	$select = ($ordertype==$k) ? 'selected="selected"' : '';	
     $html .= '<option value="'.$k.'" '.$select.'>'.$v.'</option>';	
	}	
     $html .=  '</select><br>';		
     $html.= '<span class="desciption">'.__("Sort retrieved posts by parameter. For Meta Value or Numeric Meta Value, must insert Sorting Meta Key below.","UWPQSF").'</span></p>';


   $html.= '<p><label>'.__("Sorting Meta Key.","UWPQSF").':</label><br>';
   
	$keys = $api->get_all_metakeys();
    $html .= '<select name="uwpname[rel][0][smetekey]" id="ormkey" '.$incative.'><option value=""></option>';
	foreach($keys as $key){
		$selected = ($meta==$key) ? 'selected="selected"' : '';	
    $html .= '<option value="'.$key.'" '.$selected.'>'.$key.'</option>';		
	}		

    $html .=  '</select><br>';	
    $html.= '<span class="desciption">'.__("Insert the meta key that will be used for the result sorting. The meta key must also be present in the query.","UWPQSF").'</span></p>';	
    
    $html.= '<p><label>'.__("Sorting Order","UWPQSF").':</label><br>';
    $html.= '<label><input '.$desc.' type="radio" id="taxhide" name="uwpname[rel][0][sorder]" value="DESC"/>'.__("Descending","UWPQSF").'</label>';
	$html.= '<label><input '.$asc.' type="radio" id="taxhide" name="uwpname[rel][0][sorder]" value="ASC"/>'.__("Ascending","UWPQSF").'</label><br>';
    $html.= '<span class="desciption">'.__("The search result sorting order. Default is descending","UWPQSF").'</span></p>';
    
    $html.= '<p><label>'.__("Results per Page","UWPQSF").':</label>';
    $html.= '<input type="text" id="numberpost" name="uwpname[rel][0][resultc]" value="'.$result.'" size="2"/><br>';
    $html.= '<span class="desciption">'.__("How many posts shows at each result page?","UWPQSF").'</span></p>';

    $html.= '<p><label>'.__("Search Button Text","UWPQSF").':</label>';
    $html.= '<input type="text" id="numberpost" name="uwpname[rel][0][button]" value="'.$button.'" /><br>';
    $html.= '<span class="desciption">'.__("The text of the submit button?","UWPQSF").'</span></p>';	
 
    $html.= '</div></div>';
    echo $html;

?>
