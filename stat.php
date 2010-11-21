<?
require_once('inc/db.php');

$profileId = 0;
if (isset($_GET['id'])) {
	$profileId = $_GET['id'];
}

$groupId = 0;
if (isset($_GET['groupId'])) {
	$groupId = $_GET['groupId'];
}

$groups = getGroups();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- It's important to use the ntb namespace in the HTML tag or the datepicker will not render -->
<html xmlns:ntb="http://www.nitobi.com">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<title>SEO Activity Statistics</title>

<link type="text/css" rel="stylesheet" href="css/style.css"></link>       
<link type="text/css" rel="stylesheet" href="css/print.css" media="print"></link>       
<link type="text/css" rel="stylesheet" href="css/nitobi.calendar.css"></link>       

<style type="text/css">
  #semiFixed {width:100%; background-color: white; margin-bottom:10px; border-bottom: 1px solid #666; padding-bottom:10px;}
  .clear {clear:left;}

#loading
{
	position:absolute;
	top:0px;
	right:0px;
	background:#ff0000;
	color:#fff;
	font-size:12px;
	font-familly:Arial;
	padding:2px;
	display:none;
	z-index: 1000;
}

#loading img {
	margin:0px 5px 0px 5px;
}

.graph {
	margin:0px 0px 20px 0px;
}
</style>

<script src="js/nitobi.toolkit.js"></script>       
<script src="js/nitobi.calendar.js"></script>
<script language="JavaScript" src="js/FusionCharts.js"></script>
<script language="JavaScript" src="js/date.format.js"></script>
<script src="js/jquery-1.2.6.min.js" type="text/javascript"></script>

<script>
	
	var profileId = <?=$profileId?>;
	var groupId = <?=$groupId?>;
	var initStatus = true;
	
	function setAndExecute(divId, innerHTML) {  
    var div = document.getElementById(divId);  
    div.innerHTML = innerHTML;  
    var x = div.getElementsByTagName("script");
    var l = x.length;
    for( var i=0; i < l; i++) {  
      eval(x[i].text);  
    }  
 }

	function setCmbValue(obj, val) {
		for (var i=0; i < obj.length; i++) {
			if (obj[i].value == val) {
				obj[i].selected = true;
			}
		}  
	}
	
	function statusBusy() {
		document.getElementById('loading').style.display = 'block';
		document.getElementById('btnView').disabled = true;
		document.getElementById('cmbGroup').disabled = true;
		document.getElementById('cmbProfile').disabled = true;
		document.getElementById('cmbInterval').disabled = true;
		document.getElementById('cmbType').disabled = true;
	}
	
	function statusNormal() {
		document.getElementById('loading').style.display = 'none';
		document.getElementById('btnView').disabled = false;
		document.getElementById('cmbGroup').disabled = false;
		document.getElementById('cmbProfile').disabled = false;
		document.getElementById('cmbInterval').disabled = false;
		document.getElementById('cmbType').disabled = false;
	}
	
	function cmbGroupChanged(groupId) {
		statusBusy();
		var xhr = new nitobi.ajax.HttpRequest();
		xhr.handler = "ajax.getprofile.php";
		xhr.async = true; // async is true by default
		xhr.responseType = "text"; // by default the appropriate responseType will be used - ie XML if the data is valid XML otherwise "text".
		//xhr.onGetComplete.subscribeOnce(function(evtArgs) {alert("In onGetComplete:\n" + nitobi.xml.serialize(evtArgs.response))});
		xhr.completeCallback = function(evtArgs) {
			//alert("In completeCallback:\n" + (evtArgs.response))
			document.getElementById('divProfile').innerHTML = evtArgs.response;
			if (initStatus) {
				if (profileId != 0) {
					setCmbValue(document.getElementById('cmbProfile'),profileId);
					initStatus = false;
					viewStat();
				}			
			}
			statusNormal();	
		};
		xhr.post("groupId="+groupId);

	}
	
	function initParam()
	{
		if (groupId != 0) {
			setCmbValue(document.getElementById('cmbGroup'),groupId);
		}
		cmbGroupChanged(document.getElementById('cmbGroup').value);	
	}
	
	function viewStat() {
		statusBusy();
		var xhr = new nitobi.ajax.HttpRequest();
		xhr.handler = "ajax.getstat.php";
		xhr.async = true;
		xhr.responseType = "text";
		xhr.completeCallback = function(evtArgs) {
			setAndExecute('divData', evtArgs.response);
			//document.getElementById('divData').innerHTML = evtArgs.response;
			statusNormal();	
		};
		var profileId = document.getElementById('cmbProfile').value;
		var dp = nitobi.loadComponent("dp");
		var dp1 = nitobi.loadComponent("dp1");
		var startDate = dp.getSelectedDate();
		var endDate = dp1.getSelectedDate();
		var interval = document.getElementById('cmbInterval').value;
		var type = document.getElementById('cmbType').value;
		var strPost = 'profileId='+profileId+'&startDate='+startDate.format("yyyy-mm-dd")+'&endDate='+endDate.format("yyyy-mm-dd")+'&interval='+interval+'&type='+type;
		//alert(strPost)
		xhr.post(strPost);
	}
	
	function load()
	{
		var dp = nitobi.loadComponent("dp");
		var dp1 = nitobi.loadComponent("dp1");
		var tempDate = new Date();	
		dp1.setSelectedDate(tempDate);
		var tempDate2 = new Date();
		nitobi.base.DateMath.subtract(tempDate2, 'm', 1);
		dp.setSelectedDate(tempDate2);
		var tempDate3 = dp.getSelectedDate();
		nitobi.base.DateMath.add(tempDate3, 'd', 1);
		dp1.setMinDate(tempDate3);
		var tempDate4 = dp1.getSelectedDate();
		nitobi.base.DateMath.subtract(tempDate4, 'd', 1);
		dp.setMaxDate(tempDate4);
		initParam();
	}	
	
	function setMin(e)
	{
		var start = e.source;
		var minDate = start.getSelectedDate();
		nitobi.base.DateMath.add(minDate, 'd', 1);
		var end = nitobi.getComponent("dp1");
		end.setMinDate(minDate);
		end.render();
	}
	
	function setMax(e)
	{
		var end = e.source;
		var maxDate = end.getSelectedDate();
		nitobi.base.DateMath.subtract(maxDate, 'd', 1);
		var start = nitobi.getComponent("dp");
		start.setMaxDate(maxDate);
		start.render();
	}
	
	nitobi.html.attachEvent(window, "load", load);
	
	function getTimeForURL(){
		var dt = new Date();
		var strOutput = "";
		strOutput = dt.getHours() + "_" + dt.getMinutes() + "_" + dt.getSeconds() + "_" +          dt.getMilliseconds();
		return strOutput;
   }
