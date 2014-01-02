<?php 

		parse_str($_POST['gettaxodata'], $getdata);
		//$taxo = $getdata['taxo'];
		$taxo = $getdata['pre_add_tax'];
		$label = sanitize_text_field($getdata['pre_tax_label']);
		$text = sanitize_text_field($getdata['pre_all_text']);
		$hide = isset($getdata['pre_hide_empty']) ? $getdata['pre_hide_empty'] : '';
		$exclude = $getdata['pre_tax_exclude'];
		$type = isset($getdata['displyatype']) ? $getdata['displyatype'] : '';
		$operator = isset($getdata['pre_operator']) ? $getdata['pre_operator'] : '';
		$c = $_POST['counter'];
		 $taxoperator =array('1'=>'IN','2'=>'NOT IN','3'=>'AND');
			$args=array(
	  'public'   => true,
	  '_builtin' => false
	  
	); 
	$output = 'names'; // or objects
	$compare = 'and'; // 'and' or 'or'
	$taxonomies=get_taxonomies($args,$output,$compare); 
	 
	echo '<div id="dragbox" ><h3><div class="toggle plus" title="'.__("Click To Edit", "UWPQSF").'"></div>'.$label.'<a href="" class="removediv">Remove</a></h3>';
	echo '<div class="taxodragbox" style="display:none">';
	echo '<input type="hidden" id="taxcounter" value='.$c.'>';	
	echo '<p><span><b>'.__("Taxonomy","UWPQSF").'</b></span><br>'; 
	echo '<select id="taxo" name="uwpname[taxo]['.$c.'][taxname]">';
				$catselect = ($taxo == 'category') ? 'selected="selected"' : '';
	echo '<option value="category" '.$catselect.'>'.__("category","UWPQSF").'</option>';
				$tagselect = ($taxo == 'post_tag') ? 'selected="selected"' : '';
	echo '<option value="post_tag" '.$tagselect.'>'.__("Post tag","UWPQSF").'</option>';
		     foreach ($taxonomies  as $taxonomy ) {
	            	$selected = ($taxo == $taxonomy) ? 'selected="selected"' : '';		
	echo '<option value="'.$taxonomy.'" '.$selected.'>'.$taxonomy.'</option>';
		     }	 
	echo '</select></p>';
	
	
	echo '<p>';
	echo '<span><b>'.__("Label","UWPQSF").'</b></span><br>';
	echo '<input type="text" id="taxlabel" name="uwpname[taxo]['.$c.'][taxlabel]" value="'.sanitize_text_field($label).'"/>';  
	echo '</p>';

	 echo '<p>';
	 echo '<span><b>'.__("Text For 'Search All' Options","UWPQSF").'</b></span><br>';	
	 echo '<input type="text" id="taxall" name="uwpname[taxo]['.$c.'][taxall]" value="'.sanitize_text_field($text).'"/>';
	 echo '</p>';	

	 //hide empty
	 echo '<p>';
         echo '<span><b>'.__("Hide Empty Terms?","UWPQSF").'</b></span><br>';
	      $check1="";
	      $check0="";
		if($hide == 1){$check1 = 'checked="checked"'; };
	  	if($hide == 0){$check0 = 'checked="checked"'; };
	  echo '<label><input '.$check1.' type="radio" id="taxhide" name="uwpname[taxo]['.$c.'][hide]" value="1"/>Yes</label>';
	  echo '<label><input '.$check0.' type="radio" id="taxhide" name="uwpname[taxo]['.$c.'][hide]" value="0"/>No</label>';	 
	  echo '</p>';	
	  //exclude ids	
	  echo '<p>';
	  echo '<span><b>'.__("Exculde Term ID","UWPQSF").'</b></span><br>';
          echo '<input type="text" id="taxexculde" name="uwpname[taxo]['.$c.'][exc]" value="'.sanitize_text_field($exclude).'"/>';
	  echo '</p>';	
	  //display type	
	  echo '<p>';
	  echo '<span><b>'.__("Display Type?","UWPQSF").'</b></span><br>';
	    $taxofields = new uwpqsfclass();	
	     $feilds = 	$taxofields->utaxo_display();
		foreach($feilds as $val  => $key ){
		             $checked = ($type == $val) ?  'checked="checked"' : '';
	  echo '<label><input type="radio" id="taxtype" name="uwpname[taxo]['.$c.'][type]" value="'.$val.'" '.$checked.'/>'.$key.'</label>';
		} 
	   echo '</p>';	
	   //operator
	   echo '<p>';
	   echo '<span><b>'.__("Operator","UWPQSF").'</b></span><br>';
                  foreach( $taxoperator as $value => $name){
			$checkoperate = ($operator == $value) ?  'checked="checked"' : '';
	   echo '<label><input type="radio"  name="uwpname[taxo]['.$c.'][operator]" value="'.$value.'" '.$checkoperate.' />'.$name.'</label>';	
		  } 
	   echo '</p>';	
	
	   $taxohooks = do_action('uwpqsftaxo_form_ajax',$getdata,$c);	
					
	   echo '<br></div></div>';	//end taxdragbox

	
	exit;	
?>
