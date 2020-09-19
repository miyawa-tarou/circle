<?php
include("../function.php");
header_txt("試聴DVD音源募集 - ","試聴DVD音源募集");




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
	if ($email === ""){ $flag = TRUE; $error .= "メールアドレスが入力されていません<br />";}else{
	if (preg_match('/^[a-zA-Z0-9_\.\-]+?@[A-Za-z0-9_\.\-]+$/',$email) == FALSE){ $flag = TRUE; $error .= "Ｅメールの入力形式が間違っています<br />";}
	}
	if ($genre === ""){ $flag = TRUE; $error .= "投稿内容が入力されていません<br />";}
	if ($file_url === ""){ $flag = TRUE; $error .= "ファイルURLが入力されていません";}
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
	<tr><th>種類</th><td>$genre</td></tr>
	<tr><th>ファイルURL</th><td>$file_url</td></tr>
	<tr><th>メッセージ</th><td>$mes_br</td></tr>

<form action="contact.php?m=send" method="post">
	<tr><td colspan="2" class="contact_submit">
<input type="submit" value="送信"></td></tr>

<input type="hidden" name="name" value="{$name}"><input type="hidden" name="email" value="{$email}"><input type="hidden" name="url" value="$url"><input type="hidden" name="message" value="{$message}"><input type="hidden" name="genre" value="{$genre}"><input type="hidden" name="file_url" value="{$file_url}">
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
	$str .= "返信希望：$reply_n\n";
	$str .= "----------------------------------------------------\n\n";

$message = $str . $message;
mb_language('ja');
mb_internal_encoding("EUC-JP");
$headers = "From: " . mb_encode_mimeheader($name) . "<$email>" . "\r\n" .
   "Reply-To: " . mb_encode_mimeheader($name) . "<$email>" . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
$parameter = "-finfo@{$_SERVER['SERVER_NAME']}";
$flag = mb_send_mail('webmaster@dojin-music.info', '同人音楽同好会 - 公募投稿', mb_convert_encoding($message, "iso-2022-jp", "EUC-JP"), $headers, $parameter);

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

	print "<h1 style=\"width:700px; background-color:#f96; text-align:center; font-size:20px; margin-bottom:10px; margin-left:10px;\">試聴DVD参加サークル募集</h1>";
	print "\n<div class=\"contact_cont\" style=\"text-align:center;\">\n";

	if($error){
		print "\t<p style=\"text-align:center; border:solid 1px red; width:520px; margin:auto; padding:5px 10px; color:red;\">$error</p>";
	}

	print <<<EOM

	<table style="border:solid 1px #000; text-align:left; width:500px;">
	<tr><td>
<h2>締切</h2>
<div style="margin:0 20px 10px 30px;">
<font color="red"><strong>追加募集を開始しました<br />
締切は９月１５日になります。</strong></font>
</div>

<h2>対象と概要</h2>
<div style="margin:0 20px 10px 30px;">
対象：同人音楽サークル（イベント参加・同人店舗委託しているサークル）<br />
<br />
<a href="/book1/">同人音楽.book</a>で行った、同人音楽サークルの試聴DVD第２弾です。<br />
同人音楽.bookは、同人音楽を聴くのが初めての人から、そればかり聴く同人音楽フリークの人まで楽しめる、本として制作しております。<br />
本募集はM3-2011秋に発行予定の同人音楽.bookの１コンテンツである、同人音楽サークルから紹介となる試聴音源を募集し掲載するDVDの掲載音源募集です。<br />
WEBや即売会とは違った紹介の機会になるかと思います。<br />
是非ご参加下さい！
</div>
<h2>募集詳細</h2>
<div style="margin:0 20px 10px 30px;">
音源に関しては以下の条件でお願いしております。
<ul style="margin-left:20px;">
<li>著作権等の権利上問題のないオリジナル作品・アレンジ作品（東方など）
<li>今回ボイスドラマは対象外とさせて頂きます(今後ボイドラ特集CDなどは考えています)
<li>１つのCDに１曲から掲載致します
<li>掲載CDに関しては、試聴がない曲の情報も公開します
<li>128kbps以上のMP3形式
<li>ショートバージョン・フルバージョン等問いません
<li>ただし曲として完結している形（クロスフェード不可）
<li>フェードアウトで終わる形ならば可
</ul>

