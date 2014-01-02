<div class="cbox">
<h3><?php echo esc_html( __( 'Meta Field', 'UWPQSF' ) ); ?></h3>

<div class="leftcol">
<div class="add_tax_form_div" >
	<div id="addCmfForm" >
	
	<h3><?php _e("Add Meta Field","UWPQSF");?></h3>
	<p><span><b><?php _e("Meta Key","UWPQSF");?></b></span><br>
	<select type="text" id="precmfkey" name="prekey"><br>
	<?php
	$classapi = new uwpqsfclass();	
	$keys = $classapi->get_all_metakeys();
	echo '<option value="">'.__("Choose a meta key","UWPQSF").'</option>';	
		foreach($keys as $key){
			
			 echo  '<option value="'.$key.'">'.$key.'</option>';
		}
	?>	
	</select>
	</p>
	
	<p><span><b><?php _e("Label","UWPQSF");?></b></span><br>
	<input type="text" id="precmflabel" name="precmflabel" value=""/><br>	
	<span class="desciption"><?php _e(" To be displayed in the search form", "UWPQSF");?></span>	
	</p>
	
	<p><span><b><?php _e("Text For 'Search All' Options","UWPQSF");?></b></span><br>
	<input type="text" id="precmfall" name="precmfall" value=""/><br>
	<span class="desciption"><?php _e(" eg, All prices, All weight", "UWPQSF") ;?></span>
	</p>
	
	<p><span><b><?php _e("Compare","UWPQSF");?></b></span><br>
	<select id="precompare" name="precompare">
	<?php 
		$campares = $classapi->cmf_compare();
		foreach ($campares   as $ckey => $cvalue ) {
			echo '<option value="'.$ckey.'">'.$cvalue.'</option>';
	     }
	?>
	</select><br>
	<span class="desciption"><?php _e("Operator to test. Use it carefully. If you choose 'BETWEEN', then your options should be range." , "UWPQSF") ;?></span><br>
	<?php $link = 'http://wordpress.stackexchange.com/questions/70864/meta-query-compare-operator-explanation/70870#70870';
	echo '<span class="desciption">'.sprintf(__("More about compare, please visit <a href='%s' target='_blank'>here</a>", "UWPQSF"), $link ).'</span>';
	;?>
	<?php do_action( 'uwpsf_cmfcompare_desc'); ?>
	</p>

	<p>
	<span><b><?php _e("Display Type?","UWPQSF");?></b></span><br>
	<?php
		$feilds = 	$classapi->ucmf_display();
		foreach ($feilds as $v => $k){
			echo '<label><input type="radio" id="pretype" name="cmfdisplay" value="'.$v.'"   />';
			printf( __( '%s', 'UWPQSF' ), $k);
			echo '</label>';
			}
	?>
	<br/>
	<span class="generate"><?php _e('* Warning! Checkbox only work with "IN" and "NOT IN" compare operator.','UWPQSF') ;?> </span>	
	<br>
	<?php do_action( 'uwpsf_cmfdispaly_desc'); ?>	
	</span>
	</p>
	
	<p><span><b><?php _e("Dropdown Options","UWPQSF");?></b>:</span><br>
	<span class="desciption"><?php _e("Your options should defined in xxx::xxx and each option is separated by '|' .<br> The left value in option xxx::xxx is the <b>real meta value</b>, and the right value is for <b>user viewed value</b>. <br>eg. 100::$100, 2000::$2,000" , "UWPQSF") ;?></span><br>
	<textarea  id="preopt" name="preopt" rows="5" cols="55"></textarea><br><input type="button" class="genv" value="<?php _e('Generate Value','UWPQSF') ;?>">
	<span class="generate"><?php _e('Based on the meta key selected above','UWPQSF') ;?> </span><br>	
	<span class="desciption"><?php _e("eg: for normal options set 100::$100 | 200::$200 | 100::$300...etc" , "UWPQSF") ;?></span><br>
	<span class="desciption"><?php _e("eg: for range option 1-100::$1 - $100 | 101-200 :: $101 - $200 | 201-300 :: $201 - $300...etc" , "UWPQSF") ;?></span>
	<?php do_action( 'uwpsf_cmfoption_desc'); ?>
	</p>
	
	<?php do_action('uwpqsfcmf_form_add') ;?>
		
	<input type="button" value="<?php _e("Add Custom Field","UWPQSF");?>" class="adduCmf button-secondary" />
	</div>
</div>
</div>

