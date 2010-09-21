<?
$headers = "From: julius@liman.org\r\n";
$headers .= "Reply-to: julius@liman.org\r\n";
$mail_sent = @mail("jliman@gmail.com", "Judul TEST", "Isi TEST", $headers);
echo $mail_sent ? "Terkirim" : "
Gagal";
?> 
