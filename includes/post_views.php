<?php 


function getPostViews( $postID ){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.' views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);

    if( $count=='' ) {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);

function posts_column_views($defaults){
    $defaults['post_views'] = __( 'Views' , 'crumble' );
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
    if( $column_name === 'post_views' ) {
        echo getPostViews( get_the_ID() );
    }
}



function add_custom_post_meta_box() {  
    add_meta_box(  
        'custom_post_meta_box', // $id  
        'Parameters for Selected Post Format', // $title  
        'show_custom_post_meta_box', // $callback  
        'post', // $page  
        'normal', // $context  
        'high'); // $priority  
}  
add_action('add_meta_boxes', 'add_custom_post_meta_box');

					
$video_type = array (
					array(
						'label' => 'Vimeo',
						'value' => 'vimeo'
					),

					array(
						'label' => 'Youtube',
						'value' => 'youtube'
					),

					array(
						'label' => 'Dialymotion',
						'value' => 'dialymotion'
					),
		
				);


    // Field Array  
    $prefix = 'crumble';  
    $custom_post_meta_fields = array(  

           array(  
            'label'=> 'Upload Images for Gallery Post Format',  
            'desc'  => 'Upload three images and save data.',  
            'id'    => $prefix.'_mb_video_info_box',  
            'type'  => 'info-box',
        ), 
        

             array(  
            'label'=> 'Image #1 Upload',  
            'desc'  => '',  
            'id'    => $prefix.'_mb_image1_upload',  
            'type'  => 'upload',
        ), 

             array(  
            'label'=> 'Image #2 Upload',  
            'desc'  => '',  
            'id'    => $prefix.'_mb_image2_upload',  
            'type'  => 'upload',
        ), 

             array(  
            'label'=> 'Image #3 Upload',  
            'desc'  => '',  
            'id'    => $prefix.'_mb_image3_upload',  
            'type'  => 'upload',
        ), 

           array(  
            'label'=> 'Video Post Format',  
            'desc'  => 'Add video ID from Vimeo or Youtube. Examples: vimeo - 29017795 / youtube - WhBoR_tgXCI',  
            'id'    => $prefix.'_mb_video_info_box',  
            'type'  => 'info-box',
        ), 
        

        array(  
            'label'=> 'Video Type',  
            'desc'  => '',
            'id'    => $prefix.'_mb_post_video_type',  
            'type'  => 'select',
            'show' => 'true',
            'options' => $video_type  
        ),  
        array(  
            'label'=> 'Video ID',  
            'desc'  => '',  
            'id'    => $prefix.'_mb_post_video_file',  
            'show' => 'true',
            'type'  => 'text',
        ), 

           array(  
            'label'=> 'Audio Format',  
            'desc'  => 'Paste code from soundcloud service',  
            'id'    => $prefix.'_mb_audio_info_box',  
            'type'  => 'info-box',
        ), 
        array(  
            'label'=> 'Sound Cloud',  
            'desc'  => '',  
            'id'    => $prefix.'_mb_post_soundcloud',  
            'show' => 'true',
            'type'  => 'textarea',
        ), 

        	
  );  
	
	
	
	// The Callback  
	function show_custom_post_meta_box() {  
		global $custom_post_meta_fields, $post;  
		
		
		
		// Use nonce for verification  
		echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  			
  
	    // Begin the field table and loop  
	    echo '<div id="meta-options" class="form-table clearfix" style="margin-bottom: 20px; min-height: 220px; padding-bottom:20px;">';  

	    foreach ($custom_post_meta_fields as $field) {  
	        // get value of this field if it exists for this post  
	        $meta = get_post_meta($post->ID, $field['id'], true);  

	        // begin a table row with  
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
				            echo '<span class="description">'.$field['label'].'</span>';  
					        echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>'; 

					    break;  

					    // info box  
					    case 'info-box': 	
					    	echo '<div class="clear"></div>'; 					    	
					        echo '<div class="info_box"><h4 style="margin-top:0; padding-top:0; margin-bottom: 10px; padding-bottom: 0">'.$field['label'].'</h4>'.$field['desc'].'</div>';  
					    	echo '<div class="clear"></div>'; 					    						        
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
									echo '<input id="upload_image" type="text" size="90" name="extra[' . $field['id'] . ']" value="'. $meta .'" />';
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



function save_custom_post_meta($post_id) {  
    
    global $custom_post_meta_fields;  
  
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
    foreach ($custom_post_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
    
	    if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
    
    
      	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) )
			delete_post_meta($post_id, $key); 
		
		update_post_meta($post_id, $key, $value); 
		
		
	}
	return $post_id;

}  
add_action('save_post', 'save_custom_post_meta'); 


