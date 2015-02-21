<?php

function upload_styles() {
	wp_enqueue_style('admin-styles',get_template_directory_uri().'/admin/assets/css/metabox-options.css','','','all');	
}
add_action('admin_print_styles', 'upload_styles'); 

add_action( 'init', 'register_reviews_post_type' );

function register_reviews_post_type() {
	register_post_type( 'reviews',
		array(
			'labels' => array(
				'name' => __( 'Reviews', 'crumble' ),
				'singular_name' =>  __( 'Review', 'crumble' ),
				'add_new' =>  __( 'Add New', 'crumble' ),
				'add_new_item' =>  __( 'Add New Review', 'crumble' ),
				'edit' =>  __( 'Edit', 'crumble' ),
				'edit_item' =>  __( 'Edit Review', 'crumble' ),
				'new_item' =>  __( 'New Review', 'crumble' ),
				'view' =>  __( 'View Review', 'crumble' ),
				'view_item' =>  __( 'View Review', 'crumble' ),
				'search_items' =>  __( 'Search Reviews', 'crumble' ),
				'not_found' =>  __( 'No reviews found', 'crumble' ),
				'not_found_in_trash' =>  __( 'No reviews found in Trash', 'crumble' ),
				'parent' =>  __( 'Parent Review', 'crumble' ),
			),
			'public' => true,
			'show_ui' => true,
			'has_archive' => true,
			'publicly_queryable' => true,
			'show_in_nav_menus' => false,
			'exclude_from_search' => false,
			'hierarchical' => false,
            'rewrite' => array('slug'=>'review'),
			'supports' => array('title', 'editor', 'thumbnail', 'comments', 'author' ),
		)
	);

}

add_action( 'init', 'create_review_category', 0 );

function create_review_category() 
{

  $labels = array(
    'name' => _x( 'Review Categories', 'taxonomy general name', 'crumble' ),
    'singular_name' => _x( 'Review Category', 'taxonomy singular name', 'crumble' ),
    'search_items' =>   __( 'Search Review Categories', 'crumble' ),
    'all_items' =>  __( 'All Review Categories', 'crumble' ),
    'parent_item' =>  __( 'Parent Review Category', 'crumble' ),
    'parent_item_colon' =>  __( 'Parent Review Category:', 'crumble' ),
    'edit_item' =>  __( 'Edit Review Category', 'crumble' ), 
    'update_item' =>  __( 'Update Review Category', 'crumble' ),
    'add_new_item' =>  __( 'Add New Review Category', 'crumble' ),
    'new_item_name' =>  __( 'New Review Category Name', 'crumble' ),
    'menu_name' =>  __( 'Categories', 'crumble' ),
  ); 	

  register_taxonomy('review_category',array('reviews'), array(
	'public' => true,
	'show_in_nav_menus' => true,
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
  ));

}


