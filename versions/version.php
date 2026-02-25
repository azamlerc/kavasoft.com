<?php

$archs = array('unknown', 'ppc', 'i386', 'x86_64');
$program_keys = array('unknown', 'shoebox_pro', 'kavatunes', 'kavamovies', 'hyperimage', 'iconquer', 'curator', 'kavaservices');

function convert_html_chars($string) {
	if ($_GET['encode'] == "html") {
		return htmlspecialchars($string);
	} else {
		$encoded_chars = array("&eacute;", "&egrave;", "&agrave;", "&uuml;");
		$flat_chars = array("e", "e", "a", "ue");

		return str_replace($encoded_chars, $flat_chars, $string);
	}
}

function file_exists_ip($filename) { 
    if(function_exists("get_include_path")) { 
        $include_path = get_include_path(); 
    } elseif(false !== ($ip = ini_get("include_path"))) { 
        $include_path = $ip; 
    } else {return false;} 

    if(false !== strpos($include_path, PATH_SEPARATOR)) { 
        if(false !== ($temp = explode(PATH_SEPARATOR, $include_path)) && count($temp) > 0) { 
            for($n = 0; $n < count($temp); $n++) { 
                if(false !== @file_exists($temp[$n] . $filename)) { 
                    return true; 
                } 
            } 
            return false; 
        } else {return false;} 
    } elseif(!empty($include_path)) { 
        if(false !== @file_exists($include_path)) { 
            return true; 
        } else {return false;} 
    } else {return false;} 
} 

function plist_key_value($key, $value, $tabs = 2) {
	if ($value) {
		$value = convert_html_chars($value);
		for ($i = 0; $i < $tabs; $i++) echo("\t");
		echo("<key>$key</key>\n");
		for ($i = 0; $i < $tabs; $i++) echo("\t");
		echo("<string>$value</string>\n");
	}
}

function version_plist($product_key) {
	$lang = $_GET['lang'];
	if (!$lang || strlen($lang) != 2 || $lang == 'it') $lang = 'en';

	include('../products.php');

	$product = $products[$product_key];
	$program = $product['name'];
	$product_id = $product['product_id'];
	if ($program == 'Shoebox Pro') $program = 'Shoebox';
	$version = $product['version'];
	$folder = $product['icon'];
	$whatsnew = $product['whatsnew'];
	$price = null;
	$image = null;
	
	$current = $_GET['current'];
	if (!$current) $current = '';

	$system = $_GET['system'];
	if ($system) {
		$system_parts = explode('.', $system);
		$major = $system_parts[1]; // for 10.6.1, 6
		$minor = $system_parts[2]; // for 10.6.1, 1
	} else {
		$major = 0;
		$minor = 0;
	}
		
	$architecture = $_GET['arch'];
	if (!$architecture) $architecture = 'unknown';
	$arch = array_search($architecture, $GLOBALS['archs']);
	
	$resolution = $_GET['resolution'];
	if (!$resolution) $resolution = 0;
	
	ini_set('date.timezone', 'America/Chicago');
	$date_checked = date('Y-m-d');
	
	$show_site = true;
	
	$use_database = file_exists_ip('DB.php');
	if ($use_database) {
		require('DB.php');
		$dbh = DB::connect('mysql://kavasoft_admin:KaVaDaTa@localhost/kavasoft_licenses');
		$prh = $dbh->prepare('INSERT INTO versions (program,date_checked,version,arch,major,minor,resolution) VALUES (?,?,?,?,?,?,?)');
		$sth = $dbh->execute($prh, array($product_id, $date_checked, $current, $arch, $major, $minor, $resolution));
	}

	$upgrade = $product['upgrade'];
	
	// if the current version doesn't start with the version_prefix, show the major update
	// if there's no current version, then it's really old
	if (is_array($upgrade) && (!$current || ($current < $upgrade['version_prefix']))) {
		$whatsnew = $upgrade['whatsnew'];
		$image = $upgrade['image'];
		$price = $upgrade['price'];
	}
	
	include("../versions/version-$lang.php");

	echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">\n");
	echo("<!DOCTYPE plist PUBLIC \"-//Apple Computer//DTD PLIST 1.0//EN\" \"http://www.apple.com/DTDs/PropertyList-1.0.dtd\">\n");
	echo("<plist version=\"1.0\">\n");
	echo("<dict>\n");
	echo("\t<key>$program</key>\n");
	echo("\t<dict>\n");

	plist_key_value('version', $version);
	plist_key_value('message', $versionmessage);
	plist_key_value('info', $whatsnew);
	plist_key_value('message-current', $versionmessagecurrent);
	plist_key_value('info-current', $versioninfocurrent);
	plist_key_value('url', "http://www.kavasoft.com/$folder.dmg");
	plist_key_value('website', "http://www.kavasoft.com/$folder/");
	plist_key_value('macosx', $product['macosx']);
	plist_key_value('image', $image);
	plist_key_value('price', $price);

	echo("\t</dict>\n");
	echo("</dict>\n");
	echo("</plist>\n");
}

