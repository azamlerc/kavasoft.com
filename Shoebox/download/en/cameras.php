<?php

# Page title
$title = "Shoebox - Download - RAW Support";

# Banner alternate text
$banner_alt = "Download Shoebox $version";

# Instructions
$supported_cameras_header = 'RAW Support';
$supported_cameras = 'Shoebox can display RAW files from the following cameras:';

# Requirements
$requirements_header = 'Requirements';

# Mac OS X
$macosx_link = hyperlink('http://www.apple.com/macosx/', 'Mac OS X');
$macosx_text = "Shoebox is written especially for $macosx_link.<br />It requires Mac OS X version 10.3 &ldquo;Panther&rdquo; or later.";

# Image Capture
$image_capture_link = hyperlink('http://www.apple.com/macosx/features/imagecapture/', 'Image Capture');
$cameras_link = local_link('cameras', 'cameras');
$image_capture_text = "Shoebox can download photos from cameras and<br />card readers that work with $image_capture_link.<br />Shoebox can read RAW files from most $cameras_link.";

# iPhoto
$iphoto_link = hyperlink('http://www.apple.com/ilife/iphoto/', 'iPhoto');
$iphoto_text = "Shoebox can import photos, albums, <br />and keywords from $iphoto_link 2 or later.";

# These language names should be translated.
# Don't worry about the order; they will be alphabetized.
$languages_translated = array('English', 'French' /*, 'German', 'Japanese' */);

$size = $disk_image_size_megs . $decimal_separator . $disk_image_size_decimal;
$disk_image_size = "$size MB disk image";

# What's new
$version_history = 'What&rsquo;s new?';

?>