<?php

// Call Row_Rendering event
$tbl_group_profile->Row_Rendering();

// id_group
$tbl_group_profile->id_group->CellCssStyle = ""; $tbl_group_profile->id_group->CellCssClass = "";
$tbl_group_profile->id_group->CellAttrs = array(); $tbl_group_profile->id_group->ViewAttrs = array(); $tbl_group_profile->id_group->EditAttrs = array();

// id_profile
$tbl_group_profile->id_profile->CellCssStyle = ""; $tbl_group_profile->id_profile->CellCssClass = "";
$tbl_group_profile->id_profile->CellAttrs = array(); $tbl_group_profile->id_profile->ViewAttrs = array(); $tbl_group_profile->id_profile->EditAttrs = array();

// Call Row_Rendered event
$tbl_group_profile->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $tbl_group_profile->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $tbl_group_profile->id_group->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $tbl_group_profile->id_profile->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $tbl_group_profile->id_group->CellAttributes() ?>>
<div<?php echo $tbl_group_profile->id_group->ViewAttributes() ?>><?php echo $tbl_group_profile->id_group->ListViewValue() ?></div></td>
			<td<?php echo $tbl_group_profile->id_profile->CellAttributes() ?>>
<div<?php echo $tbl_group_profile->id_profile->ViewAttributes() ?>><?php echo $tbl_group_profile->id_profile->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
