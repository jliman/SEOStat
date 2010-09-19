<div class="bd">
<form action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" name="export" id="export" value="email">
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("EmailFormSender") ?></span></td>
		<td><span class="phpmaker"><input type="text" name="sender" id="sender" size="30"></span></td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("EmailFormRecipient") ?></span></td>
		<td><span class="phpmaker"><input type="text" name="recipient" id="recipient" size="30"></span></td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("EmailFormCc") ?></span></td>
		<td><span class="phpmaker"><input type="text" name="cc" id="cc" size="30"></span></td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("EmailFormBcc") ?></span></td>
		<td><span class="phpmaker"><input type="text" name="bcc" id="bcc" size="30"></span></td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("EmailFormSubject") ?></span></td>
		<td><span class="phpmaker"><input type="text" name="subject" id="subject" size="50"></span></td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("EmailFormMessage") ?></span></td>
		<td><span class="phpmaker"><textarea cols="50" rows="8" name="message" id="message"></textarea></span></td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("EmailFormContentType") ?></span></td>
		<td><span class="phpmaker">
		<label><input type="radio" name="contenttype" id="contenttype" value="html" checked="checked"><?php echo $Language->Phrase("EmailFormContentTypeHtml") ?></label>
		<label><input type="radio" name="contenttype" id="contenttype" value="url"><?php echo $Language->Phrase("EmailFormContentTypeUrl") ?></label>
		</span></td>
	</tr>
</table>
</form>
</div>
