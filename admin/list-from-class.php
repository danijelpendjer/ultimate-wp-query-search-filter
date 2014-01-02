<?php
if( ! class_exists( 'Custom_List_Table' ) ) {
    require_once UWPQSFBASE . '/admin/class-list-table.php';
}

class Uwpqsf_Table extends Custom_List_Table {

	function getallposts() {	  
		   $items =array();
		   $args = array(
		   'numberposts'     => -1,
		   'offset'          => 0,
		   'orderby'         => 'post_date',
		   'post_type'       => 'uwpqsf',
		   'post_status'     => 'publish' );
			$formposts = get_posts( $args );
		   if($formposts == null) {$formitems = null;}
			else{
				foreach ($formposts as $post) {
					$user_info = get_userdata($post->post_author);
					$shortcode = '[ULWPQSF id='.$post->ID.']';	
					
					$formitems[] =array (
							'form_title' => $post->post_title,
							'ID'	=> $post->ID,
							'shortcode'=>$shortcode, 
							'post_author'=> $user_info->user_login,
							'post_date' => $post->post_date
					);
				
				}
		  }	
		return $formitems;
	}
			
		
    function __construct(){
		global $status, $page;

        parent::__construct( array(
            'singular'  => __( 'Form', 'UWPQSF' ),    
            'plural'    => __( 'Forms', 'UWPQSF' ),  
            'ajax'      => true       

		) );

		add_action( 'admin_head', array( &$this, 'admin_header' ) );            

    }


  function no_items() {
    _e( 'No Ultimate WP Query Search Filter Form found, please add a new form now.', 'UWPQSF' );
  }

  function column_default( $item, $column_name ) {
     switch( $column_name ) { 
            case 'form_title':
            case 'shortcode':
            case 'post_author':
            case 'post_date':
            return $item[ $column_name ];
        default:
            return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }

	function get_sortable_columns() {
	  $sortable_columns = array(
	   'form_title'  => array('Title',true),
	   );
	  return $sortable_columns;
	}

	function get_columns(){
		   $columns = array(
				'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
				'form_title'     => 'Form Title',
				'shortcode'    => 'Shortcode',
				'post_author'  => 'Author',
				'post_date'  => 'Created On'            
			);
			return $columns;
    }



	function column_form_title($item){
	  $actions = array(
			'edit'      => '<a href="'.admin_url('admin.php?page=uwpqsfform&uformid='.$item['ID'].'&uformaction=edit').'">'.__('Edit', 'UWPQSF').'</a>',
			'trash'    => '<a href="'.get_delete_post_link( $item['ID'], '', true ).'">'.__('Delete', 'UWPQSF').'</a>',
			 );

	  return sprintf('%1$s %2$s', $item['form_title'], $this->row_actions($actions) );
	}

	function get_bulk_actions() {
	  $actions = array(
		'delete'    => __( 'Delete' ,'UWPQSF')
	  );
	  return $actions;
	}

	function column_cb($item) {
			return sprintf(
				'<input type="checkbox" name="formbulk[]" value="%s" />', $item['ID']
			);    
     }

	function process_bulk_action() {      
		if(isset($_REQUEST['formbulk']))  {
		  $entry_id = ( is_array( $_REQUEST['formbulk'] ) ) ? $_REQUEST['formbulk'] : array( $_REQUEST['formbulk'] );

			if ( 'delete' === $this->current_action() ) {
			 global $wpdb;

			 foreach ( $entry_id as $id ) {
				   $id = absint( $id );
				  wp_delete_post( $id, true );
				}
		 }}
	}

	function prepare_items() {
	  $columns  = $this->get_columns();
	  $hidden   = array();
	  $sortable = $this->get_sortable_columns();
	  $this->_column_headers = array( $columns, $hidden, $sortable );
	  $this->process_bulk_action();
	  $per_page = 15;
	  if($this->getallposts() != null){
	  $current_page = $this->get_pagenum();
	  $total_items = count( $this->getallposts() );
	  $this->found_data = array_slice($this->getallposts(),(($current_page-1)*$per_page),$per_page);
	  $this->set_pagination_args( array(
			'total_items' => $total_items,                  //WE have to calculate the total number of items
			'per_page'    => $per_page                     //WE have to determine how many items to show on a page
			  ) );
	   $this->items = $this->found_data;}
	 
	}
	
}// end class


?>
