<?php
if ( ! defined( 'ABSPATH' ) )
die( '-1' );
$addlink = add_query_arg(array('uformid' => 'new', 'uformaction' => 'new'), UADDFORMURL);
?>
<div class="wrap"><div id="icon-options-general" class="icon32"></div><h2><?php echo esc_html( __( 'Ultimate WP Query Search Filter', 'UWPQSF' ) ); ?><a href="<?php echo $addlink;?>" class="add-new-h2"> <?php echo esc_html( __( 'Add New Search Form', 'UWPQSF' ) ); ?></a></h2>

<?php
if(isset($_GET['status']) && $_GET['status'] == 'updated' && isset($_GET['uformid'])  && absint($_GET['uformid']) ){
	echo '<div class="updated"><p>'.__("Form Updated", "UWPQSF"),'</p></div>';
}
?>

<?php 

$postid = isset($_GET['uformid']) && absint($_GET['uformid'])  ? esc_attr($_GET['uformid']) : '';
if(isset($postid) && absint($postid)){
echo '<div class="showcode"><h2>'."[ULWPQSF id=$postid]".'</h2>'.esc_html( __( 'Copy this code and paste it into your post, page or text widget content.', 'UWPQSF' ) ).'<br>'.__("Available shortcode parameters:","").' <span class="sparam" title="0 = hide (default show)"><b>formtitle</b></span> , <span class="sparam" title="0 = hide (default show)"><b>button</b> </span>, <span class="sparam" title="default null"><b>divclass</b></span> </div>';
}
$options = get_post_meta($postid, 'uwpqsf-option', true);
?>
<br>
<form method="post" action="" id="uwpqsf_main">

<?php 
$nonce = wp_create_nonce  ('ultimate-wpqsf-edit');
$formid = !empty($postid) ? $postid : "new";
echo '<input type="hidden" name="uformid" value="'.$formid.'" ><input type="hidden" name="nonce" value="'.$nonce.'" />'
;?>
<div class="cbox">
<b><?php _e('Form Title','UWPQSF'); ?> </b>: <input type="text" class="form_title" name="ftitle" value="<?php echo get_the_title($postid); ?> ">
</div>
<?php require_once UWPQSFBASE . '/admin/fields/formmethod.php'; ?>
<?php require_once UWPQSFBASE . '/admin/fields/post_type.php'; ?>
<?php require_once UWPQSFBASE . '/admin/fields/taxonomy.php'; ?>
<?php do_action( 'uwpqsf_after_taxo_adminform', $postid ); ?> 
<?php require_once UWPQSFBASE . '/admin/fields/meta_field.php'; ?>
<?php do_action( 'uwpqsf_after_cmf_adminform', $postid ); ?> 
<?php require_once UWPQSFBASE . '/admin/fields/misc.php'; ?>
<?php require_once UWPQSFBASE . '/admin/fields/themeoption.php'; ?>

<input type="submit" class="button-primary" name="uwpqsfsub" value="Save" >


</form>
<div class="bottom">
<div class="donate"><?php echo __("If you like my works/efforts don't forget to donate to support further development. Thanks! ", "UWPQSF") ;?>  <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=MFTQ5VDWY2Z9Q"><img src="https://www.paypal.com/en_US/i/btn/x-click-but21.gif" alt="" /></a></div>
<div class="credit">Developed By TC.K From <a href="http://www.9-sec.com" target="_blank">9-SEC.COM</a> </div>
</div>

</div>
