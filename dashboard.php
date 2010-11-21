<?
require_once('inc/db.php');

$groups = getGroups();

$groupID = 0;
if (isset($_POST['cmbGroup'])) {
	$groupID = $_POST['cmbGroup'];
} else {
	$groupID = $groups[0]['id'];
}

$data = getProfileDataByGroup($groupID);

function getStrTrend($newvalue, $oldvalue, $inverse=false) {
	$trend = 'same';
	if ($newvalue > $oldvalue) {
		$trend = 'up';
	} else if ($newvalue == $oldvalue) {
		$trend = 'same';
	} else {
		$trend = 'down';
	}
	if ($inverse && $trend != 'same') {
		$trend .= '1';
	}
	$str = '<img class="indicator" src="images/'.$trend.'.gif" alt="up" valign="absmiddle" title="before: '.number_format($oldvalue).'"/>';
	return $str;
}
?>
<html>
	<head>
		<title>SEO Activity Dashboard</title>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/style.css"/>   	
	</head>
	<body>
		<h1>SEO Activity Dashboard</h1>
		<form method="post" name="form1" id="form1">
		<div>Group: 
			<select name="cmbGroup" id="cmbGroup" onchange="document.form1.submit()">
				<? 
				foreach($groups as $group) {
				?>
				<option value="<?=$group['id']?>" <? if ($groupID == $group['id']) echo 'selected';?>><?=$group['name']?></option>
				<?
				}
				?>
			</select>
		</div>
		</form>
		<br>
		<table cellpadding="0" cellspacing="0" class="seostat">
			<tr>
				<td rowspan="2">&nbsp;</td>
				<td rowspan="2" class="center">Date</td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td colspan="3" class="profile" nowrap><a target="_blank" href="http://<?=$data[$i]['url']?>"><?=$data[$i]['name']?></a>&nbsp;<a href="stat.php?id=<?=$data[$i]['id_profile']?>&groupId=<?=$groupID?>" style="text-decoration:none;color:white;"><img src="images/chart.png" align="absmiddle"/></a></td>
				<? } ?>
			</tr>
			<tr>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="sub" colspan="2">Actual</td>
				<td class="sub">Target</td>
				<? } ?>
			</tr>
			<tr>
				<td colspan="<?=(2+(sizeof($data)*3))?>" class="category">Web Indicator</td>
			</tr>
			<tr>
				<td colspan="<?=(2+(sizeof($data)*3))?>" class="section">Statistic</td>
			</tr>
			<tr>
				<td class="indent1" nowrap>Google Page Rank</td>
				<td class="center" nowrap><?=date("j M",strtotime($data[0]['rank_asof']))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['google_pagerank'] >= $data[$i]['google_pagerank_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['google_pagerank'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['google_pagerank'], $data[$i]['google_pagerank_before'])?></td>
				<td class="number"><?=number_format($data[$i]['google_pagerank_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td class="indent1">Alexa Rank</td>
				<td class="center" nowrap><?=date("j M",strtotime($data[0]['rank_asof']))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['alexa_rank'] <= $data[$i]['alexa_rank_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['alexa_rank'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['alexa_rank'], $data[$i]['alexa_rank_before'],true)?></td>
				<td class="number"><?=number_format($data[$i]['alexa_rank_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td class="indent1">Visitors</td>
				<td class="center" nowrap><?=date("j M",strtotime($data[0]['ga_asof']))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['visit'] >= $data[$i]['visit_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['visit'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['visit'], $data[$i]['visit_before'])?></td>
				<td class="number"><?=number_format($data[$i]['visit_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td class="indent1">Page Views</td>
				<td class="center" nowrap><?=date("j M",strtotime($data[0]['ga_asof']))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['pageview'] >= $data[$i]['pageview_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['pageview'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['pageview'], $data[$i]['pageview_before'])?></td>
				<td class="number"><?=number_format($data[$i]['pageview_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td class="indent1">Backlinks</td>
				<td colspan="<?=(1+(sizeof($data)*3))?>">&nbsp;</td>
			</tr>
			<tr>
				<td class="indent2">Yahoo</td>
				<td class="center" nowrap><?=date("j M",strtotime($data[0]['backlink_asof']))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['yahoo_backlink'] >= $data[$i]['yahoo_backlink_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['yahoo_backlink'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['yahoo_backlink'], $data[$i]['yahoo_backlink_before'])?></td>
				<td class="number"><?=number_format($data[$i]['yahoo_backlink_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td class="indent2">BacklinkWatch</td>
				<td class="center" nowrap><?=date("j M",strtotime($data[0]['backlink_asof']))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['bw_backlink'] >= $data[$i]['bw_backlink_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['bw_backlink'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['bw_backlink'], $data[$i]['bw_backlink_before'])?></td>
				<td class="number"><?=number_format($data[$i]['bw_backlink_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td class="indent2">SEO Pro</td>
				<td class="center" nowrap><?=date("j M",strtotime($data[0]['backlink_asof']))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['bc_backlink'] >= $data[$i]['bc_backlink_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['bc_backlink'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['bc_backlink'], $data[$i]['bc_backlink_before'])?></td>
				<td class="number"><?=number_format($data[$i]['bc_backlink_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td class="indent1">Indexed Page</td>
				<td colspan="<?=(1+(sizeof($data)*3))?>">&nbsp;</td>
			</tr>
			<tr>
				<td class="indent2">Google</td>
				<td class="center" nowrap><?=date("j M",strtotime($data[0]['indexed_asof']))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['indexed_google'] >= $data[$i]['indexed_google_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['indexed_google'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['indexed_google'], $data[$i]['indexed_google_before'])?></td>
				<td class="number"><?=number_format($data[$i]['indexed_google_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td class="indent2">Yahoo</td>
				<td class="center" nowrap><?=date("j M",strtotime($data[0]['indexed_asof']))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['indexed_yahoo'] >= $data[$i]['indexed_yahoo_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['indexed_yahoo'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['indexed_yahoo'], $data[$i]['indexed_yahoo_before'])?></td>
				<td class="number"><?=number_format($data[$i]['indexed_yahoo_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td class="indent2">Bing</td>
				<td class="center" nowrap><?=date("j M",strtotime($data[0]['indexed_asof']))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['indexed_bing'] >= $data[$i]['indexed_bing_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['indexed_bing'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['indexed_bing'], $data[$i]['indexed_bing_before'])?></td>
				<td class="number"><?=number_format($data[$i]['indexed_bing_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td colspan="<?=(2+(sizeof($data)*3))?>" class="section">Social Media</td>
			</tr>
			<tr>
				<td class="indent1">Facebook</td>
				<td colspan="<?=(1+(sizeof($data)*3))?>">&nbsp;</td>
			</tr>
			<tr>
				<td class="indent2">Fans</td>
				<? 
					$facebookAsOf = '';
					for ($i = 0; $i < sizeof($data); $i++) {
						if ($facebookAsOf < $data[$i]['facebook_asof']) {
							$facebookAsOf = $data[$i]['facebook_asof'];
						}
					}
				?>
				<td class="center" nowrap><?=date("j M",strtotime($facebookAsOf))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['fans'] >= $data[$i]['fans_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['fans'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['fans'], $data[$i]['fans_before'])?></td>
				<td class="number"><?=number_format($data[$i]['fans_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td class="indent2">Unsubscribe</td>
				<td class="center" nowrap><?=date("j M",strtotime($facebookAsOf))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['unsubscribe'] <= $data[$i]['unsubscribe_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['unsubscribe'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['unsubscribe'], $data[$i]['unsubscribe_before'], true)?></td>
				<td class="number"><?=number_format($data[$i]['unsubscribe_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td class="indent1">Twitter</td>
				<td colspan="<?=(1+(sizeof($data)*3))?>">&nbsp;</td>
			</tr>
				<? 
					$twitterAsOf = '';
					for ($i = 0; $i < sizeof($data); $i++) {
						if ($twitterAsOf < $data[$i]['twitter_asof']) {
							$twitterAsOf = $data[$i]['twitter_asof'];
						}
					}
				?>

			<tr>
				<td class="indent2">Followers</td>
				<td class="center" nowrap><?=date("j M",strtotime($twitterAsOf))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['followers'] >= $data[$i]['followers_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['followers'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['followers'], $data[$i]['followers_before'])?></td>
				<td class="number"><?=number_format($data[$i]['followers_target'])?></td>
				<? } ?>
			</tr>
			<tr>
				<td class="indent2">Tweets</td>
				<td class="center" nowrap><?=date("j M",strtotime($twitterAsOf))?></td>
				<? for ($i = 0; $i < sizeof($data); $i++) { ?>
				<td class="number <? 
					if ($data[$i]['tweets'] >= $data[$i]['tweets_target']) { 
						echo 'ok'; 
					} else { 
						echo 'notok'; 
					} 
				?>"><?=number_format($data[$i]['tweets'])?>
				</td>
				<td class="indicator"><?=getStrTrend($data[$i]['tweets'], $data[$i]['tweets_before'])?></td>
				<td class="number"><?=number_format($data[$i]['tweets_target'])?></td>
				<? } ?>
			</tr>

		</table>
	</body>
</html>