</script>

<script type="text/javascript">
/* ================================================================ 
This copyright notice must be untouched at all times.
Stay Put!
Copyright (c) 2009 Stu Nicholls - stunicholls.com - all rights reserved.
=================================================================== */
/* <![CDATA[ */
onload = function() {

startPos = $("#semiFixed").position().top;
divHeight = $("#semiFixed").outerHeight();
$("#placeHolder").css("height", divHeight + "px")

$(window).scroll(function (e) {
scrTop = $(window).scrollTop();


	//if ((startPos-5) < scrTop) {
	if ((startPos) < scrTop) {
		if ($.browser.msie && $.browser.version <= 6 ) {
		topPos = startPos + (scrTop - startPos);
		$("#semiFixed")	.css("position", "absolute")
						.css("top", topPos +"px")
						.css('zIndex', '500')
		}
		else {
		$("#semiFixed")	.css("position", "fixed")
						.css("top", "0px")
						.css("zIndex", "500")
		}
	}
	else {
		$("#semiFixed")	.css("position", "static")
	}

});

}

/* ]]> */
</script>


</head>
<body>


	<form name="myform" id="myform" method="post">

<div id="placeHolder">
	<div id="semiFixed">
	<div id="loading"><img src="images/loader.gif" align="absmiddle"/>Loading...</div>
	<a href="http://www.ogahrugi.com" target="_blank"><img src="http://www.ogahrugi.com/uploads/style/Logo-Ogahrugi.png" width="100" align="left" border="0"/></a>
	<h1>SEO Activity Statistics</h1>
	<table>
		<tr valign="bottom">
			<td>
			Group<br>
			<select class="jls_combo" name="cmbGroup" id="cmbGroup" onchange="cmbGroupChanged(this.value)">
				<? foreach ($groups as $group) { ?>
					<option value="<?=$group['id']?>"><?=$group['name']?></option>
				<? } ?>
			</select>
			</td>
			<td>
			Website<br>
			<div id="divProfile" style="margin:0px;padding:0px">
			<select class="jls_combo" name="cmbProfile" id="cmbProfile"></select>
			</div>
			</td>
			<td>
			Start Date
		<ntb:datepicker id="dp" theme="outline" ondateselected="setMin(eventArgs)">
			<ntb:dateinput displaymask="NNN d, yyyy" editmask="yyyy-MM-dd" width="90"></ntb:dateinput>
			<ntb:calendar></ntb:calendar>
		</ntb:datepicker>
			</td>
			<td>
			End Date
		<ntb:datepicker id="dp1" theme="outline" ondateselected="setMax(eventArgs)">
			<ntb:dateinput displaymask="NNN d, yyyy" editmask="yyyy-MM-dd" width="90"></ntb:dateinput>
			<ntb:calendar></ntb:calendar>
		</ntb:datepicker>
			</td>
			<td>
			Interval<br>
			<select class="jls_combo" name="cmbInterval" id="cmbInterval">
				<option value="d">Daily</option>
				<option value="w">Weekly</option>
				<option value="m">Monthly</option>
			</select>
			</td>
			<td>
			View as<br>
			<select class="jls_combo" name="cmbType" id="cmbType">
				<option value="gp">Graph</option>
				<option value="gd">Grid</option>
			</select>
			</td>
			<td>
	<input type="button" name="btnView" id="btnView" value="View Stat" onclick="viewStat()" class="btn"/>
			</td>
		</tr>
	</table>
	</div>
</div>
<br class="clear" />

	</form>

	<div id="divData"></div>
	<p>&copy;2010 <a href="http://www.ogahrugi.com" target="_blank">OgahRugi.com</a></p>
</body>
</html>