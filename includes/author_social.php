<?php


add_action('show_user_profile', 'wpsplash_extraProfileFields');
add_action('edit_user_profile', 'wpsplash_extraProfileFields');
add_action('personal_options_update', 'wpsplash_saveExtraProfileFields');
add_action('edit_user_profile_update', 'wpsplash_saveExtraProfileFields');

function wpsplash_saveExtraProfileFields($userID) {

	if (!current_user_can('edit_user', $userID)) {
		return false;
	}

	update_user_meta($userID, 'twitter', $_POST['twitter']);
	update_user_meta($userID, 'google_plus', $_POST['google_plus']);
	update_user_meta($userID, 'flickr', $_POST['flickr']);
	update_user_meta($userID, 'facebook', $_POST['facebook']);
}

function wpsplash_extraProfileFields($user)
{
?>
	<h3>Social User Information</h3>

	<table class='form-table'>
		<tr>
			<th><?php _e( 'Twitter Service:' , 'crumble' ); ?></th>
			<td>
				<input type='text' name='twitter' id='twitter' value='<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'><?php _e( 'Please enter your Twitter username.' , 'crumble' ); ?></span>
			</td>
		</tr>
		<tr>
			<th><?php _e( 'Facebook Service:' , 'crumble' ); ?></th>
			<td>
				<input type='text' name='facebook' id='facebook' value='<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'><?php _e( 'Please enter your Facebook username.' , 'crumble' ); ?></span>
			</td>
		</tr>
		<tr>
			<th><?php _e( 'Google Plus Service:' , 'crumble' ); ?></th>
			<td>
				<input type='text' name='google_plus' id='google_plus' value='<?php echo esc_attr(get_the_author_meta('google_plus', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'><?php _e( 'Please enter your Google Plus username.' , 'crumble' ); ?></span>
			</td>
		</tr>
		<tr>
			<th><?php _e( 'Flickr Service:' , 'crumble' ); ?></th>
			<td>
				<input type='text' name='flickr' id='flickr' value='<?php echo esc_attr(get_the_author_meta('flickr', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'><?php _e( 'Please enter your Flickr username.' , 'crumble' ); ?></span>
			</td>
		</tr>
	</table>
<?php } ?>