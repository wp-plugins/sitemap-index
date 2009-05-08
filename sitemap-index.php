<?php
/*
Plugin Name: Sitemap Index
Plugin URI: http://code.google.com/p/sitemapi1/
Description: Creates virtual sitemaps and sitemap index. We can change number of links per sitemap. Sitemap is generated only when it is opening.
Author: Twardes
Version: 1.0.1
Author URI: http://www.forumbiznesu.eu/
*/

/*
Updates:
1.0.1
Added new links in admin panel

1.0a
Alfa version.
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
    add_option('si_pages', 'pages_none', 'Sitemap Index Plugin');
    add_option('si_links', '1000', 'Sitemap Index Plugin');

    //get posted options
    $orderby = $_POST['orderby'];

    if (isset($_POST['info_update'])) {
        //update settings
        $orderby = $_POST['orderby'];
        $showhidden = $_POST['showhidden'];
        $showpages = $_POST['showpages'];
        $manylinks = $_POST['manylinks'];

        update_option('si_order', $orderby);
        update_option('si_hidden', $showhidden);
        update_option('si_pages', $showpages);
        update_option('si_links', $manylinks);
    } else {
        //load settings from database
        $orderby = get_option('si_order');
        $showhidden = get_option('si_hidden');
        $showpages = get_option('si_pages');
        $manylinks = get_option('si_links');
    }

    $adres_mapy = $_SERVER["SERVER_NAME"].'/wp-content/plugins/sitemap-index/gen_sitemap.php';


?>

<div class="wrap">
<h2>Sitemap Index Settings</h2>
	<div style="float: left; margin-right: 10px;">
		<form method="post">
			<div id="poststuff">
				<h3>General Settings:</h3>
				<p>
					Sitemap URL adres:<br /><a href="http://<?= $adres_mapy ?>"><?= $adres_mapy ?></a>
				</p>
				<p>
					<label>
						Links per sitemap: <input type="text" value="<?= $manylinks ?>" name="manylinks" size="6" /><br />
					</label>
				</p>
			</div>
			<div id="poststuff">
				<h3>Order Sitemap Pages By:</h3>

				<p>
					<label>
						<input name="orderby" type="radio" value="date_descending" <?php checked('date_descending',
$orderby); ?> class="tog"/>
						Date descending (Default)	<span> &raquo; Most recent to first posted.</span>
					</label>
				</p>

				<p>
					<label>
						<input name="orderby" type="radio" value="date_ascending" <?php checked('date_ascending',
$orderby); ?> class="tog"/>
						Date Ascending	<span> &raquo; First posted to most recent.</span>
					</label>
				</p>

				<p>
					<label>
						<input name="orderby" type="radio" value="alpha_descending" <?php checked('alpha_descending',
$orderby); ?> class="tog"/>
						Alphabetical descending	<span> &raquo; A to Z.</span>
					</label>
				</p>

				<p>
					<label>
						<input name="orderby" type="radio" value="alpha_ascending" <?php checked('alpha_ascending',
$orderby); ?> class="tog"/>
						Alphabetical ascending	<span> &raquo; Z to A.</span>
					</label>
				</p>
			</div>

			<div id="poststuff">
				<h3>Hidden Posts:</h3>

				<p>
					<label>
						Show hidden posts &amp; pages:
						<input name="showhidden" type="checkbox" <?php checked('on', $showhidden); ?> class="tog"/>
					</label>
				</p>
			</div>

			<div id="poststuff">
				<h3>Pages:</h3>

				<p>
					<label>
						<input name="showpages" type="radio" value="pages_none" <?php checked('pages_none',
$showpages); ?> class="tog"/>
						Don't show pages<br />
					</label>
				</p>

				<p>
					<label>
						<input name="showpages" type="radio" value="pages_before" <?php checked('pages_before',
$showpages); ?> class="tog"/>
						Show pages<br />
					</label>
				</p>
				
			</div>
<div>
			<p class="submit">
				<input type="submit" name="info_update" value="Update Options" />
			</p>
</div>

		</form>
	</div>
<div style="float: left; width: 220px; margin-right: 10px;">
<div id="poststuff">
<h3>Submit Sitemap To:</h3>
	<p>
	<a href="http://www.google.com/webmasters/sitemaps/ping?sitemap=http://<?= $adres_mapy ?>">Google</a>
	</p>
	<p>
	<a href="http://webmaster.live.com/ping.aspx?siteMap=http://<?= $adres_mapy ?>">Live Search</a>
	</p>
	<p>
	<a href="http://submissions.ask.com/ping?sitemap=http://<?= $adres_mapy ?>">Ask.com</a>
	</p>
</div>
<div id="poststuff">
<h3>About:</h3>
<p>
<a href="http://code.google.com/p/sitemapi1/">Sitemap Index at code.google.com</a>
<a href="http://wordpress.org/extend/plugins/sitemap-index/">Sitemap Index at Wordpress.org</a>
<a href="http://www.forumbiznesu.eu/">Author's Home Page</a>
</p>
</div>
</div>
</div>

	<?php
}


//hooks
add_action('admin_menu', 'si_admin');
?>