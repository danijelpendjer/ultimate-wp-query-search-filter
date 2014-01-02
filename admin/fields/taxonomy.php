<div class="cbox">
<h3><?php echo esc_html( __( 'Taxonomy', 'UWPQSF' ) ); ?></h3>
<div class="leftcol">
<div class="add_tax_form_div" >
	<div id="addTaxoForm">
	<h3><b><?php _e("Add New Taxonomy Field","UWPQSF");?></b></h3>
	
	<p>
	<span><b><?php _e("Select Taxonomy","UWPQSF");?></b></span><br>
	<select id="pretax" name="pre_add_tax">
	<option value=""></option>
	<option value="category"><?php _e("category","UWPQSF");?></option>
	<option value="post_tag"><?php _e("Post tag","UWPQSF");?></option>
	<?php
	        $taxoperator =array('1'=>'IN','2'=>'NOT IN','3'=>'AND');
		$args=array('public'   => true, '_builtin' => false); 
		$output = 'names'; // or objects
		$operator = 'and'; // 'and' or 'or'
		$taxonomies=get_taxonomies($args,$output,$operator); 
		if  ($taxonomies) {
			foreach ($taxonomies  as $taxonomy ) {
			echo '<option value="'.$taxonomy.'">'.$taxonomy.'</option>';
	     }
		};
	?>
	</select>
	</p>
	<p>
	<span><b><?php _e("Label","UWPQSF");?></b></span><br>
	<input type="text" id="prelabel" name="pre_tax_label" size="20" value=""><br>
	<span class="desciption"><?php _e("To be displayed in the search form", "UWPQSF");?></span>
	</p>
	<p>
	<span><b><?php _e("Text For 'Search All' Options","UWPQSF");?></b></span><br>
	<input type="text" id="preall" name="pre_all_text" size="20" value="" /><br>
	<span class="desciption"><?php _e("eg, All cities, All genres", "UWPQSF") ;?></span>
	</p>
	<p>
	<span><b><?php _e("Hide Empty Terms?","UWPQSF");?></b></span><br>
	<label><input type="radio" id="prezero" name="pre_hide_empty" value="1"   />Yes</label>
	<label><input type="radio" id="prezero" name="pre_hide_empty" value="0"   />No</label><br>
	<span class="desciption"><?php _e("Empty terms are the terms that no posts assigned to them. ", "UWPQSF") ;?></span>
	</p>
	<p>
	<span><b><?php _e("Exculde Term ID","UWPQSF");?></b></span><br>
	<input type="text" id="preexclude" name="pre_tax_exclude" size="20" value=""><br>
	<span class="desciption"><?php _e("Enter the term's ID that you want to exclude. Seperate by comma ',' ", "UWPQSF") ;?></span>
	</p>
	<p>
	<span><b><?php _e("Display Type?","UWPQSF");?></b></span><br>	
	<?php
	$taxofields = new uwpqsfclass();	
	$feilds = 	$taxofields->utaxo_display();
	foreach ($feilds as $v => $k){
		echo '<label><input type="radio" id="pretype" name="displyatype" value="'.$v.'"   />';
		printf( __( '%s', 'UWPQSF' ), $k);
		echo '</label>';
	}	
	;?>
	<br>
	<?php do_action( 'ajwpsf_taxodisplay_desc'); ?>
	</span>
	</p>

	<p>
	  <span><b><?php _e("Operator","UWPQSF");?></b></span><br>
	   <?php
		foreach($taxoperator as $k => $v){
		  echo '<label><input type="radio" id="preoperator" name="pre_operator" value="'.$k.'"   />'.$v.'</label>';	
		}
           ?>
	   <br>
	  <span class="desciption"><?php _e("Operator to test. Default is IN. For checkbox you can use AND", "UWPQSF") ;?></span>	
	</p>

	<?php do_action('uwpqsftaxo_form_add') ;?>

	<input type="button" value="<?php _e("Add Taxonomy","UWPQSF");?>" class="adduTaxo button-secondary" /><div class="clear"></div>
	</div>
	
	</div>
</div>

<div class="rightcol">
	<h3><?php _e("Taxonomy Fields","UWPQSF");?></h3>
<?php 
$post_id = isset($_GET['uformid']) ? $_GET['uformid'] : null;
$items = array("AND", "OR");
	echo '<span>'.__("Boolean relationship between the taxonomy queries : ", "UWPQSF").'</span>';
	foreach($items as $item) {
		$bool = get_post_meta($post_id, 'uwpqsf-option', true);
		
		$checked = !empty($bool[0]['tax']) && ($bool[0]['tax']==$item) ? 'checked="checked"' : '';
		echo '<label><input id = "taxrel" '.$checked.' value="'.$item.'" name="uwpname[rel][0][tax]" type="radio" />'.$item.'</label>';
	}	
	
	echo '<br><span class="desciption">'.__("<b>AND</b> - Must meet all taxonomy search.","UWPQSF").'</span>';echo '&nbsp;&nbsp;';
	echo '<span class="desciption">'.__("<b>OR</b> - Either one of the taxonomy search is meet.","UWPQSF").'</span><br><br>';
	
