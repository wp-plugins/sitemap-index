<?php
/*
Plugin Name: Sitemap Index
Plugin URI: http://www.forumbiznesu.eu/wordpress/sitemap-index-plugin
Description: Automaticly generates virtual sitemaps and sitemap index in XML format.
Author: Twardes
Version: 1.1
Author URI: http://www.forumbiznesu.eu/
*/

/*
== Changelog ==

1.1

*	Added tags indexing functionality
*	Added categories indexing functionality
*	Changes in administrator panel
*	PHP code fixes

1.0.3

*	File paths changed to more universal
*	Added new sitemap submission links
*	Added settings link in plugins menu

1.0.2

*	Fixed sitemap link.
*	Fixed path to blog main directory.

1.0.1

*	Added new links in administrator panel

1.0a

*	Alfa version.
*/


//admin menu
function si_admin()
{
    if (function_exists('add_options_page')) {
        add_options_page('sitemap-index', 'Sitemap Index', 1, basename(__file__),
            'si_admin_panel');
    }
}

function si_admin_panel()
{

    //Add options if first time running
    add_option('si_order', 'date_descending', 'Sitemap Index Plugin');
    add_option('si_hidden', 'false', 'Sitemap Index Plugin');
    add_option('si_pages', 'on', 'Sitemap Index Plugin');
    add_option('si_tags', 'on', 'Sitemap Index Plugin');
    add_option('si_categ', 'on', 'Sitemap Index Plugin');
    add_option('si_links', '100', 'Sitemap Index Plugin');

    //get posted options
    $orderby = $_POST['orderby'];

    if (isset($_POST['info_update'])) {
        //update settings
        $orderby = $_POST['orderby'];
        $showhidden = $_POST['showhidden'];
        $showpages = $_POST['showpages'];
    	$showtags = $_POST['showtags'];
    	$showcateg = $_POST['showcateg'];
        $manylinks = $_POST['manylinks'];

        update_option('si_order', $orderby);
        update_option('si_hidden', $showhidden);
        update_option('si_pages', $showpages);
		update_option('si_tags', $showtags);
		update_option('si_categ', $showcateg);
        update_option('si_links', $manylinks);
    } else {
        //load settings from database
        $orderby = get_option('si_order');
        $showhidden = get_option('si_hidden');
        $showpages = get_option('si_pages');
		$showtags = get_option('si_tags');
		$showcateg = get_option('si_categ');
        $manylinks = get_option('si_links');
    }

$siteurl = get_option('siteurl');
$adres_mapy = $siteurl.'/wp-content/plugins/sitemap-index/gen_sitemap.php';


?>

<div class="wrap">
<h2>Sitemap Index Settings</h2>
	<div>
		<p>
			Plugin version: <b>1.1</b>
		</p>
		<p>
			Sitemap URL adres:<br /><a href="<?= $adres_mapy ?>"><?= $adres_mapy ?></a>
		</p>
	</div>
	<div style="float: left; margin-right: 10px; width: 330px">
		<form method="post">
		
				<h3>General settings:</h3>
				<p>
					<label>
						Links per sitemap: <input type="text" value="<?= $manylinks ?>" name="manylinks" size="6" />
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="showpages" <?php checked('on', $showpages); ?> class="tog"/> Insert pages
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="showtags" <?php checked('on', $showtags); ?> class="tog"/> Insert tags
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" name="showcateg" <?php checked('on', $showcateg); ?> class="tog"/> Insert categories
					</label>
				</p>
				
				<h3>Order links by:</h3>

				<p>
					<label>
						<input name="orderby" type="radio" value="date_descending" <?php checked('date_descending',
$orderby); ?> class="tog"/> Date, descending (Default)
					</label>
				</p>

				<p>
					<label>
						<input name="orderby" type="radio" value="date_ascending" <?php checked('date_ascending',
$orderby); ?> class="tog"/> Date, ascending
					</label>
				</p>

				<p>
					<label>
						<input name="orderby" type="radio" value="alpha_descending" <?php checked('alpha_descending',
$orderby); ?> class="tog"/> Alphabetical, descending
					</label>
				</p>

				<p>
					<label>
						<input name="orderby" type="radio" value="alpha_ascending" <?php checked('alpha_ascending',
$orderby); ?> class="tog"/> Alphabetical, ascending
					</label>
				</p>

				<h3>Hidden posts:</h3>

				<p>
					<label>
						<input name="showhidden" type="checkbox" <?php checked('on', $showhidden); ?> class="tog"/> Show hidden posts &amp; pages
					</label>
				</p>

			<div>
			<p class="submit">
				<input type="submit" name="info_update" value="Update Options" />
			</p>
			</div>
		</form>
	</div>
<div style="float: left; width: 220px; margin-right: 10px;">

<h3>Submit Sitemap To:</h3>
<!-- 	<p>
		<a href="http://www.sitemapwriter.com/notify.php?crawler=all&url=<?###usunac###= $adres_mapy ?>"><b>All search engines</b></a>
	</p> -->
	<p>
		<a href="http://www.google.com/webmasters/sitemaps/ping?sitemap=<?= $adres_mapy ?>">Google</a>
	</p>
	<p>
		<a href="http://webmaster.live.com/ping.aspx?siteMap=<?= $adres_mapy ?>">Live Search</a>
	</p>
	<p>
		<a href="http://submissions.ask.com/ping?sitemap=<?= $adres_mapy ?>">Ask.com</a>
	</p>
	<p>
		<a href="http://search.yahooapis.com/SiteExplorerService/V1/ping?sitemap=<?= $adres_mapy ?>">Yahoo!</a><!--&nbsp;or&nbsp;
		<a href="http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid=SitemapWriter&url=<?###usunac###= $adres_mapy ?>">Yahoo!</a>-->
	</p>
	<p>
		<a href="http://api.moreover.com/ping?u=<?= $adres_mapy ?>">Moreover</a>
	</p>

<h3>About:</h3>
<p>
<a href="http://www.forumbiznesu.eu/wordpress/sitemap-index-plugin/">Sitemap Index Home Page</a>
</p>
<p>
<a href="http://wordpress.org/extend/plugins/sitemap-index/">Sitemap Index at Wordpress.org</a>
</p>
<p>
<a href="http://www.forumbiznesu.eu/">Author's Home Page</a>
</p>
<p>
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=QJFMUHRMKC3KG&amp;lc=US&amp;item_name=Sitemap%20Index%20Plugin%20for%20Wordpress%20by%20Twardes&amp;item_number=si&amp;currency_code=USD&amp;bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted"><img class="aligncenter" title="Make a donation" src="http://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" alt="" width="122" height="47" /></a>
</p>

</div>
</div>

	<?php
}


function si_plugin_actions($links, $file){
	static $this_plugin;

	if( !$this_plugin ) $this_plugin = plugin_basename(__FILE__);

	if( $file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=sitemap-index.php">' . __('Settings') . '</a>';
		$links = array_merge( array($settings_link), $links); // before other links
	}
	return $links;
}

//hooks
add_action('admin_menu', 'si_admin');
add_filter('plugin_action_links', 'si_plugin_actions', 10, 2);
?>