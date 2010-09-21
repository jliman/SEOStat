<?
require_once('inc/db.php');

$profileId = 0;
if (isset($_REQUEST['profileId'])) {
	$profileId = $_REQUEST['profileId'];
}

$startDate = '';
if (isset($_REQUEST['startDate'])) {
	$startDate = $_REQUEST['startDate'];
}

$endDate = '';
if (isset($_REQUEST['endDate'])) {
	$endDate = $_REQUEST['endDate'];
}

$interval = '';
if (isset($_REQUEST['interval'])) {
	$interval = $_REQUEST['interval'];
}

$type = '';
if (isset($_REQUEST['type'])) {
	$type = $_REQUEST['type'];
}


$profile = getProfiles($profileId);
$profile = $profile[0];

?>
<? if ($type == 'gp') { ?>
<div id="chartdiv1" class="graph"></div>
<script type="text/javascript">
   var chart1 = new FusionCharts("charts/ScrollLine2D.swf?fusioncharts.com", "AlexaStat", "980", "250", "0", "0");
   chart1.setDataURL(escape("ajax.data.alexa.php?profileId=<?=$profileId?>&startDate=<?=$startDate?>&endDate=<?=$endDate?>&interval=<?=$interval?>&r="+getTimeForURL()));		   
   chart1.render("chartdiv1");
</script>
<? if ($profile['ga_profileid'] != '') { ?>
<div id="chartdiv2" class="graph"></div>
<script type="text/javascript">
   var chart2 = new FusionCharts("charts/ScrollLine2D.swf?fusioncharts.com", "PageStat", "980", "250", "0", "0");
   chart2.setDataURL(escape("ajax.data.ga.php?profileId=<?=$profileId?>&startDate=<?=$startDate?>&endDate=<?=$endDate?>&interval=<?=$interval?>&r="+getTimeForURL()));		   
   chart2.render("chartdiv2");
</script>
<? } ?>
<div id="chartdiv3" class="graph"></div>
<script type="text/javascript">
   var chart3 = new FusionCharts("charts/ScrollLine2D.swf?fusioncharts.com", "Backlink", "980", "250", "0", "0");
   chart3.setDataURL(escape("ajax.data.backlink.php?profileId=<?=$profileId?>&startDate=<?=$startDate?>&endDate=<?=$endDate?>&interval=<?=$interval?>&r="+getTimeForURL()));		   
   chart3.render("chartdiv3");
</script>
<div id="chartdiv4" class="graph"></div>
<script type="text/javascript">
   var chart4 = new FusionCharts("charts/ScrollLine2D.swf?fusioncharts.com", "IndexedPage", "980", "250", "0", "0");
   chart4.setDataURL(escape("ajax.data.index.php?profileId=<?=$profileId?>&startDate=<?=$startDate?>&endDate=<?=$endDate?>&interval=<?=$interval?>&r="+getTimeForURL()));		   
   chart4.render("chartdiv4");
</script>
<? if ($profile['fb_pageid'] != '') { ?>
<div id="chartdiv5" class="graph"></div>
<script type="text/javascript">
   var chart5 = new FusionCharts("charts/ScrollLine2D.swf?fusioncharts.com", "Facebook", "980", "250", "0", "0");
   chart5.setDataURL(escape("ajax.data.facebook.php?profileId=<?=$profileId?>&startDate=<?=$startDate?>&endDate=<?=$endDate?>&interval=<?=$interval?>&r="+getTimeForURL()));		   
   chart5.render("chartdiv5");
</script>
<? } ?>
<? if ($profile['fb_pageid'] != '') { ?>
<div id="chartdiv5a" class="graph"></div>
<script type="text/javascript">
   var chart5a = new FusionCharts("charts/ScrollLine2D.swf?fusioncharts.com", "Facebook2", "980", "250", "0", "0");
   chart5a.setDataURL(escape("ajax.data.facebook2.php?profileId=<?=$profileId?>&startDate=<?=$startDate?>&endDate=<?=$endDate?>&interval=<?=$interval?>&r="+getTimeForURL()));		   
   chart5a.render("chartdiv5a");
</script>
<? } ?>
<? if ($profile['twitter_page'] != '') { ?>
<div id="chartdiv6" class="graph"></div>
<script type="text/javascript">
   var chart6 = new FusionCharts("charts/ScrollLine2D.swf?fusioncharts.com", "Twitter", "980", "250", "0", "0");
   chart6.setDataURL(escape("ajax.data.twitter.php?profileId=<?=$profileId?>&startDate=<?=$startDate?>&endDate=<?=$endDate?>&interval=<?=$interval?>&r="+getTimeForURL()));		   
   chart6.render("chartdiv6");
</script>
<? } ?>
<? } else { 
	echo 'Under development :)';
}
?>