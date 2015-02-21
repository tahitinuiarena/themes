<?php
/*
Plugin Name: SoundCloud Shortcode
Plugin URI: http://www.soundcloud.com
Description: SoundCloud Shortcode. Usage in your posts: [soundcloud]http://soundcloud.com/TRACK_PERMALINK[/soundcloud] . Works also with set or group instead of track. You can provide optional parameters height/width/params as follows [soundcloud height="166" params="auto_play=true"]http....
Version: 2.0
Author: Johannes Wagener <johannes@soundcloud.com>
Author URI: http://johannes.wagener.cc
*/

/*
SoundCloud Shortcode (Wordpress Plugin)
Copyright (C) 2009 Johannes Wagener
Options support added by Tiffany Conroy <tif@tif.ca>

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

add_shortcode( "soundcloud", "crumble_soundcloud_shortcode" );

function crumble_soundcloud_shortcode($attributes, $content=null) {
  return crumble_SoundcloudShortcode::parse($attributes, $content);
}

class crumble_SoundcloudShortcode {

  const IFRAME_HEIGHT           = '166';
  const IFRAME_TRACKLIST_HEIGHT = '450';
  const IFRAME_WIDTH            = '100%';

  const FLASH_HEIGHT            = '81';
  const FLASH_TRACKLIST_HEIGHT  = '255';
  const FLASH_WIDTH             = '100%';

  // set to true when we deprecate the flash player
  const DEFAULT_TO_IFRAME       = false;

  public function parse($attributes, $content=null) {

    extract(shortcode_atts(array(
      'url' => $content,
      'iframe' => self::getDefaultIframePreference(),
      'params' => self::getDefaultQuery(),
      'height' => '',
      'width'  => ''
    ), $attributes));

    $iframe = self::booleanize($iframe);

    // The HTML5 widget doesn't support http://soundcloud.com/<username>
    // style urls yet. So we force the old Flash widget for now.
    if (self::isLegacyURL($url)) {
      $iframe = false;
    }

    $type = self::getType($url);
    $width = self::getWidth($width, $iframe, $type);
    $height = self::getHeight($height, $iframe, $type);

    return self::getHTML($url, $iframe, $params, $width, $height);
  }

  public function getDefaultQuery() {
    $options = array(
      'auto_play',
      'show_comments',
      'color',
      'theme_color'
    );
    $params = array();
    foreach ($options as &$option) {
      $value = get_option('soundcloud_' . $option, '');
      if (!empty($value)) {
        $params[$option] = $value;
      }
    }
    return http_build_query($params);
  }

  public function getDefaultIframePreference() {
    $pref = get_option('soundcloud_player_iframe');
    return ($pref === '') ? DEFAULT_TO_IFRAME : self::booleanize($pref);
  }

  private function booleanize($value) {
    if ($value && strtolower($value) !== "false") {
      return true;
    } else {
      return false;
    }
  }

  private function isLegacyURL($url) {
    return !preg_match("/api.soundcloud.com/i", $url);
  }

  private function getWidth($width, $iframe, $type) {
    if (empty($width)) {
      $default = ($iframe) ? self::IFRAME_WIDTH : self::FLASH_WIDTH;
      $width = get_option('soundcloud_player_width');
      $width = $width === '' ? $default : $width;
    }
    return $width;
  }

  private function getHeight($height, $iframe, $type) {
    switch ($type) {
      case 'groups':
      case 'sets':
      case 'playlists':
        $default = ($iframe) ? self::IFRAME_TRACKLIST_HEIGHT : self::FLASH_TRACKLIST_HEIGHT;
        $height = (empty($height)) ? get_option('soundcloud_player_height_multi') : $height;
        $height = (empty($height)) ? $default : $height;
        if ($iframe) {
          $height = self::fixHeight($height, $default);
        }
        break;
      default:
        $default = ($iframe) ? self::IFRAME_HEIGHT : self::FLASH_HEIGHT;
        $height = (empty($height)) ? get_option('soundcloud_player_height') : $height;
        $height = (empty($height)) ? $default : $height;
        if ($iframe) {
          $height = self::fixHeight($height, $default);
        }
        // sounds can only be default height
        //$height = ($iframe) ? self::IFRAME_HEIGHT : self::FLASH_HEIGHT;
        break;
    }
    return $height;
  }

  private function fixHeight($height, $min_height) {
    if (!preg_match("/[0-9]+%/", $height) && intval($height) < $min_height) {
      $height = $min_height;
    }
    return $height;
  }

  private function getType($url) {
    if (empty($url)) {
      return false;
    }
    if ($url = parse_url($url)) {
      $splitted_url = split( "/", $url['path'] );
      $media_type = $splitted_url[count($splitted_url) - 2];
      return $media_type;
    }
  }

  private function getHTML($url, $iframe, $params, $width, $height) {

    $encoded_url = urlencode($url);
    $parsed_url = parse_url($url);

    if ($iframe) {
      $player_host = 'w.soundcloud.com';
      $player_params = 'url=' . $encoded_url . '&' . $params;
      $player_src = 'http://' . $player_host . '/player/?' . $player_params;
    } else {
      $player_host = preg_replace('/(.+\.)?(((staging|sandbox)-)?soundcloud\.com)/', 'player.$2', $parsed_url['host']);
      $player_params = 'url=' . $encoded_url . '&g=1&' . $params;
      $player_src = 'http://' . $player_host . '/player.swf?' . $player_params;
    }

    $width = esc_attr($width);
    $height = esc_attr($height);
    $player_src = esc_attr($player_src);

    if ($iframe) {
      $html = '<iframe width="' . $width . '" height="' . $height . '" scrolling="no" frameborder="no" src="' . $player_src . '"></iframe>';
    } else {
      $html = '<object height="' . $height . '" width="' . $width . '"><param name="movie" value="' . $player_src . '"></param><param name="allowscriptaccess" value="always"></param><embed allowscriptaccess="always" height="' . $height . '" src="' . $player_src . '" type="application/x-shockwave-flash" width="' . $width . '"></embed></object>';
    }
    return $html;
  }

}

// Add settings link on plugin page
add_filter("plugin_action_links_".plugin_basename(__FILE__), 'soundcloud_settings_link' );
function soundcloud_settings_link($links) {
  $settings_link = '<a href="options-general.php?page=soundcloud-shortcode">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}

// Add admin menu
add_action('admin_menu', 'soundcloud_shortcode_options_menu');
function soundcloud_shortcode_options_menu() {
  add_options_page('SoundCloud Options', 'SoundCloud', 'manage_options', 'soundcloud-shortcode', 'soundcloud_shortcode_options');
  add_action( 'admin_init', 'register_soundcloud_settings' );
}

function register_soundcloud_settings() {
  // register our settings
  register_setting( 'soundcloud-settings', 'soundcloud_player_height' );
  register_setting( 'soundcloud-settings', 'soundcloud_player_height_multi' );
  register_setting( 'soundcloud-settings', 'soundcloud_player_width ' );
  register_setting( 'soundcloud-settings', 'soundcloud_player_iframe' );
  register_setting( 'soundcloud-settings', 'soundcloud_auto_play' );
  register_setting( 'soundcloud-settings', 'soundcloud_show_comments ' );
  register_setting( 'soundcloud-settings', 'soundcloud_color' );
  register_setting( 'soundcloud-settings', 'soundcloud_theme_color' );
}


function soundcloud_shortcode_options() {
  if (!current_user_can('manage_options')) {
    wp_die( __('You do not have sufficient permissions to access this page.' , 'crumble') );
  }

?>
<div class="wrap">
  <h2>SoundCloud Shortcode Default Settings</h2>
  <p>These settings will become the new defaults used by the SoundCloud Shortcode throughout your blog.</p>
  <p>You can always override these settings on a per-shortcode basis. Setting the 'params' attribute in a shortcode overrides all these defaults combined.</p>

  <form method="post" action="options.php">
    <?php settings_fields( 'soundcloud-settings' ); ?>
    <table class="form-table">

      <tr valign="top">
        <th scope="row">Widget Type</th>
        <td>
          <label for="player_iframe_true"  style="margin-right: 1em;"><input type="radio" id="player_iframe_true"  name="soundcloud_player_iframe" value="true"  <?php if (crumble_SoundcloudShortcode::getDefaultIframePreference() == true)  echo 'checked'; ?> />HTML5</label>
          <label for="player_iframe_false" style="margin-right: 1em;"><input type="radio" id="player_iframe_false" name="soundcloud_player_iframe" value="false" <?php if (crumble_SoundcloudShortcode::getDefaultIframePreference() == false) echo 'checked'; ?> />Flash</label>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Player Height for Tracks</th>
        <td>
          <input type="text" name="soundcloud_player_height" value="<?php echo get_option('soundcloud_player_height'); ?>" /> (no unit, or %)<br />
          Leave blank to use the default, 81 (pixels).
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Player Height for Groups/Sets</th>
        <td>
          <input type="text" name="soundcloud_player_height_multi" value="<?php echo get_option('soundcloud_player_height_multi'); ?>" /> (no unit, or %)<br />
          Leave blank to use the default, 225 (pixels).
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Player Width</th>
        <td>
          <input type="text" name="soundcloud_player_width" value="<?php echo get_option('soundcloud_player_width'); ?>" /> (no unit, or %)<br />
          Leave blank to use the default, 100%.
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Current Default 'params'</th>
        <td>
          <?php echo crumble_SoundcloudShortcode::getDefaultQuery(); ?>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Auto Play</th>
        <td>
          <label for="auto_play_none"  style="margin-right: 1em;"><input type="radio" id="auto_play_none"  name="soundcloud_auto_play" value=""      <?php if (get_option('soundcloud_auto_play') == '')      echo 'checked'; ?> />Default</label>
          <label for="auto_play_true"  style="margin-right: 1em;"><input type="radio" id="auto_play_true"  name="soundcloud_auto_play" value="true"  <?php if (get_option('soundcloud_auto_play') == 'true')  echo 'checked'; ?> />True</label>
          <label for="auto_play_false" style="margin-right: 1em;"><input type="radio" id="auto_play_false" name="soundcloud_auto_play" value="false" <?php if (get_option('soundcloud_auto_play') == 'false') echo 'checked'; ?> />False</label>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Show Comments</th>
        <td>
          <label for="show_comments_none"  style="margin-right: 1em;"><input type="radio" id="show_comments_none"  name="soundcloud_show_comments" value=""      <?php if (get_option('soundcloud_show_comments') == '')      echo 'checked'; ?> />Default</label>
          <label for="show_comments_true"  style="margin-right: 1em;"><input type="radio" id="show_comments_true"  name="soundcloud_show_comments" value="true"  <?php if (get_option('soundcloud_show_comments') == 'true')  echo 'checked'; ?> />True</label>
          <label for="show_comments_false" style="margin-right: 1em;"><input type="radio" id="show_comments_false" name="soundcloud_show_comments" value="false" <?php if (get_option('soundcloud_show_comments') == 'false') echo 'checked'; ?> />False</label>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Color</th>
        <td>
          <input type="text" name="soundcloud_color" value="<?php echo get_option('soundcloud_color'); ?>" /> (color hex code e.g. ff6699)<br />
          Defines the color to paint the play button, waveform and selections.
        </td>
      </tr>

      <tr valign="top">
        <th scope="row">Theme Color</th>
        <td>
          <input type="text" name="soundcloud_theme_color" value="<?php echo get_option('soundcloud_theme_color'); ?>" /> (color hex code e.g. ff6699)<br />
          Defines the background color of the player.
        </td>
      </tr>

    </table>

      <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes' , 'crumble') ?>" />
      </p>

  </form>
</div>
<?php
}
?>