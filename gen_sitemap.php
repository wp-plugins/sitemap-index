<?php

$tnij = explode("wp-content",$_SERVER["PHP_SELF"]);
require_once($_SERVER['DOCUMENT_ROOT'].$tnij[0].'wp-load.php');

/*
$sql = mysql_query("SELECT `option_name`,`option_value` FROM `wp_options` WHERE `option_name` LIKE 'si_order'");

while ($wiersz = mysql_fetch_assoc($sql)) {

		$orderby = $wiersz['option_value'];

	}

$sql = mysql_query("SELECT `option_name`,`option_value` FROM `wp_options` WHERE `option_name` LIKE 'si_hidden'");

while ($wiersz = mysql_fetch_assoc($sql)) {

		$showhidden = $wiersz['option_value'];

	}

$sql = mysql_query("SELECT `option_name`,`option_value` FROM `wp_options` WHERE `option_name` LIKE 'si_pages'");

while ($wiersz = mysql_fetch_assoc($sql)) {

		$showpages = $wiersz['option_value'];

	}

echo $orderby.$showhidden.$showpages;*/



		//Get option values
		$orderby = get_option('si_order'); #echo $orderby;
		$showhidden = get_option('si_hidden'); #echo $showhidden;
		$showpages = get_option('si_pages'); #echo $showpages;
		$manylinks = get_option('si_links');

		//do the order by
		switch ($orderby) {
			case 'date_descending':
				$sqlorder = "ORDER BY post_date DESC";
				break;
			case 'date_ascending':
				$sqlorder = "ORDER BY post_date";
				break;
			case 'alpha_descending':
				$sqlorder = "ORDER BY post_title";
				break;
			case 'alpha_ascending':
				$sqlorder = "ORDER BY post_title DESC";
				break;
		}
		
		//show private
		if ($showhidden == 'on') {
			$sqlwhere = "WHERE post_type='post' ";
		} else {
			$sqlwhere = "WHERE post_type='post' AND post_status='publish' ";
		}




$od = $_GET[s];
$po_ile_postow = $manylinks;


if (isset($od)) {
	


$xmlForHeader = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
';

	$data=date("Y-m-d");
	$changefreq='daily';
	$priority='1';

$xmNOone = "	<url>
		<loc>http://".$_SERVER["SERVER_NAME"]."</loc>
		<lastmod>$data</lastmod>
		<changefreq>$changefreq</changefreq>
		<priority>$priority</priority>
	</url>";
	
$xmForTresc .= $xmNOone;



	//Do we want the pages too?
	if ($showpages != 'pages_none') {
		$sqlpages = "SELECT * FROM " . $table_prefix . "posts where post_type='page' ";

		if ($showhidden != 'on') {
			$sqlpages .= "AND post_status='publish' ";
		}
		
		$allpages = $wpdb->get_results($sqlpages);

foreach($allpages as $ap) {
$perma = get_permalink($ap->ID);
$data = $ap->post_date;
$czesc = explode(" ",$data);
$data = $czesc[0];

if ($data==date("Y-m-d")) {$priority='1';$changefreq='daily';} // z dzisiaj
else if ($data>=(date("Y-m-d", time() - (60*60*24*2)))) {$priority='0.9';$changefreq='daily';} //od dzi¶ do 2 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*4)))) {$priority='0.8';$changefreq='daily';} //od 2 do 4 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*7)))) {$priority='0.7';$changefreq='weekly';} //od 4 do 7 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*14)))) {$priority='0.6';$changefreq='weekly';} //od 7 do 14 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*21)))) {$priority='0.5';$changefreq='weekly';} //od 14 do 21 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*30)))) {$priority='0.4';$changefreq='monthly';} //od 21 do 30 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*90)))) {$priority='0.3';$changefreq='monthly';} //od 30 do 90 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*180)))) {$priority='0.2';$changefreq='monthly';} //od 90 do 180 dni temu
else {$priority='0.1';$changefreq='yearly';} // starcze niż 180 dni

$xmlForOffer ="	<url>
		<loc>$perma</loc>
		<lastmod>$data</lastmod>
		<changefreq>$changefreq</changefreq>
		<priority>$priority</priority>
	</url>
";

$xmForTresc .= $xmlForOffer;

			}

		}



$sql = "SELECT * FROM " . $table_prefix . "posts " . $sqlwhere . $sqlorder." LIMIT ".$od.",".$po_ile_postow;

$allposts = $wpdb->get_results($sql);

foreach($allposts as $ap) {
	$perma = get_permalink($ap->ID);
	$data = $ap->post_date;
	$czesc = explode(" ",$data);
	$data = $czesc[0];


if ($data==date("Y-m-d")) {$priority='1';$changefreq='daily';} // z dzisiaj
else if ($data>=(date("Y-m-d", time() - (60*60*24*2)))) {$priority='0.9';$changefreq='daily';} //od dzi¶ do 2 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*4)))) {$priority='0.8';$changefreq='daily';} //od 2 do 4 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*7)))) {$priority='0.7';$changefreq='weekly';} //od 4 do 7 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*14)))) {$priority='0.6';$changefreq='weekly';} //od 7 do 14 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*21)))) {$priority='0.5';$changefreq='weekly';} //od 14 do 21 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*30)))) {$priority='0.4';$changefreq='monthly';} //od 21 do 30 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*90)))) {$priority='0.3';$changefreq='monthly';} //od 30 do 90 dni temu
else if ($data>=(date("Y-m-d", time() - (60*60*24*180)))) {$priority='0.2';$changefreq='monthly';} //od 90 do 180 dni temu
else {$priority='0.1';$changefreq='yearly';} // starcze niż 180 dni

$xmlForOffer ="	<url>
		<loc>$perma</loc>
		<lastmod>$data</lastmod>
		<changefreq>$changefreq</changefreq>
		<priority>$priority</priority>
	</url>
";



$xmForTresc .= $xmlForOffer;

}

$xmlForFooter ='</urlset>';

header('Content-Type: application/xml');

echo ($xmlForHeader.$xmForTresc.$xmlForFooter);

}

else

{

$xmlForHeader = '<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
';


$data=date("Y-m-d");

$ile_postow = mysql_num_rows(mysql_query("SELECT `ID` FROM ".$table_prefix."posts ".$sqlwhere. $sqlorder.""));

#echo $ile_postow;

$ile_map_postow = ceil($ile_postow / $po_ile_postow);
for($i=0;$i<$ile_map_postow;$i++) {

$od = $i*$po_ile_postow;


$xmlForOffer ="	<sitemap>
		<loc>http://".$_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"]."?s=$od</loc>
		<lastmod>$data</lastmod>
	</sitemap>
";

$xmForTresc .= $xmlForOffer;
}

$xmlForFooter ='</sitemapindex>';


header('Content-Type: application/xml');
echo ($xmlForHeader.$xmForTresc.$xmlForFooter);

		
}
?>