<?php
/*
Plugin Name: The SEO Engine
Plugin URI: http://www.seoengine.com/wordpress-plugin-seo-engine.htm
Description: SEO Engine Search Bar Widget for Wordpress Users
Author: SEOEngine.com
Version: 1.09
Author URI: http://www.seoengine.com/
*/

function seo_engine_form()
{?>
      <!--
      *******************************
      * START SEO Engine(TM) SEARCH FORM
      *
      * Subject to SEO Engine(TM) Terms of Service (TOS) found @ 'http://www.seoengine.com/terms.htm'.  
      *******************************
      -->
      <h2 class="widgettitle" style="text-align:center !important;">Optimize Your Website!</h2>
      <script type="text/javascript">
        function clickSearchBar(searchBar) {
	        if (searchBar.value == 'Enter Website or URL') {
		        searchBar.style.color = 'black';
		        searchBar.value = 'http://';
		        var range = searchBar.createTextRange();
		        range.move('character', 7);
		        range.select();
	        }
        }
      </script>  

      <form name="SEOENGForm" method="post" action="http://search.seoengine.com/" enctype="application/x-www-form-urlencoded"> 
        <input type="hidden" name="externalSearchForm" value="" />
        <?php
        	if(get_option('seo_engine_affiliateID') > 0 || get_option('seo_engine_affiliateID') != NULL)
        	{
        ?>
        <input type="hidden" name="affiliateId" value="<?php echo get_option('seo_engine_affiliateID'); ?>" />
        <?php
    		}
    	?>
        <div style="font-size: 16px; text-align: center;">
          <div style="margin: 5px 0px 0px 0px;">
            <a href="http://www.seoengine.com/"><img style="border-style: none;" alt="SEO Software Platform" src=<?php echo('"' . plugins_url('/images/seoeng-powered-by.png', __FILE__) . '"' ); ?>></a><br />
            <input style="color: #999990; font-size: 14px; width: 150px; padding: 5px; border: 2px solid #999990;" onkeydown="clickSearchBar(this);" onclick="clickSearchBar(this);" type="text" name="website" value="Enter Website or URL">
            <input class="button" style="font-size: 14px; font-weight: bold;" type="submit" value="OPTIMIZE!">
          </div>
        </div>
        <input type="text" style="visibility:hidden;display:none;width:99%;text-align:center;" name="do-not-remove" value="Do NOT remove this -- allows users to hit 'enter' on IE -- this box will not be shown!!"/>
      </form>
      <!-- END SEO Engine SEARCH FORM -->
<?php
}
 
function widget_seo_engine_form($args) {
  extract($args);
  echo $before_widget;
  seo_engine_form();
  echo $after_widget;
}
 
function seo_engine_form_init()
{
  register_sidebar_widget(__('SEO Engine'), 'widget_seo_engine_form');
}
add_action("plugins_loaded", "seo_engine_form_init");

add_option('seo_engine_affiliateID');

// start settings section
// create custom plugin settings menu
add_action('admin_menu', 'seo_engine_create_menu');

function seo_engine_create_menu() {

	//create new top-level menu
	add_menu_page('SEO Engine Plugin Settings', 'SEO Engine Search Settings', 'administrator', __FILE__, 'seo_engine_settings_page',plugins_url('/images/icon.png', __FILE__));

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'seo_engine_settings', 'seo_engine_affiliateID' );
}

function seo_engine_settings_page() {
?>
<div class="wrap">
<h2>SEO Engine Search Widget</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'seo_engine_settings' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Affiliate ID</th>
        <td><input type="text" name="seo_engine_affiliateID" value="<?php echo get_option('seo_engine_affiliateID'); ?>" /></td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php }
?>
