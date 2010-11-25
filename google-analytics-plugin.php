<?php
/*
Plugin Name: Google Analytics Plugin
Version: 1.0
Plugin URI: http://improveseo.info/
Description: Optimized Google Analytics Plugin for Wordpress
Author: Adrian Ianculescu
Author URI: http://improveseo.info/
*/

function google_analytics_footer_code() {

	$google_analytics_options = get_option('google_analytics_options');

	echo '<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push([\'_setAccount\', \'' . $google_analytics_options['ua_id'] . '\']);
			_gaq.push([\'_trackPageview\']);

			(function() {
			var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
			ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
			var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>';  
}

function google_analytics_admin_section() {
	
	$google_analytics_options = get_option('google_analytics_options');
	
	if (isset($_POST['update_options_submit'])) {
		$google_analytics_options['ua_id'] = $_POST['ua_id'];
		update_option('google_analytics_options', $google_analytics_options);
	}

?>

<div class=wrap>
  <form method="post">
    <h2>Google Analytics</h2>
    <fieldset class="options" name="general">
	<br/>
      <table class="editform">
        <tr>
          <th nowrap valign="top"><?php _e('UA ID(Web Property ID):', 'google-analytics') ?></th>
          <td><input name="ua_id" type="text" id="ua_id" value="<?php echo $google_analytics_options['ua_id']; ?>" size="30" />
            <br />Enter your Google Analytics Web Property ID(UA ID). You can retrieve it from Analytics admin page(Analytics Settings > Profile Settings > Tracking Code) or from the javascript provided by google analytics. It should look like this one: UA-999999-9. 
			You don't have to include the JavaScript code, this plugin will do it for you.
          </td>
        </tr>
      </table>
    </fieldset>
    
    <div class="submit">
      <input type="submit" name="update_options_submit" value="<?php _e('Update options', 'google-analytics') ?>" />
	</div>
  </form>
</div>

<?
}

function google_analytics_admin_submenu() { add_submenu_page('options-general.php', 'Google Analytics', 'Google Analytics', 8, __FILE__, 'google_analytics_admin_section'); }
add_action('admin_menu', 'google_analytics_admin_submenu');
add_action('wp_footer', 'google_analytics_footer_code');

?>