?>


	<div class="taxobox">
        <?php
	   
	   $taxo = get_post_meta($post_id, 'uwpqsf-taxo', true);
	     if(!empty($taxo)){
		echo '<span class="drag">'.__("*Drag and Drop to reorder your table row. The table row order indicates the order of the search form fields in the frontend. ","UWPQSF").'</span>';
		$c =0; 
		$args=array('public'   => true, '_builtin' => false); 
		$output = 'names'; // or objects
		$operator = 'and'; // 'and' or 'or'
		$taxonomies=get_taxonomies($args,$output,$operator); 
                 foreach($taxo as $k => $v){
		   echo '<div id="dragbox"><h3><div class="toggle plus"></div>'.$v['taxlabel'].'<a href="" class="removediv">Remove</a></h3>';
		   echo '<div class="taxodragbox"  style="display:none">';	
		   echo '<input type="hidden" id="taxcounter" name="taxcounter" value="'.$c.'"/>';
                   //taxonomy	
		   echo '<p><span><b>'.__("Taxonomy","UWPQSF").'</b></span><br>'; 
		   echo '<select id="taxo" name="uwpname[taxo]['.$c.'][taxname]">';
				$catselect = ($v['taxname']== 'category') ? 'selected="selected"' : '';
		   echo '<option value="category" '.$catselect.'>'.__("category","UWPQSF").'</option>';
				$tagselect = ($v['taxname']== 'post_tag') ? 'selected="selected"' : '';
		   echo '<option value="post_tag" '.$tagselect.'>'.__("Post tag","UWPQSF").'</option>';
			     foreach ($taxonomies  as $taxonomy ) {
		            	$selected = ($v['taxname']==$taxonomy) ? 'selected="selected"' : '';		
		   echo '<option value="'.$taxonomy.'" '.$selected.'>'.$taxonomy.'</option>';
			     }	 
		   echo '</select></p>';
                   //taxo label
		   echo '<p>';
		   echo '<span><b>'.__("Label","UWPQSF").'</b></span><br>';
		   echo '<input type="text" id="taxlabel" name="uwpname[taxo]['.$c.'][taxlabel]" value="'.sanitize_text_field($v['taxlabel']).'"/>';  
		   echo '</p>';
	           //search all text
                   echo '<p>';
		   echo '<span><b>'.__("Text For 'Search All' Options","UWPQSF").'</b></span><br>';	
		   echo '<input type="text" id="taxall" name="uwpname[taxo]['.$c.'][taxall]" value="'.sanitize_text_field($v['taxall']).'"/>';
		   echo '</p>';	
		   //hide empty
		   echo '<p>';
                   echo '<span><b>'.__("Hide Empty Terms?","UWPQSF").'</b></span><br>';
		      $check1="";
		      $check0="";
			if($v['hide'] == 1){$check1 = 'checked="checked"'; };
		  	if($v['hide'] == 0){$check0 = 'checked="checked"'; };
		   echo '<label><input '.$check1.' type="radio" id="taxhide" name="uwpname[taxo]['.$c.'][hide]" value="1"/>Yes</label>';
		   echo '<label><input '.$check0.' type="radio" id="taxhide" name="uwpname[taxo]['.$c.'][hide]" value="0"/>No</label>';	 
		   echo '</p>';	
	           //exclude ids	
		   echo '<p>';
		   echo '<span><b>'.__("Exculde Term ID","UWPQSF").'</b></span><br>';
                   echo '<input type="text" id="taxexculde" name="uwpname[taxo]['.$c.'][exc]" value="'.sanitize_text_field($v['exc']).'"/>';
		   echo '</p>';	
		   //display type	
		   echo '<p>';
		   echo '<span><b>'.__("Display Type?","UWPQSF").'</b></span><br>';
		   $taxofields = new uwpqsfclass();	
		     $feilds = 	$taxofields->utaxo_display();
			foreach($feilds as $val  => $key ){
		             $checked = ($v['type']== $val) ?  'checked="checked"' : '';
		   echo '<label><input type="radio" id="taxtype" name="uwpname[taxo]['.$c.'][type]" value="'.$val.'" '.$checked.'/>'.$key.'</label><br>';
		    	} 
		   echo '</p>';	
		   //operator
		   echo '<p>';
		   echo '<span><b>'.__("Operator","UWPQSF").'</b></span><br>';
                          foreach( $taxoperator as $value => $name){
				$checkoperate = ($v['operator']== $value) ?  'checked="checked"' : '';
		   echo '<label><input type="radio"  name="uwpname[taxo]['.$c.'][operator]" value="'.$value.'" '.$checkoperate.' />'.$name.'</label>';	
			  } 
		   echo '</p><br>';		
		
		  $fhook = do_action('uwpqsftaxo_form_main',$v);			
		   echo  $fhook;				
		   echo '</div></div>';$c++;	//end taxdragbox
		}

			
	     }else{}	
	  	
	?>
	</div>	
</div>
<div class="clear"></div>
</div>

