<?php
include("../function.php");
header_txt("公募投稿 - ","公募投稿");




$_POST = array_map('htmlspecialchars', $_POST); 
$_POST = array_map('stripslashes', $_POST); 
if($_GET{"m"} === "confirm"){ confirm($_POST{'name'}, $_POST{'email'}, $_POST{'url'}, $_POST{'message'},$_POST{'genre'},$_POST{'file_url'}); }
elseif($_GET{"m"} === "send"){ send_me($_POST{'name'},$_POST{'email'},$_POST{'url'},$_POST{'message'},$_POST{'genre'},$_POST{'file_url'}); }
else{entry("","","","","","","");}

footer();


function confirm($name,$email,$url,$message,$genre,$file_url) {
	$error="";
	$flag = FALSE;

	if ($name === ""){ $flag = TRUE; $error .= "名前が入力されていません<br .>";}
	if ($email === ""){ $flag = TRUE; $error .= "メールアドレスが入力されていません<br />";}elseif(preg_match('/^[a-zA-Z0-9_\.\-]+?@[A-Za-z0-9_\.\-]+$/',$email) == FALSE){ $flag = TRUE; $error .= "Ｅメールの入力形式が間違っています<br />";}
//	if ($genre === ""){ $flag = TRUE; $error .= "投稿内容が入力されていません<br />";}
	if ($file_url === ""){ $flag = TRUE; $error .= "ファイルURLが入力されていません";}elseif (!preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $file_url)) {
		$flag = TRUE;
		$error .= "ファイルURLの形式が不正です<br />";
	}
	if ($url !== "" AND !preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $url)) {
		$flag = TRUE;
		$error .= "URLの形式が不正です<br />";
	}


	if($flag){ entry($error,$name,$email,$url,$message,$genre,$file_url);
	}else{

	print "<h1 class=\"list_title\">送信内容確認</h1>";
	print "\n<div class=\"contact_cont\" style=\"text-align:center;\">\n";
	$mes_br = nl2br("$message");
print <<<EOM

<table cellspacing="0" class="contact_table" border="1">
	<tr><th colspan="2" class="contact_title">送信内容</th></tr>
	<tr><th>お名前</th><td>$name</td></tr>
	<tr><th>メール</th><td>$email</td></tr>
	<tr><th>ＵＲＬ</th><td>$url<br></td></tr>
	<tr><th>ファイルURL</th><td>$file_url</td></tr>
	<tr><th>メッセージ</th><td>$mes_br</td></tr>

<form action="contest.php?m=send" method="post">
	<tr><td colspan="2" class="contact_submit">
<input type="submit" value="送信"></td></tr>

<input type="hidden" name="name" value="{$name}"><input type="hidden" name="email" value="{$email}"><input type="hidden" name="url" value="$url"><input type="hidden" name="message" value="{$message}"><input type="hidden" name="file_url" value="{$file_url}">
</form>
</table>
</div>

EOM;
	}
}




function send_me($name,$email,$url,$message,$genre,$file_url){

//　連続投稿１分
	$addr   = @$_SERVER["REMOTE_ADDR"];
	$time_sec = time();
	$fi = file("sendlist1.txt");
	$inse = "";
	$flag=0;
foreach ($fi as $value){
	$a = split("<>", $value);
	if($a[1] > $time_sec - 60){
	$inse .= "$a[0]<>$a[1]\n";
	if($addr === $a[0]){ $flag=1; }
	}
}

/*
$refer = $_SERVER["HTTP_REFERER"];
if($refer !== 'http://www.dojin-music.info/contact.php?m=confirm'){ 
	print "<h1 class=\"list_title\">エラー</h1>";
	print "\n<div class=\"contact_cont\" style=\"text-align:center;\">\n";

print <<<EOM

	外部からの送信は出来ません。<br />
	ご質問・お問い合わせ等がある場合は所定のフォームをご利用下さい。
	<br />
	<br />
	<a href="/">トップページへ戻る</a>

</div>
EOM;

 }else
*/
if($flag == 1){


entry("連続投稿は６０秒以上あけて行って下さい",$name,$email,$url,$message,$genre,$file_url);

}else{

$inse .= "$addr<>$time_sec\n";
$fp = fopen("sendlist1.txt","w");
fputs($fp,$inse);
fclose($fp);

$message = wordwrap($message, 70);
$message = $file_url . "\n" . $message;
	$date   = gmdate("Y/m/d H:i:s (D)",time()+9*60*60);
	$agent  = @$_SERVER["HTTP_USER_AGENT"];
	$r_host = @$_SERVER["REMOTE_HOST"];
	$h_host = @$_SERVER["HTTP_HOST"];

	$str  = "----------------------------------------------------\n";
	$str .= "送信者名：$name\n";
	$str .= "メールアドレス：$email\n";
	$str .= "ＵＲＬ：$url\n";
	$str .= "送信時間：$date\n";
	$str .= "送信者のIPアドレス：$addr\n";
	$str .= "送信者のホスト名：$r_host\n";
	$str .= "送信者のブラウザ：$agent\n";
	$str .= "----------------------------------------------------\n\n";

$message = $str . $message;
mb_language('ja');
mb_internal_encoding("UTF-8");
$headers = "From: " . mb_encode_mimeheader($name) . "<$email>" . "\r\n" .
   "Reply-To: " . mb_encode_mimeheader($name) . "<$email>" . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
$parameter = "-finfo@{$_SERVER['SERVER_NAME']}";
$flag = mb_send_mail('webmaster@dojin-music.info', '同人音楽同好会 - 公募投稿', mb_convert_encoding($message, "iso-2022-jp", "UTF-8"), $headers, $parameter);

	if($flag){ 

	print "<h1 class=\"list_title\">送信完了</h1>";
	print "\n<div class=\"contact_cont\" style=\"text-align:center;\">\n";

	print <<<EOM
	<h2>投稿ありがとうございました</h2>
	問題がなければ数日以内に受理のメールをお送り致します。<br />
	しばらくして受理のメールが無いようでしたらご連絡お願いします<br />
	今後も同人音楽同好会をよろしくお願いします。<br />
	<br />
	<a href="/">トップページへ戻る</A>

</div>
EOM;


	}else{entry("送信に失敗しました",$name,$email,$url,$message,$genre,$file_url);}
}

}