曲数は問いませんが上記を守った上で、全ての容量で <strong>40MB以内</strong>でお願いします(Zip等で圧縮してではなく、MP3各ファイルのサイズ合計値です)<br />
<br />
頂いた音源は<strong>DVDからファイルコピーで取り出せる形式</strong>となりますのでご了承下さい。<br />
こういった機会ですので、WEBで試聴公開されていないものであったり、未収録音源等は非常に嬉しいです<br />
今回は同好会メンバーがサークル紹介文（と感想…もあるかも）も掲載致します。

</div>
<h2>頒布前のＣＤについて</h2>
<div style="margin:0 20px 10px 30px;">
頒布前のCDの作品についても応募可能です。<br />
【頒布前】の目印が付きます<br />
決まっている内容だけを掲載します(タイトル等未定でも大丈夫です)
</div>
<h2>ＭＰ３のタグ</h2>
<div style="margin:0 20px 10px 30px;">
管理や試聴者の利便性を考え、MP3タグの入力をお願いします。<br />
入力内容は曲名とアーティスト名の記入をお願いします。基本的に間違った情報で無ければ形式等は自由ですが、<strong>アーティスト名はどこが制作したかわかるようにサークル名をいれてください</strong>
</div>

<h2>その他</h2>
<div style="margin:0 20px 10px 30px;">
参加いただいたサークルの方へ、わずかばかりのお礼ですが、完成品を一セット差し上げます。<br />
</div>
</td></tr>
</table>

</div>

EOM;


	print "<a name=\"pre_ready\"><h1 style=\"width:700px; background-color:#f96; text-align:center; font-size:20px; margin:30px 10px 10px 10px;\">試聴DVD参加の為に準備頂く情報</h1></a>";
	print "\n<div class=\"contact_cont\" style=\"text-align:center;\">\n";

	print <<<EOM

	<table style="border:solid 1px #000; text-align:left; width:500px;">
	<tr><td>
<div style="margin:0 20px 10px 30px;">
各項目で公序良俗に反するなど掲載に不適切と判断した場合は掲載しない事があります
</div>


<h2>データ</h2>
<div style="margin:0 20px 10px 30px;">
データはご自身のサーバーかどこかのアップローダにアップしていただきます
<ul style="margin-left:20px;">
<li>総容量40MB以下
<li>ジャケット画像(必須ではありませんが、ご用意いただける際は300×300ピクセルに変更するのでそれ以上のサイズでお願いします)
<li>各楽曲はmp3形式、128kbps、mp3タグ情報あり、一曲一ファイル
<li>フォルダ構造としては、CDごとにフォルダを作り、各フォルダに該当曲とジャケット画像をお願いします
<li><font color="red">上記以外の楽曲関連情報も掲載可能です。例えば歌詞とかPVとか。ただしページに埋め込む形ではなく、直接そのファイルへリンクする形となります。歌詞なら画像(GIF,PNG,JPG)、PDF、TXTなどで作成して下さい。</font>
</ul>
以下のようにフォルダ構造を作り圧縮などして頂けるとありがたいです
<pre>
┳ＣＤ１名┳トラック２名.mp3
┃　　　　┣トラック４名.mp3
┃　　　　┣トラック５名.mp3
┃　　　　┗jacket.jpg
┣ＣＤ２名┳トラック１名.mp3
┃　　　　┣トラック２名.mp3
・
・
・
</pre>
</div>
<h2>まだ収録出来てない楽曲について</h2>
<div style="margin:0 20px 10px 30px;">
<font color="red">１０月の新譜などの楽曲で掲載したいけど締切までに間に合わない曲などがある方もいるようなので、以下のようにします<br />
<ul style="margin-left:20px;">
<li>CD・トラック情報は締切までにご入力下さい
<li>準備出来ているものだけお送り下さい
<li>メッセージ欄に遅れて提出する旨をご記入下さい
<li><strong>9月15日</strong>までに確認用に届いたメールの返信先にデータ（のURL）をお送り下さい
</ul>
すでに投稿済みの方で、要項変更で投稿内容を追加したい場合は届いているメールにご連絡下さい。
</font>
</div>
</td></tr>
</table>
</div>




<hr style="margin:20px 0;" />
<h2>投稿内容確認フォーム</h2>

<form action="aud_confirm.php" method="post">
<table style="margin:auto;">
<input type="hidden" name="mode" value="confirm" />
<tr><th>メール</th><td><input type="text" name="email" size="30" /></td></tr>
<tr><th>パスワード</th><td><input type="password" name="password" size="10" /></td></tr>
<tr><th colspan="2"><input type="submit" value="確認" /></td></tr></table>
</form>



EOM;

}


?>