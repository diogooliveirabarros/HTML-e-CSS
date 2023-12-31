<?php
  require('includes/application_top.php');

  if ($HTTP_GET_VARS['action'] == 'banner') {
    $banner_query = tep_db_query("select banners_title, banners_image, banners_html_text from " . TABLE_BANNERS . " where banners_id = '" . $HTTP_GET_VARS['id'] . "'");
    $banner = tep_db_fetch_array($banner_query);

    $page_title = $banner['banners_title'];

    if ($banner['banners_html_text']) {
      $image_source = $banner['banners_html_text'];
    } elseif ($banner['banners_image']) {
      $image_source = '<img src="' . DIR_WS_CATALOG_IMAGES . $banner['banners_image'] . '" border="0" alt="' . $page_title . '">';
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo $page_title; ?></title>
<script language="javascript"><!--
var i=0;

function resize() {
  if (navigator.appName == 'Netscape') i = 40;
  window.resizeTo(document.images[0].width + 30, document.images[0].height + 60 - i);
}
//--></script>
</head>

<body onload="resize();">

<?php echo $image_source; ?>

</body>

</html>
