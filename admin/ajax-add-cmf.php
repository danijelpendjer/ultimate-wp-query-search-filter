<?php 
	
	$type = $_POST['type'];
	$classapi = new uwpqsfclass();	
	if($type == 'form'){
	parse_str($_POST['getcmfdata'], $getdata);
	
	$metakey = isset($getdata['prekey']) ? sanitize_text_field($getdata['prekey']) : '';
	$label = isset($getdata['precmflabel']) ? sanitize_text_field($getdata['precmflabel']) : '';
	$all = isset($getdata['precmfall']) ? sanitize_text_field($getdata['precmfall']) : '';
	$com = isset($getdata['precompare']) ? sanitize_text_field($getdata['precompare']) : '';
	$check = isset($getdata['cmfdisplay']) ? sanitize_text_field($getdata['cmfdisplay']) : '';
	$option =isset($getdata['preopt']) ? sanitize_text_field($getdata['preopt']) : '';
	$c = isset($_POST['cmfcounter']) ? sanitize_text_field($_POST['cmfcounter']) : '';
	
	
	   $campares = $classapi->cmf_compare();	
	   	echo '<div id="dragbox" ><h3><div class="toggle2 plus"></div>'.$label.'<a href="" class="removediv">Remove</a></h3>';
		echo '<div class="cmfdragbox" style="display:none">';
		echo '<input type="hidden" id="cmfcounter" value='.$c.'>';	
		//meta key
		echo '<p><span><b>'.__("Meta Key","UWPQSF").'</b></span><br>';
		    $keys = $classapi->get_all_metakeys();
		echo '<select id="cmfkey" name="uwpname[cmf]['.$c.'][metakey]">';
		    foreach($keys as $key){
			 $selected = ($metakey == $key) ? 'selected="selected"' : '';	
			 echo '<option value="'.$key.'" '.$selected.'>'.$key.'</option>';		
			}	
		echo '</select>';
		echo '</p>';
		//for Label
		echo '<p><span><b>'.__("Label","UWPQSF").'</b></span><br>';
		echo '<input type="text" id="cmflabel" name="uwpname[cmf]['.$c.'][label]" value="'.sanitize_text_field($label).'"/>';
		echo '</p>';
		//search all text
		echo '<p><span><b>'.__("Text For 'Search All' Options","UWPQSF").'</b></span><br>';
		echo '<input type="text" id="cmfalltext" name="uwpname[cmf]['.$c.'][all]" value="'.sanitize_text_field($all).'"/>';
		echo '</p>';
		//for compare
		echo '<p><span><b>'.__("Compare","UWPQSF").'</b></span><br>';
		echo '<select id="cmfcom" name="uwpname[cmf]['.$c.'][compare]">';
		  foreach ($campares  as $ckey => $cvalue ) {
			$selected = ($com==$ckey) ? 'selected="selected"' : '';	
		echo '<option value="'.$ckey.'" '.$selected.'>'.$cvalue.'</option>';}
		echo '</select>';
		echo '</p>';
		//for Display type
		echo '<p><span><b>'.__("Display Type?","UWPQSF").'</b></span><br>';
		$ftypes = $classapi->ucmf_display();
		  foreach($ftypes as $mv  => $mk ){
			$checked = ($check== $mv) ?  'checked="checked"' : '';
		echo '<label><input type="radio" id="taxtype" name="uwpname[cmf]['.$c.'][type]" value="'. $mv.'" '.$checked.' />'.sprintf(__('%s', 'UWPQSF'),$mk).'</label><br>';      }
		echo '</p>';
		//for options
		echo '<p><span><b>'.__("Options:","UWPQSF").'</b></span><br>';
		echo '<textarea id="cmflabel" name="uwpname[cmf]['.$c.'][opt]" >'.esc_html($option).'</textarea>';
		echo '</p>';
		
		$hooks = do_action('uwpqsfcmf_form_ajax',$getdata,$c);
		echo $hooks;
		echo '<br></div></div>';
			//end taxdragbox
	}
	if($type == 'meta'){
		$metakey = $_POST['key'];
		$values = $classapi->get_all_metavalue($metakey);
		echo implode(" | ", $values);

		
	}
	
	exit;


?>
