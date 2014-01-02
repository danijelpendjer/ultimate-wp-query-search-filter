<div class="cbox">
<h3><?php echo esc_html( __( 'Post Type', 'UWPQSF' ) ); ?></h3>
<div class="fullwide">

<?php

	  echo '<label>'.__("Choose the post type you want to include in the search","UWPQSF").'</label><br>';
			$post_types=get_post_types('','names'); 
			unset($post_types['revision']); unset($post_types['attachment']);unset($post_types['nav_menu_item']);unset($post_types['jaxwpsf']);
			$post_id = isset($_GET['uformid']) ? $_GET['uformid'] : null;
			
			$oldcpts = get_post_meta($post_id, 'uwpqsf-cpt', true);
			
			foreach($post_types as $post_type ) {
			    $checked = null;		
			   
			    if(!empty($oldcpts)){
				  foreach ($oldcpts as $checkedtyped)
				   {
					if($checkedtyped == $post_type)  $checked = 'checked="checked"';   
				   }
			     }
			  
			  
	echo '<div class="cpt_div"><label><input '.$checked.' id="cpt" name="uwpname[cpt][]" type="checkbox" value="'.$post_type.'" />'.$post_type.'</label></div>';
			
			}
	echo '<div class="clear"></div>';	
?>
</div>
</div>

