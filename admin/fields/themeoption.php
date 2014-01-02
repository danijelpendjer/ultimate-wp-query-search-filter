<?php
add_thickbox();
   $html = '<div class="cbox"><h3>'.__("Form's Theme","UWPQSF").'</h3>';
	
	$themes = get_post_meta($postid, 'uwpqsf-theme', true);
	$extheme ='';	
	$themeopt = new uwpqsfclass();	
	$themeops = $themeopt->uwpqsf_theme();
	if(!empty($themes)){
	$extheme = explode('|', $themes);}
	$html .= '<div class="fullwide">';
	$c=1;	
	foreach($themeops as $k){
		$default = (empty($extheme) && $k['themeid']=='udefault') ? 'checked="checked"' : '';
		
		$checked = (!empty($extheme) && $k['themeid'] ==  $extheme[0]) ? 'checked="checked"' : '';
			
	
	 	 $value = $k['themeid'].'|'.$k['link'].'|'.$k['id'].'|'.$k['class'];
		 $html .= '<label class="ptheme">';
		 $html .= '<input type="radio" name="themeopt" value="'.$value.'" '.$checked.'  '.$default.'">'.$k['name'].'<br>';
		 $html .= '<a href="#TB_inline?width=600&height=600&inlineId=themethumb_'.$c.'" class="thickbox">'.__(" Preview","UWPQSF").'</a>';  
		 $html .= '<div class="clear"></div></label>';
		 $html .= '<div id="themethumb_'.$c.'"  style="display:none"><img src="'.$k['thumb'].'"></div>';
		 
		$c++;		 
	}
	
	$html .= '<div class="clear"></div></div></div><br><br>';	
	echo $html;

?>