function add_custom_meta_box() {  
    add_meta_box(  
        'custom_meta_box', // $id  
        'Review Scores', // $title  
        'show_custom_meta_box', // $callback  
        'reviews', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_custom_meta_box');

$use_review = array(
						array(
							'label' => 'Enable Review Score',
							'value' => 'true'
						),
					array(
							'label' => 'Disable Review Score',
							'value' => 'false'
						),
						
);

$review_score = array (
						array (
							'label' => '0',
							'value' => '0'
						),
						array (
							'label' => '0.5',
							'value' => '0.5'
						),
						array (
							'label' => '1',
							'value' => '1'
						),
						array (
							'label' => '1.5',
							'value' => '1.5'
						),
						array (
							'label' => '2',
							'value' => '2'
						),
						array (
							'label' => '2.5',
							'value' => '2.5'
						),
						array (
							'label' => '3',
							'value' => '3'
						),
						array (
							'label' => '3.5',
							'value' => '3.5'
						),
						array (
							'label' => '4',
							'value' => '4'
						),
						array (
							'label' => '4.5',
							'value' => '4.5'
						),
						array (
							'label' => '5',
							'value' => '5'
						),
						
	
						
				);
					

 
    $prefix = 'crumble';  
    $custom_meta_fields = array(  


        array(  
            'label'=> __( 'Use Review Score' , 'crumble' ),
            'desc'  => '',  
            'id'    => $prefix.'_mb_use_review',  
            'type'  => 'select',
            'show' => 'true',
            'options' => $use_review
        ),  


        array(  
            'label'=> __( 'OWN CRITERIAS' , 'crumble' ),  
            'desc'  => '',  
            'id'    => $prefix.'_mb_head_criterias',  
            'type'  => 'additional'  
        ),

        array(  
            'label'=> __( 'Name for Criteria #1', 'crumble' ),  
            'desc'  => __( 'Type name for Criteria #1', 'crumble' ), 
            'id'    => $prefix.'_mb_criteria1_name',  
            'show' => 'true',
            'type'  => 'text',
        ), 

    	
        array(  
            'label'=> __( 'Review Criteria #1' , 'crumble' ),
            'desc'  => '',  
            'id'    => $prefix.'_mb_criteria1',  
            'type'  => 'select',
            'show' => 'true',
            'options' => $review_score
        ),  


        array(  
            'label'=> __( 'Name for Criteria #2', 'crumble' ),  
            'desc'  => __( 'Type name for Criteria #2', 'crumble' ), 
            'id'    => $prefix.'_mb_criteria2_name',  
            'show' => 'true',
            'type'  => 'text',
        ), 

        array(  
            'label'=> __( 'Review Criteria #2' , 'crumble'),
            'desc'  => '',  
            'id'    => $prefix.'_mb_criteria2',  
            'type'  => 'select',
            'show' => 'true',
            'options' => $review_score
        ),  


        array(  
            'label'=> __( 'Name for Criteria #3', 'crumble' ),  
            'desc'  => __( 'Type name for Criteria #3', 'crumble' ),  
            'std'  => 'Criteria #3',
            'id'    => $prefix.'_mb_criteria3_name',  
            'show' => 'true',
            'type'  => 'text',
        ), 
        	
        array(  
            'label'=> __( 'Review Criteria #3' , 'crumble'),
            'desc'  => '',  
            'id'    => $prefix.'_mb_criteria3',  
            'type'  => 'select',
            'show' => 'true',
            'options' => $review_score
        ),  

        array(  
            'label'=> __( 'Name for Criteria #4', 'crumble' ),  
            'desc'  => __( 'Type name for Criteria #4', 'crumble' ),  
            'std'  => 'Criteria #4',
            'id'    => $prefix.'_mb_criteria4_name',  
            'show' => 'true',
            'type'  => 'text',
        ), 
        
        array(  
            'label'=> __( 'Review Criteria #4' , 'crumble'),
            'desc'  => '',  
            'id'    => $prefix.'_mb_criteria4',  
            'type'  => 'select',
            'show' => 'true',
            'options' => $review_score
        ),  


        array(  
            'label'=> __( 'Name for Criteria #5', 'crumble' ),  
            'desc'  => __( 'Type name for Criteria #5', 'crumble' ),  
            'std'  => 'Criteria #5',
            'id'    => $prefix.'_mb_criteria5_name',  
            'show' => 'true',
            'type'  => 'text',
        ), 
        
        array(  
            'label'=> __( 'Review Criteria #5' , 'crumble'),
            'desc'  => '',  
            'id'    => $prefix.'_mb_criteria5',  
            'type'  => 'select',
            'show' => 'true',
            'options' => $review_score
        ),  


        array(  
            'label'=> __( 'OVERALL SCORE', 'crumble' ),  
            'desc'  => '',  
            'id'    => $prefix.'_mb_head',  
            'type'  => 'additional'  
        ),

        array(  
            'label'=> __( 'Name for Overall Score', 'crumble' ),  
            'desc'  => __( 'Type name for Overall Score', 'crumble' ),  
            'std' => 'Overall Score',
            'id'    => $prefix.'_mb_overall_name',  
            'show' => 'true',
            'type'  => 'text',
        ), 

        
      

     


        	
  );  
	
	
	
	function show_custom_meta_box() {  
		global $custom_meta_fields, $post;  

		echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  			

	    echo '<div id="meta-options" class="form-table clearfix" style="margin-bottom: 20px; min-height: 220px; padding-bottom:20px;">';  

	    foreach ($custom_meta_fields as $field) {  
	    
	        $meta = get_post_meta($post->ID, $field['id'], true);  

	       
	        echo ' 
                <div style="margin-left: 20px">';  
                switch($field['type']) {  
                        // text  
					    case 'text':  
					    	if ( $field['show'] == 'false' ) echo '<div class="hidden-field">'; 
					    	if ( $field['show'] == 'true' ) echo '<div class="showed-field">'; 
					    
							echo '<span class="description">'.$field['label'].'</span>';					    
					        echo '<input type="text"  name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" class="custom-text" />'; 
					    echo '</div>';				              
					    break;  
	
					    // textarea  
					    case 'textarea':  
					    	echo '<div class="clear"></div>';
					    	echo '<span class="description">'.$field['label'].'</span>';
					        echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>'; 
					    break;  

					    // info box  
					    case 'info-box': 	
					    	echo '<div class="clear"></div>'; 
					        echo '<div class="info_box">'.$field['desc'].'</div>';  
					    break;  
		
					    // checkbox  
					    case 'checkbox':  					    
						    echo '<div class="clear"></div>'; 
					        echo '<div class="check-hide"><input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/> 
				            <label for="'.$field['id'].'">'.$field['label'].'</label></div>'; 
				            echo '<div style="margin-bottom: 30px"></div>';
					    break;  
	
					    // select  
					    case 'select':
					    	if ( $field['show'] == 'false' ) echo '<div class="hidden-field">'; 
					    	if ( $field['show'] == 'true' ) echo '<div class="showed-field">'; 
					    						    	
					    	echo '<span class="description">'.$field['label'].'</span>';  
					        echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';  

					        foreach ($field['options'] as $option) {  
					            echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
				        }  
					    echo '</select>';  
					    echo '</div>';
					    break;  	
					    
					    //upload
					    case 'upload':
					    echo '<div class="clear"></div>';
								echo '<div class="upload-box clearfix">';
						    		echo '<span class="description">'.$field['label'].'</span>';  
									echo '<input id="upload_image" type="text" size="90" name="extra[' . $field[id] . ']" value="'. $meta .'" />';
									echo '<input class="upload_image_button" type="button" value="Upload" />';
  	   								echo '<input type="hidden" name="extra_fields_nonce" value="'. wp_create_nonce(__FILE__) . '" />';
  	   							echo '</div>';
					    
					    break;
					    
					    case 'additional':
					    	echo '<div class="clear"></div>';
					    	echo '<div style="border-top: 1px dashed #ccc;border-bottom: 1px dashed #ccc; padding: 15px 0; margin-bottom: 15px; height:40px; width:90%"><span class="description">' . $field['label'] . ' </span></div>';
					    break;
	
                } //end switch  
    		    echo '</div>';  
    		} // end foreach  
    		
    echo '</div>'; // end table
    echo '<input id="original_publish" type="hidden" value="Save" name="original_publish">';
	echo '<input id="publish" class="button-save" type="submit" value="Save" accesskey="p" tabindex="5" name="save">';  

    echo '<div class="clear"></div>';
}  



function save_custom_meta($post_id) {  
    
    global $custom_meta_fields;  
  
    // verify nonce  
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))  
        return $post_id;  
    
    // check autosave  
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    
    // check permissions  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
  


    // loop through fields and save the data  
    foreach ($custom_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
    
	    if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
    
    
/*      	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) )
			continue delete_post_meta($post_id, $key); 
		
		update_post_meta($post_id, $key, $value); 
		
		
	}*/
	return $post_id;

}  
add_action('save_post', 'save_custom_meta'); 





?>