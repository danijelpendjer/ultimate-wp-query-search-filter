<div class="cbox">
<h3><?php echo esc_html( __( 'Search Template', 'UWPQSF' ) ); ?></h3>
<div class="fullwide">
<?php 
$ajax = !empty($options[0]['method']) && (sanitize_text_field($options[0]['method']) == '1') ? 'checked="checked"' : null;
$ori = !empty($options[0]['method']) && (sanitize_text_field($options[0]['method']) == '2') ? 'checked="checked"' : null;
$ajaxdiv = !empty($options[0]['div']) ? sanitize_text_field($options[0]['div']) : ''; 
$disbaled = (!empty($options[0]['method']) && $options[0]['method'] == '1') ? '' : 'disabled="disabled" class="inactive"';
?>
<ul>
<li><label><input <?php echo $ori ;?>  id= "ajaxckc" name="uwpname[rel][0][method]" type="radio" value="2" /></label><?php _e("Default Search Template","UWPQSF") ;?></li>
<li>
   <label><input <?php echo $ajax ;?>  id= "ajaxckc" name="uwpname[rel][0][method]" type="radio" value="1" /></label><?php _e("Ajax - Result displayed on same page","UWPQSF") ;?>
     <ul>
       <li><label><?php _e("Div to display result","UWPQSF") ;?> :</label> <input type="text" id="resdiv" name="uwpname[rel][0][div]" value="<?php echo $ajaxdiv;?>" <?php echo $disbaled ;?>/>
      <b><?php _e("For Ajax only","UWPQSF");?></b></li>
       <li><span class="desciption"><?php _e("The Div id/class of where you want the result to display. eg. #content, .content (<b>Must have the '#' or '.' in front of the div name!</b>)","UWPQSF");?></span>
       </li>
    </ul>
</li>
</ul>
</div>
</div>