function entry($error,$name,$email,$url,$message,$genre,$file_url){

	print "<h1 style=\"width:700px; background-color:#f96; text-align:center; font-size:20px; margin-bottom:10px; margin-left:10px;\">公募投稿フォーム</h1>";
	print "\n<div class=\"contact_cont\" style=\"text-align:center;\">\n";

	if($error){
		print "\t<p style=\"text-align:center; border:solid 1px red; width:520px; margin:auto; padding:5px 10px; color:red;\">$error</p>";
	}

	print <<<EOM

	<table style="border:solid 1px #000; text-align:left; width:500px;">
	<tr><td>


<h3>好きな同人音楽を共有してみませんか？</h3>

<h2>対象と概要</h2>
<div style="margin:0 20px 10px 30px;">
今回の公募の対象は「同人音楽サークルとして作り手になったことのない<strong>聴き専</strong>」が対象<br />
毎回様々な人に書いて頂いている「<strong>オススメCD10選</strong>」の文章を募集します
</div>
<h2>形式</h2>
<div style="margin:0 20px 10px 30px;">
自己紹介等一言は、300〜500字程度<br />
同人音楽CDから10枚選定頂き、感想・レビューなどを一枚あたり「175字以内」<br />
→<a href="sample10.pdf">サンプル(過去に掲載したもの)</a><br />
<br />
選ばれるＣＤは基本的には自由で、
<ul style="margin-left:20px;">
 <li>ジャンルが偏っていて問題ありません</li>
 <li>同じサークルから選ぶのもＯＫです</li>
 <li>手に入りづらいものでも構いません</li>
 <li>ボイスドラマでも問題ありません</li>
 <li>コンセプトを付けて選定いただいても構いません</li>
</ul>
</div>
<h2>採用選定について</h2>
<div style="margin:0 20px 10px 30px;">
選ぶ公募ではないので、<br />
倫理的に問題がある、形式が違う、作り手である(今回の募集は聴き専のみです)、等の掲載に問題があると判断した場合を除き、採用したいとは思っておりますが、応募数によっては全て掲載しきれない可能性があります。
</div>
<h2>サークルへの連絡</h2>
<div style="margin:0 20px 10px 30px;">
掲載するサークルへは、こちらから連絡致します。<br />
サークルの方が掲載を拒否した場合は書き直しして頂くことになります。ご了承ください。
</div>
<h2>その他</h2>
<div style="margin:0 20px 10px 30px;">
採用の際は、わずかばかりのお礼ですが、完成品を一セット差し上げます。<br />
<br />
<a href="sample.txt">アップロードファイルサンプル</a>（後日もう少しまともなのにします）<br />
<br />
ご質問等ございましたら、dob_book☆doujin-ongaku.org にお願いします。<br />
返信不要のものは<a href="/contact.php">こちらからでも構いません</a><br />
<br />
<strong>〆切：９月１５日</strong>
</div>
</td></tr>
</table>

	<br />

	<form action="contest.php?m=confirm" method="post">
	<font color="red">☆</font>は必須項目です。
	<table border="1" cellspacing="0" style="margin:auto; text-align:left; width:550px;">
		<tr><th colspan="2" class="contact_title">投稿用フォーム</th></tr>
		<tr><th>名前<font color="red">☆</font></th><td><input type="text" size="14" name="name" value="$name"></td></tr>
		<tr><th>メール<font color="red">☆</font></th><td class="left"><input type="text" size="35" name="email" value="$email"></td></tr>
		<tr><th>ＵＲＬ</th><td class="left"><input type="text" size="50" name="url" value="$url"></td></tr>

		<tr><th>ファイルURL<font color="red">☆</font></th><td class="left">
アップローダ（またはお持ちのスペース）をお使い下さい：<a href="upload.php" target="_blank">アップローダ</a>
<input type="text" size="50" name="file_url" value="$file_url"></td></tr>

		<tr><th>なにかメッセージがあれば</th><td class="left">
		<textarea cols="48" rows="7" name="message">$message</textarea></td></tr>
		<tr><td colspan="2" class="contact_submit"><input type="submit" value="　確認　"></td></tr>
	</table>
	</form>
</div>
EOM;


}


?>