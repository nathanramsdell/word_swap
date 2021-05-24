<?php
/*
 
Plugin Name: Plugin Testing
 
Plugin URI: http://localhost:8888/mysite
 
Description: Learning how to add plugins to sites
 
Version: 1.0
 
Author: Nathan Ramsdell
 
Author URI: http://localhost:8888/mysite
 
License: GPLv2 or later
 
Text Domain: plugintest
 
*/

add_action('admin_menu', 'word_swap_plugin_create_menu');

function word_swap_plugin_create_menu() {

	add_menu_page('Word Swap Plugin', 'Word Swapper', 'administrator', __FILE__, 'word_swap_plugin_settings_page' , plugins_url('/images/icon.png', __FILE__) );

	add_action( 'admin_init', 'register_word_swap_plugin_settings' );
}

function register_word_swap_plugin_settings() {
    
	register_setting( 'word-swap-plugin-settings-group', 'new_option_name' );
	register_setting( 'word-swap-plugin-settings-group', 'some_other_option' );
}

function word_swap_plugin_settings_page() {
    ?>
<div class="wrap">
<h1>Word Swap</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'word-swap-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'word-swap-plugin-settings-group' ); ?>
   
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Word to Replace:</th>
        <td><input type="text" name="new_option_name" id='new_option_name' value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Replace With:</th>
        <td><input type="text" name="some_other_option" id='some_other_option' value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
        </tr>
        
    </table>

    <?php submit_button(); ?>
    <?php 
    $filterSelect = $_POST['filter_type'];
    print ($filterSelect);
    ?>
</form>

</div>

<?php }

function word_swap_typo_fix( $text ) {
	return str_replace( esc_attr( get_option('new_option_name') ), esc_attr( get_option('some_other_option') ), $text );
}
add_filter( 'the_content', 'word_swap_typo_fix' );

?>