<div class="rightcol">
	<h3><?php _e("Meta Fields","UWPQSF");?></h3>
<?php
	$bool = get_post_meta($post_id, 'uwpqsf-option', true);
	$items = array("AND", "OR");
	echo '<span>'.__("Boolean relationship between the meta queries :", "UWPQSF").'</span>';
	foreach($items as $item) {
		
		$checked = !empty($bool[0]['cmf']) && ($bool[0]['cmf']==$item) ? 'checked="checked"' : '';
		echo '<label><input id = "cmfrel" '.$checked.' value="'.$item.'" name="uwpname[rel][0][cmf]" type="radio" />'.$item.'</label>';
	}	
	
		echo '<br><span class="desciption">'.__("<b>AND</b> - Must meet all meta field search.","UWPQSF").'</span>';echo '&nbsp;&nbsp;';
		echo '<span class="desciption">'.__("<b>OR</b> - Either one of the meta field search is meet.","UWPQSF").'</span>';
				
?>
	<div class="cmfbox">
	 <?php
	  
	   $cmf = get_post_meta($post_id, 'uwpqsf-cmf', true);
	   $campares = $classapi->cmf_compare();	
	   $c =0; 	
	   if(!empty($cmf)){	

	echo '<span class="drag">'.__("*Drag and Drop to reorder your table row. The table row order indicates the order of the search form fields in the frontend. ","UWPQSF").'</span>';

	      foreach($cmf as $k => $v){
		echo '<div id="dragbox"><h3><div class="toggle2 plus"></div>'.$v['label'].'<a href="" class="removediv">Remove</a></h3>';
		echo '<div class="cmfdragbox"  style="display:none">';
		echo '<input type="hidden" id="cmfcounter" value='.$c.'>';	
		//meta key
		echo '<p><span><b>'.__("Meta Key","UWPQSF").'</b></span><br>';
		    $keys = $classapi->get_all_metakeys();
		echo '<select id="cmfkey" name="uwpname[cmf]['.$c.'][metakey]">';
		    foreach($keys as $key){
			 $selected = ($v['metakey']==$key) ? 'selected="selected"' : '';	
			 echo '<option value="'.$key.'" '.$selected.'>'.$key.'</option>';		
			}	
		echo '</select>';
		echo '</p>';
		//for Label
		echo '<p><span><b>'.__("Label","UWPQSF").'</b></span><br>';
		echo '<input type="text" id="cmflabel" name="uwpname[cmf]['.$c.'][label]" value="'.sanitize_text_field($v['label']).'"/>';
		echo '</p>';
		//search all text
		echo '<p><span><b>'.__("Text For 'Search All' Options","UWPQSF").'</b></span><br>';
		echo '<input type="text" id="cmfalltext" name="uwpname[cmf]['.$c.'][all]" value="'.sanitize_text_field($v['all']).'"/>';
		echo '</p>';
		//for compare
		echo '<p><span><b>'.__("Compare","UWPQSF").'</b></span><br>';
		echo '<select id="cmfcom" name="uwpname[cmf]['.$c.'][compare]">';
		  foreach ($campares  as $ckey => $cvalue ) {
			$selected = ($v['compare']==$ckey) ? 'selected="selected"' : '';	
		echo '<option value="'.$ckey.'" '.$selected.'>'.$cvalue.'</option>';}
		echo '</select>';
		echo '</p>';
		//for Display type
		echo '<p><span><b>'.__("Display Type?","UWPQSF").'</b></span><br>';
		$ftypes = $classapi->ucmf_display();
		  foreach($ftypes as $mv  => $mk ){
			$checked = ($v['type']== $mv) ?  'checked="checked"' : '';
		echo '<label><input type="radio" id="taxtype" name="uwpname[cmf]['.$c.'][type]" value="'. $mv.'" '.$checked.' />'.sprintf(__('%s', 'UWPQSF'),$mk).'</label><br>';      }
		echo '</p>';
		//for options
		echo '<p><span><b>'.__("Dropdown Options:","UWPQSF").'</b></span><br>';
		echo '<textarea id="cmflabel" name="uwpname[cmf]['.$c.'][opt]" >'.esc_html($v['opt']).'</textarea>';
		echo '</p>';
		$chook = do_action('uwpqsfcmf_form_main',$v);			
		echo  $chook;	
		echo '</div></div>';$c++;
	      }	//end foreach
		
	  }//end cmf	
	 ?>	
	</div><!--end cmfbox-->
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
