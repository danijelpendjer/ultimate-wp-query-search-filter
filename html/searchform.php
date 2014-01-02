<?php
$nonce = wp_create_nonce  ('uwpsfsearch');
$taxo = get_post_meta($id, 'uwpqsf-taxo', true);
$cmf = get_post_meta($id, 'uwpqsf-cmf', true);
$options = get_post_meta($id, 'uwpqsf-option', true);
$css = get_post_meta($id, 'uwpqsf-theme', true);
$excss = explode('|', $css);
$divid = ($excss[2]) ? $excss[2] : 'uwpqsf_id';
$defaultclass = ($excss[3]) ? $excss[3] : 'uwpqsf_class';

if($options[0]['method'] == '1'){
	$hidden = '<input type="hidden" id="uajaxdiv" value="'.$options[0]['div'].'">';
	$btype = 'button';	
	$method = '';
	$bclass = 'usearchbtn';	
	$auto = '1';	
}else{
 	$hidden = '<input type="hidden" name="s" value="uwpsfsearchtrg" />'; 
	$btype = 'submit';	
	$method = 'method="get" action="'.home_url( '/' ).'"';	
	$bclass ='';		
	$auto = '';
}

 do_action( 'uwpqsf_form_top', $atts);


$fields = new uwpqsfront();

echo '<div id="'.$divid.'">';
echo '<form id="uwpqsffrom_'.$id.'" '.$method.'>';
if($formtitle){
	echo '<div class="uform_title">'.get_the_title($id).'</div>';
}
echo '<input type="hidden" name="unonce" value="'.$nonce.'" /><input type="hidden" name="uformid" value="'.$id.'">';

echo $hidden;

if(!empty($taxo)){
	$c = 0;
	foreach($taxo as $k => $v){
		$eid = explode(",", $v['exc']);
		$args = array('hide_empty'=>$v['hide'],'exclude'=>$eid );	
        $terms = get_terms($v['taxname'],$args);
 	    $count = count($terms);
		echo $fields->output_formtaxo_fields($v['type'],$v['exc'],$v['hide'],$v['taxname'],$v['taxlabel'],$v['taxall'],$v['operator'],$c,$defaultclass,$id,$divclass );
	     
	$c++;			
  }
}

if(!empty($cmf)){  
   $i=0;
    foreach($cmf as $k => $v){
		if(isset($v['type'])){
			echo $fields->output_formcmf_fields($v['type'],$v['metakey'],$v['compare'],$v['opt'],$v['label'],$v['all'],$i,$defaultclass,$id,$divclass );
		 $i++;
	   }	
	}
}

if(isset($options[0]['strchk']) && ($options[0]['strchk'] == '1') ){
		$stext  = '<div class="'.$defaultclass.' '.$divclass.'"><label class="'.$defaultclass.' '.$divclass.'-keyword">'.$options[0]['strlabel'].'</label>';
		$stext .= '<input id="'.$divid.'_key" type="text" name="skeyword" class="uwpqsftext" value="" />';
        $stext .= '</div>';
        $textsearch =  apply_filters('uwpqsf_string_search',$stext, $id,$divid,$defaultclass,$divclass,$options);
        echo $textsearch;
}
do_action( 'uwpqsf_form_bottom' , $atts);

if($button && $button == '1'){
$html = '<div class="'.$defaultclass.' '.$divclass.' uwpqsf_submit">';
$html .= '<input type="'.$btype.'" id="'.$divid.'_btn" value="'.$options[0]['button'].'" alt="[Submit]" class="usfbtn '.$bclass.'" /></div>';
$btn = apply_filters('uwpsqf_form_btn', $html, $id,$divclass,$defaultclass,$divid,$options[0]['button'] );
echo $btn;
}elseif($button == '0'){
 if($auto == '1'){
	$form = '"#uwpqsffrom_'.$id.'"';
  ?>
	<script type="text/javascript">jQuery(document).ready(function($) { 
	var formid = <?php echo $form; ?>; 
	$(formid).change(function(){ process_data($(this)); })
      ;})</script>
  <?php
 }
}


echo '</form>';//end form
echo '</div>'; //end div
;?>


