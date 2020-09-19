<?php
mb_internal_encoding("UTF-8");

$aud = new Audition;
$aud->dispHeader();

if($_GET['mode'] === "form"){
	$aud->checkCount();
	$aud->checkMail();
	$aud->dispForm();
}elseif($_GET['mode'] === "confirm"){
	$aud->checkData();
	$aud->dispConfirm();
}elseif($_GET['mode'] === "send"){
	$aud->checkData();
	$aud->sendData();
}else{
	$aud->dispTop();
}
$aud->dispFooter();



class Audition{

	private $tags = array(
		'未選択' => '未選択',
		'ロック' => 'ロック',
		'ポップス' => 'ポップス',
		'トランス' => 'トランス',
		'エレクトロ' => 'エレクトロ',
		'テクノ' => 'テクノ',
		'ゴシック' => 'ゴシック',
		'メタル' => 'メタル',
		'ハードコア' => 'ハードコア',
		'ジャズ' => 'ジャズ',
		'プログレ' => 'プログレ',
		'アンビエント' => 'アンビエント',
		'イージーリスニング' => 'イージーリスニング',
		'クラブ' => 'クラブ',
		'ハウス' => 'ハウス',
		'ピコピコ・チップチューン' => 'ピコピコ・チップチューン',
		'クラシック' => 'クラシック',
		'ファンタジー' => 'ファンタジー',
		'和風' => '和風',
		'民族音楽' => '民族音楽',
		'電波ソング' => '電波ソング',
//		'その他' => 'その他',

		'ボーカロイド' => 'ボーカロイド',
		'オリジナル' => 'オリジナル',
		'東方アレンジ' => '東方アレンジ',
		'その他アレンジ' => 'その他アレンジ',
		'インスト' => 'インスト',
		'女性ボーカル' => '女性ボーカル',
		'男性ボーカル' => '男性ボーカル');



	public function dispHeader(){

		print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		print '<html xmlns="http://www.w3.org/1999/xhtml">';
		print '<head>';
		print '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		print '<title>同人音楽.book -2011 Autumn- 試聴DVD参加サークル募集 | 同人音楽同好会</title>';
		print '<link href="/dod.css" rel="stylesheet" type="text/css" />';
		print '</head>';
		print '<body id="body">';
		print '	<div id="contain" style="height:100%;">';
		print '	<div id="header">';
		print '			<h1><a href="/"><img src="/image/rogo.png" alt="同人音楽同好会" width="333" height="92" /></a></h1>';
		print '			<hr />';
		print '		</div>';

	}

	public function dispFooter(){


		print '	</div>';
		print '<script type="text/javascript">';
		print '<!--';
		print "document.write(\"<img src='http://circle.dojin-music.info/acc/acclog.cgi?\");";

		print "document.write(\"referrer=\"+document.referrer+\"&\");";
		print "document.write(\"width=\"+screen.width+\"&\");";
		print "document.write(\"height=\"+screen.height+\"&\");";
		print "document.write(\"color=\"+screen.colorDepth+\"'>\");";
		print '// -->';
		print '<!--';
		print "document.write(\"<img src='http://circle.dojin-music.info/acc_test/acclog.cgi?');";
		print "document.write(\"referrer=\"+document.referrer+\"&\");";
		print "document.write(\"width=\"+screen.width+\"&\");";
		print "document.write(\"height=\"+screen.height+\"&\");";
		print "document.write(\"color=\"+screen.colorDepth+\"'>\");";
		print "// -->";

		print '</script>';
		print '<script type="text/javascript">';
		print 'var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");';
		print "document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));";
		print '</script>';
		print '<script type="text/javascript">';
		print 'try {';
		print 'var pageTracker = _gat._getTracker("UA-3045582-4");';
		print 'pageTracker._trackPageview();';
		print '} catch(err) {}</script>';

		print '</body>';
		print '</html>';

		exit;

	}

	public function dispForm(){

		$token = new Token;
		$harf_token = $token->setToken($this->email);
		if(!$this->data_url){
			$this->data_url = "http://";
		}
		print "<h1 style=\"width:700px; background-color:#f96; text-align:center; font-size:20px; margin:10px auto;\">試聴DVD参加応募フォーム</h1>";

print "
<div style=\"width:800px; border:1px black solid; margin:5px auto;\">
入力注意<br />
１１枚より多く応募したい方はその旨をメッセージに書き、２回に分けて投稿して下さい。<br />
CD名が入力されなかった枚数以降は無視されます。<br />
→１枚目と３枚目に入力した場合１枚目のみ採用されます<br />
必須とありますが、不必要なCDの部分は入力しなければ無視されます<br />
CD未収録作品は最下部の未収録用テーブルにご入力下さい
<br />
<strong>最低限・サークルの必須情報とCD１枚or未収録作品を登録頂ければ登録完了です</strong>
</div>";

if(isset($this->error)){
	print "<p style=\"text-align:center; border:solid 1px red; width:520px; margin:auto; padding:5px 10px; color:red;\">$this->error</p>";
}

print <<<EOM
<form action="aud_form.php?mode=confirm" method="post">
<input type="hidden" name="token" value="{$harf_token}"/>
<input type="hidden" name="name" value="{$this->name}">
<input type="hidden" name="email" value="{$this->email}">
<input type="hidden" name="cd_num" value="{$_POST['cd_num']}">
<input type="hidden" name="pass" value="{$this->password}">
<table width="600" border style="margin:10px auto;">
<tr><th>名前</th><td>$this->name</td></tr>
<tr><th>メール</th><td>$this->email</td></tr>
<tr><th>音源データURL必須</th><td><input type="text" name="data_url" value="{$this->data_url}" size="60" maxlength="255" /></td></tr>
<tr><th>連絡事項</th><td><textarea cols="60" rows="5" name="message">{$this->message}</textarea></td></tr>
</table>

<table width="700" border style="margin:10px auto;">
<tr><th>サークル名必須</th><td><input type="text" name="circle_name" value="{$this->circle_name}" size="30" maxlength="50" /></td></tr>
<tr><th>サークル読み（カナ）必須</th><td><input type="text" name="circle_kana" value="{$this->circle_kana}" size="40" maxlength="50" /></td></tr>
<tr><th>サークル結成日</th><td>年必須：<input type="text" name="kessei_y" value="{$this->kessei_y}" size="4" maxlength="4" />　月：<input type="text" name="kessei_m" value="{$this->kessei_m}" size="2" maxlength="2" />　日：<input type="text" name="kessei_d" value="{$this->kessei_d}" size="2" maxlength="2" /></td></tr>
<tr><th>サークルサイトURL</th><td><input type="text" name="circle_url" value="{$this->circle_url}" size="50" maxlength="255" /></td></tr>
<tr><th>サークルバナーURL</th><td><input type="text" name="circle_banner" value="{$this->circle_banner}" size="50" maxlength="255" /></td></tr>
<tr><th>固定タグ</th><td>
１必須：<select name="tag1">
EOM;
foreach($this->tags as $value){
	if($this->tag1 == $value){
		print " <option value=\"{$value}\" selected />{$value}</option>";
	}else{
		print " <option value=\"{$value}\" />{$value}</option>";
	}

}
print "</select>\n２：<select name=\"tag2\">";
foreach($this->tags as $value){
	if($this->tag2 == $value){
		print " <option value=\"{$value}\" selected />{$value}</option>";
	}else{
		print " <option value=\"{$value}\" />{$value}</option>";
	}
}
print <<<EOM
</select>
</td></tr>
<tr><th>自由タグ</th><td>１：<input type="text" name="ftag1" value="{$this->ftag1}" size="15" maxlength="20" />　２：<input type="text" name="ftag2" value="{$this->ftag2}" size="15" maxlength="20" /></td></tr>
<tr><th>サークル自己紹介<br />100～400文字<br />必須</th><td><textarea cols="60" rows="5" name="circle_intro">{$this->circle_intro}</textarea></td></tr>
</table>
EOM;
if(!is_numeric($_POST['cd_num']) OR !preg_match('/^[0-9]{1,2}$/',$_POST['cd_num'])){
	$_POST['cd_num']=1;
}
$limit = $_POST['cd_num'];

for($i=1;$i<=$limit;$i++){

	print <<<EOM

<table width="600" border style="margin:10px auto;">
<tr><th colspan="2">{$i}枚目</th></tr>
<tr><th>ＣＤ名必須</th><td><input type="text" name="cd_name[$i]" value="{$this->cd_name[$i]}" size="30" maxlength="50" /></td></tr>
<tr><th>ＣＤ読み（カナ）必須</th><td><input type="text" name="cd_kana[$i]" value="{$this->cd_kana[$i]}" size="40" maxlength="50" /></td></tr>
<tr><th>頒布開始日必須</th><td>年：<input type="text" name="cd_sale_y[$i]" value="{$this->cd_sale_y[$i]}" size="4" maxlength="4" />　月：<input type="text" name="cd_sale_m[$i]" value="{$this->cd_sale_m[$i]}" size="2" maxlength="2" />　日：<input type="text" name="cd_sale_d[$i]" value="{$this->cd_sale_d[$i]}" size="2" maxlength="2" /></td></tr>
<tr><th>初頒布イベント</th><td><input type="text" name="cd_event[$i]" value="{$this->cd_event[$i]}" size="20" maxlength="30" /></td></tr>
<tr><th>ジャケット絵師orデザイナー</th><td><input type="text" name="cd_design[$i]" value="{$this->cd_design[$i]}" size="20" maxlength="30" /></td></tr>
<tr><th>固定タグ</th><td>
１必須：<select name="cd_tag1[$i]">
EOM;
	foreach($this->tags as $value){
		if($this->cd_tag1[$i] == $value){
			print " <option value=\"{$value}\" selected />{$value}</option>";		}else{
			print " <option value=\"{$value}\" />{$value}</option>";
		}
	}
	print "</select>\n２：<select name=\"cd_tag2[$i]\">";
	foreach($this->tags as $value){
		if($this->cd_tag2[$i] == $value){
			print " <option value=\"{$value}\" selected />{$value}</option>";
		}else{
			print " <option value=\"{$value}\" />{$value}</option>";
		}
	}
	print <<<EOM
</select>
</td></tr>
<tr><th>トラックリスト<br />（試聴音源以外も含めたCD全トラック）必須
<div style="position:relative;;">
<a href="javascript:void(0)" onClick="document.getElementById('trackdiv{$i}').style.display='block';">記入例</a>
<div id="trackdiv{$i}" style="display:none; position:absolute; left:10px; top:10px;  width:320px; background-color:#FEF; font-weight:normal; padding:10px;">
01:同人音楽同好会の歌（試聴曲）<br />
　歌：みやわ　作詞：みやわ　作曲：マブ<br />
02:シューティングスター<br />
　歌：みやわ　作詞：芋　作曲：豚<br />
03:おじさん（試聴曲）<br />
　歌：マブ　編曲：マブ<br />
　原曲：おじさんのうた（著作権問題なし）<br />
<br />
歌・作詞作編曲・原曲などは必須ではありません
<br />
<a href="javascript:void(0)" onClick="document.getElementById('trackdiv{$i}').style.display='none';">閉じる</a>
</div></div>
</th><td><textarea cols="50" rows="5" name="cd_track[$i]">{$this->cd_track[$i]}</textarea></td></tr>
<tr><th>CD紹介文<br />100～400文字<br />必須</th><td><textarea cols="50" rows="5" name="cd_intro[$i]">{$this->cd_intro[$i]}</textarea></td></tr>
</table>

EOM;

}
	print <<<EOM
<table width="600" border style="margin:10px auto;">
<tr><th colspan="2">未収録</th></tr>
<tr><th>トラックリスト<br />（曲紹介もあれば）<br />必須</th><td><textarea cols="50" rows="5" name="cd_track_mi">{$this->cd_track_mi}</textarea></td></tr>
</table>
EOM;
	print "<center><input type=\"submit\" value=\"確認\" /></form>";


	}

	public function dispConfirm(){

		$token = new Token;
		if(!$token->checkToken()){
			print "不正なアクセス";
			exit;
		}
		$harf_token = $token->setToken($this->email);


$temp = nl2br($this->message);
print <<<EOM
<form action="aud_form.php?mode=send" method="post">
<input type="hidden" name="token" value="{$harf_token}"/>
<input type="hidden" name="name" value="{$this->name}">
<input type="hidden" name="email" value="{$this->email}">
<input type="hidden" name="cd_num" value="{$_POST['cd_num']}">
<input type="hidden" name="pass" value="{$this->password}">
<table width="600" border style="margin:10px auto;">
<tr><th>名前</th><td>$this->name</td></tr>
<tr><th>メール</th><td>$this->email</td></tr>
<tr><th>音源データURL</th><td>{$this->data_url}<input type="hidden" name="data_url" value="{$this->data_url}" /></td></tr>
<tr><th>連絡事項</th><td>{$temp}<input type="hidden" name="message" value="{$this->message}" /></textarea></td></tr>
</table>

<table width="700" border style="margin:10px auto;">
<tr><th>サークル名</th><td>{$this->circle_name}<input type="hidden" name="circle_name" value="{$this->circle_name}" /></td></tr>
<tr><th>サークル読み（カナ）</th><td>{$this->circle_kana}<input type="hidden" name="circle_kana" value="{$this->circle_kana}" /></td></tr>
<tr><th>サークル結成日</th><td>{$this->kessei_y}年：<input type="hidden" name="kessei_y" value="{$this->kessei_y}" />
EOM;
if(isset($this->kessei_m) && $this->kessei_m !== ""){
	print "{$this->kessei_m}月<input type=\"hidden\" name=\"kessei_m\" value=\"{$this->kessei_m}\" />";
}
if(isset($this->kessei_d) && $this->kessei_d !== ""){
	print "{$this->kessei_d}日<input type=\"hidden\" name=\"kessei_d\" value=\"{$this->kessei_d}\" />";
}
print "</td></tr>";

if(isset($this->circle_url) && $this->circle_url !== ""){
	print "<tr><th>サークルサイトURL</th><td><a href=\"{$this->circle_url}\" target=\"_blank\">{$this->circle_url}</a><input type=\"hidden\" name=\"circle_url\" value=\"{$this->circle_url}\" /></td></tr>";
}
if(isset($this->circle_banner) && $this->circle_banner !== ""){
	print "<tr><th>サークルバナーURL</th><td><a href=\"{$this->circle_banner}\" target=\"_blank\">{$this->circle_banner}</a><input type=\"hidden\" name=\"circle_banner\" value=\"{$this->circle_banner}\" /></td></tr>";
}

print "<tr><th>固定タグ</th><td>
１：";

foreach($this->tags as $value){
	if($this->tag1 == $value){
		print " {$value}<input type=\"hidden\" name=\"tag1\" value=\"{$value}\" />";
	}

}
print "\n２：";
foreach($this->tags as $value){
	if($this->tag2 == $value){
		print " {$value}<input type=\"hidden\" name=\"tag2\" value=\"{$value}\" />";
	}
}
$temp = nl2br($this->circle_intro);
print <<<EOM
</td></tr>
<tr><th>自由タグ</th><td>１：{$this->ftag1}<input type="hidden" name="ftag1" value="{$this->ftag1}" size="15" maxlength="20" />　２：{$this->ftag2}<input type="hidden" name="ftag2" value="{$this->ftag2}" /></td></tr>


<tr><th>サークル自己紹介<br />100～400文字<br />必須</th><td>{$temp}<input type="hidden" name="circle_intro" value="{$this->circle_intro}" /></td></tr>
</table>
EOM;

if(!is_numeric($_POST['cd_num']) OR !preg_match('/^[0-9]{1,2}$/',$_POST['cd_num'])){
	$_POST['cd_num']=1;
}
$limit = $_POST['cd_num'];
print "<input type=\"hidden\" name=\"cd_num\" value=\"{$_POST['cd_num']}\" />";

for($i=1;$i<=$limit;$i++){
	if((!isset($_POST['cd_name'][$i]) || $_POST['cd_name'][$i] == "") && $i >= 2){
		break;
	}
	if($i == 1 && $_POST['cd_track_mi'] != "" && (!isset($_POST['cd_name'][1]) || $_POST['cd_name'][1] == "")){
		break;
	}
	print <<<EOM

<table width="600" border style="margin:10px auto;">
<tr><th colspan="2">{$i}枚目</th></tr>
<tr><th>ＣＤ名</th><td>{$this->cd_name[$i]}<input type="hidden" name="cd_name[$i]" value="{$this->cd_name[$i]}" /></td></tr>
<tr><th>ＣＤ読み（カナ）</th><td>{$this->cd_kana[$i]}<input type="hidden" name="cd_kana[$i]" value="{$this->cd_kana[$i]}" /></td></tr>
<tr><th>頒布開始日</th><td>{$this->cd_sale_y[$i]}年<input type="hidden" name="cd_sale_y[$i]" value="{$this->cd_sale_y[$i]}" />　{$this->cd_sale_m[$i]}月<input type="hidden" name="cd_sale_m[$i]" value="{$this->cd_sale_m[$i]}" />　{$this->cd_sale_d[$i]}日：<input type="hidden" name="cd_sale_d[$i]" value="{$this->cd_sale_d[$i]}" /></td></tr>
EOM;
	if($this->cd_event[$i]){
		print "<tr><th>初頒布イベント</th><td>{$this->cd_event[$i]}<input type=\"hidden\" name=\"cd_event[$i]\" value=\"{$this->cd_event[$i]}\" size=\"20\" maxlength=\"30\" /></td></tr>";
	}
	if($this->cd_design[$i]){
		print "<tr><th>ジャケット絵師orデザイナー</th><td>{$this->cd_design[$i]}<input type=\"hidden\" name=\"cd_design[$i]\" value=\"{$this->cd_design[$i]}\" size=\"20\" maxlength=\"30\" /></td></tr>";
	}

	print "<tr><th>固定タグ</th><td>";
	print "１：";

	foreach($this->tags as $value){
		if($this->cd_tag1[$i] == $value){
			print "  {$value}<input type=\"hidden\" name=\"cd_tag1[$i]\" value=\"{$value}\" />";
		}
	}
	print "\n２：";
	foreach($this->tags as $value){
		if($this->cd_tag2[$i] == $value){
			print "  {$value}<input type=\"hidden\" name=\"cd_tag2[$i]\" value=\"{$value}\" />";
		}
	}
	$temp = nl2br($this->cd_intro[$i]);
	$temp2 = nl2br($this->cd_track[$i]);
	print <<<EOM
</td></tr>
<tr><th>CD紹介文<br />100～400文字<br />必須</th><td>{$temp}<input type="hidden" name="cd_intro[$i]" value="{$this->cd_intro[$i]}" /></td></tr>
<tr><th>トラックリスト<br />100～400文字<br />必須</th><td>{$temp2}<input type="hidden" name="cd_track[$i]" value="{$this->cd_track[$i]}" /></td></tr>
</table>
EOM;

}

	if($this->cd_track_mi){
		$temp = nl2br($this->cd_track_mi);
		print <<<EOM
<table width="600" border style="margin:10px auto;">
<tr><th colspan="2">未収録</th></tr>
<tr><th>トラックリスト<br />必須</th><td>{$temp}<input type="hidden" name="cd_track_mi" value="{$this->cd_track_mi}" /></td></tr>
</table>
EOM;
	}
	print "
	<input type=\"submit\" value=\"送信\" />
	</form>";
	
	}

	public function checkData(){
		$error="";
		if(!isset($_POST['name']) || "" === $_POST['name']){
			print "a";
			exit;
		}
		if(!isset($_REQUEST['email']) OR $_REQUEST['email'] === "" OR !preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_REQUEST['email'])) {
			print "b";
			exit;
		}
		if(!isset($_POST['pass'])){
			print "c";
			exit;
		}
		$this->password =& $_POST['pass'];
		$this->name =& $_POST['name'];
		$this->email =& $_POST['email'];

		$this->message = htmlspecialchars($_POST['message']);
		if($_POST['data_url'] === "" || !preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $_POST['data_url'])){
			$error .= "データURLがおかしいです<br />";
		}
		$this->data_url =& $_POST['data_url'];
		mb_regex_encoding('UTF-8');
//サークルデータ
		if($_POST['circle_name'] === "" || 50 < mb_strlen($_POST['circle_name'] )){
			$error .= "サークル名が入力されていないか、字数が多すぎます<br />";
		}

		$this->circle_name = htmlspecialchars($_POST['circle_name']);
		if($_POST['circle_kana'] === "" || 30 < mb_strlen($_POST['circle_kana'] )){
			$error .= "サークル読みが入力されていないか、字数が多すぎます<br />";
		}elseif(!preg_match("/^[ァ-ヶー]+$/u", $_POST['circle_kana'])){
			$error .= "サークル読みはカタカナでお願いします。<br />";
		}
		$this->circle_kana =& $_POST['circle_kana'];

		if($_POST['kessei_y'] == "" || !preg_match('/^[1-2][0-9]{3}$/',$_POST['kessei_y'])){
			$error .= "結成年が未入力か不正です<br />";
		}
		if($_POST['kessei_m'] != "" && !is_numeric($_POST['kessei_m'])){
			$error .= "結成月が不正です<br />";
		}
		
		if($_POST['kessei_d'] != "" && !is_numeric($_POST['kessei_d'])){
			$error .= "結成日が不正です<br />";
		}
		$this->kessei_y =& $_POST['kessei_y'];
		$this->kessei_m =& $_POST['kessei_m'];
		$this->kessei_d =& $_POST['kessei_d'];

		if($this->kessei_d == ""){
			if($this->kessei_m == ""){
				if(!checkdate(1,1,$this->kessei_y)){
					$error .= "結成日の日程が不正です<br />";
				}
			}else{
				if(!checkdate($this->kessei_m,1,$this->kessei_y)){
					$error .= "結成日の日程が不正です<br />";
				}
			}
		}else{
			if(!checkdate($this->kessei_m,$this->kessei_d,$this->kessei_y)){
				$error .= "結成日の日程が不正です<br />";
			}
		}

		$this->circle_intro = htmlspecialchars($_POST['circle_intro']);
		if($_POST['circle_intro'] === "" || 80 > mb_strlen($_POST['circle_intro']) || 400 < mb_strlen($_POST['circle_intro'])){
			$error .= "サークル紹介文が入力されていないか、字数が範囲内に収まっていません<br />";
		}
		if(isset($_POST['circle_url'])){
		$this->circle_url = htmlspecialchars($_POST['circle_url']);
		if($_POST['circle_url'] != "" && !preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $_POST['circle_url'])){
			$error .= "サークルURLがおかしいです<br />";
		}}
		if(isset($_POST['circle_banner'])){
		$this->circle_banner = htmlspecialchars($_POST['circle_banner']);
		if($_POST['circle_banner'] != "" && !preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $_POST['circle_banner'])){
			$error .= "サークルバナーURLがおかしいです<br />";
		}
		}
		if($_POST['tag1'] == "未選択"){
			$error .= "サークル固定タグ１が入力されていません<br />";
		}

		$this->tag1 =& $_POST['tag1'];
		$this->tag2 =& $_POST['tag2'];
		$this->ftag1 = htmlspecialchars($_POST['ftag1']);
		$this->ftag2 = htmlspecialchars($_POST['ftag2']);


		for($i = 1;$i < 13; $i++){

			if((!isset($_POST['cd_name'][$i]) || $_POST['cd_name'][$i] == "") && $i >= 2){
				break;
			}
			if($i == 1 && $_POST['cd_track_mi'] != "" && (!isset($_POST['cd_name'][1]) || $_POST['cd_name'][1] == "")){
				break;
			}

			if(50 < mb_strlen($_POST['cd_name'][$i] )){
				$error .= "CD名「{$i}」が入力されていないか、字数が多すぎます<br />";
			}
			$this->cd_name[$i] = htmlspecialchars($_POST['cd_name'][$i]);

			if($_POST['cd_kana'][$i] === "" || 30 < mb_strlen($_POST['cd_kana'][$i] )){
				$error .= "CD読み「{$i}」が入力されていないか、字数が多すぎます<br />";
			}elseif(!preg_match("/^[ァ-ヶー]+$/u", $_POST['cd_kana'][$i])){
				$error .= "CD読み「{$i}」はカタカナでお願いします。";
			}
			$this->cd_kana[$i] =& $_POST['cd_kana'][$i];

			if($_POST['cd_sale_y'][$i] === "" || !preg_match('/^[1-2][0-9]{3}$/',$_POST['cd_sale_y'][$i])){
				$error .= "CD「{$i}」の頒布年が未入力か不正です<br />";
			}
			if($_POST['cd_sale_m'][$i] === "" || !is_numeric($_POST['cd_sale_m'][$i])){
				$error .= "CD「{$i}」の頒布月が未入力か不正です<br />";
			}
			
			if($_POST['cd_sale_d'][$i] === "" || !is_numeric($_POST['cd_sale_d'][$i])){
				$error .= "CD「{$i}」の頒布日が未入力か不正です<br />";
			}
			$this->cd_sale_y[$i] =& $_POST['cd_sale_y'][$i];
			$this->cd_sale_m[$i] =& $_POST['cd_sale_m'][$i];
			$this->cd_sale_d[$i] =& $_POST['cd_sale_d'][$i];

			if(!checkdate($this->cd_sale_m[$i],$this->cd_sale_d[$i],$this->cd_sale_y[$i])){
				$error .= "CD「{$i}」の頒布日の日程が不正です<br />";
			}
			if($_POST['cd_event'][$i] !== "" && 30 < mb_strlen($_POST['cd_event'][$i])){
				$error .= "CD「{$i}」の頒布イベントの字数が多すぎます<br />";
			}

			$this->cd_event[$i] = htmlspecialchars($_POST['cd_event'][$i]);
			$this->track_list[$i] = htmlspecialchars($_POST['track_list'][$i]);

			if($_POST['cd_tag1'][$i] == "未選択"){
				$error .= "CD「{$i}」の固定タグ１が入力されていません<br />";
			}
			$this->cd_tag1[$i] =& $_POST['cd_tag1'][$i];
			$this->cd_tag2[$i] =& $_POST['cd_tag2'][$i];
			if($_POST['cd_design'][$i] !== "" && 50 < mb_strlen($_POST['cd_design'][$i])){
				$error .= "CD「{$i}」のジャケットデザイナー・絵師の文字数が多すぎます<br />";
			}
			$this->cd_design[$i] = htmlspecialchars($_POST['cd_design'][$i]);

			$this->cd_intro[$i] = htmlspecialchars($_POST['cd_intro'][$i]);
			if($_POST['cd_intro'][$i] == "" || 80 > mb_strlen($_POST['cd_intro'][$i]) || 400 < mb_strlen($_POST['cd_intro'][$i])){
				$error .= "CD「{$i}」紹介文が入力されていないか、字数が範囲内に収まっていません<br />";
			}
			$this->cd_track[$i] = htmlspecialchars($_POST['cd_track'][$i]);
			if($_POST['cd_track'][$i] === "" || 10000 < mb_strlen($_POST['cd_track'][$i])){
				$error .= "CD「{$i}」トラックリストが入力されていないか、長すぎます<br />";
			}

		}
		$this->cd_track_mi = htmlspecialchars($_POST['cd_track_mi']);
		if($error){
			$this->error = $error;
			$this->dispForm();
			$this->dispFooter();
		}
	}


	public function sendData(){

		$token = new Token;
		if(!$token->checkToken()){
			print "不正なアクセス";
			exit;
		}

		$sql = new Sql;
		$sql->connectSql();

		$message = "
名前：{$this->name}
メール：{$this->email}
音源データURL：{$this->data_url}

連絡事項：
{$this->message}

-------------------------

サークル名：{$this->circle_name}
サークル読み（カナ）：{$this->circle_kana}
サークル結成日：{$this->kessei_y}年{$this->kessei_m}月{$this->kessei_d}日
サークルサイトURL：{$this->circle_url}
サークルバナーURL：{$this->circle_banner}
固定タグ１：{$this->tag1}
固定タグ２：{$this->tag2}
自由タグ１：{$this->ftag1}
自由タグ２：{$this->ftag2}
サークル紹介：
{$this->circle_intro}
";



		$this->email = mysql_real_escape_string($this->email);
		$this->password = mysql_real_escape_string($this->password);
		$this->data_url = mysql_real_escape_string($this->data_url);
		$this->message = mysql_real_escape_string($this->message);
		$this->circle_name = mysql_real_escape_string($this->circle_name);
		$this->circle_kana = mysql_real_escape_string($this->circle_kana);
		$this->kessei_y = mysql_real_escape_string($this->kessei_y);
		$this->kessei_m = mysql_real_escape_string($this->kessei_m);
		$this->kessei_d = mysql_real_escape_string($this->kessei_d);
		$this->circle_url = mysql_real_escape_string($this->circle_url);
		$this->circle_banner = mysql_real_escape_string($this->circle_banner);
		$this->tag1 = mysql_real_escape_string($this->tag1);
		$this->tag2 = mysql_real_escape_string($this->tag2);
		$this->ftag1 = mysql_real_escape_string($this->ftag1);
		$this->ftag2 = mysql_real_escape_string($this->ftag2);
		$this->circle_intro = mysql_real_escape_string($this->circle_intro);

		$sql->sendQuery("insert into `aud_circle` values(NULL,'{$this->email}','{$this->password}','{$this->data_url}','{$this->message}','{$this->circle_name}','{$this->circle_kana}','{$this->kessei_y}年{$this->kessei_m}月{$this->kessei_d}日','{$this->circle_url}','{$this->circle_banner}','{$this->tag1}','{$this->tag2}','{$this->ftag1}','{$this->ftag2}','{$this->circle_intro}','','0')");

		$circle_id = mysql_insert_id();
		if(!is_numeric($_POST['cd_num']) OR !preg_match('/^[0-9]{1,2}$/',$_POST['cd_num'])){
			$_POST['cd_num']=1;
		}
		$limit = $_POST['cd_num'];
		print "<input type=\"hidden\" name=\"cd_num\" value=\"{$_POST['cd_num']}\" />";

		for($i=1;$i<=$limit;$i++){
			if((!isset($this->cd_name[$i]) || $this->cd_name[$i] === "") && $i >=2){
				break;
			}
			if($i == 1 && $this->cd_track_mi != "" && (!isset($this->cd_name[1]) || $this->cd_name[1] == "")){
				break;
			}
	$message .= "
-------------------------------------
{$i}枚目
ＣＤ名：{$this->cd_name[$i]}
ＣＤ読み（カナ）：{$this->cd_kana[$i]}
頒布開始日：{$this->cd_sale_y[$i]}年{$this->cd_sale_m[$i]}月{$this->cd_sale_d[$i]}日
初頒布イベント：{$this->cd_event[$i]}
ジャケット絵師orデザイナー：{$this->cd_design[$i]}
固定タグ１：{$this->cd_tag1[$i]}
固定タグ２：{$this->cd_tag2[$i]}
紹介：
{$this->cd_intro[$i]}

トラックリスト
{$this->cd_track[$i]}
";

		$this->cd_name[$i] = mysql_real_escape_string($this->cd_name[$i]);
		$this->cd_kana[$i] = mysql_real_escape_string($this->cd_kana[$i]);
		$this->cd_sale_y[$i] = mysql_real_escape_string($this->cd_sale_y[$i]);
		$this->cd_sale_m[$i] = mysql_real_escape_string($this->cd_sale_m[$i]);
		$this->cd_sale_d[$i] = mysql_real_escape_string($this->cd_sale_d[$i]);
		$this->cd_event[$i] = mysql_real_escape_string($this->cd_event[$i]);
		$this->cd_design[$i] = mysql_real_escape_string($this->cd_design[$i]);
		$this->cd_tag1[$i] = mysql_real_escape_string($this->cd_tag1[$i]);
		$this->cd_tag2[$i] = mysql_real_escape_string($this->cd_tag2[$i]);
		$this->cd_intro[$i] = mysql_real_escape_string($this->cd_intro[$i]);
		$this->cd_track[$i] = mysql_real_escape_string($this->cd_track[$i]);

		$sql->sendQuery("insert into `aud_cd` values(NULL,'{$circle_id}','{$i}','{$this->cd_name[$i]}','{$this->cd_kana[$i]}','{$this->cd_sale_y[$i]}年{$this->cd_sale_m[$i]}月{$this->cd_sale_d[$i]}日','{$this->cd_event[$i]}','{$this->cd_design[$i]}','{$this->cd_tag1[$i]}','{$this->cd_tag2[$i]}','{$this->cd_intro[$i]}','{$this->cd_track[$i]}')");
	}

	if($this->cd_track_mi){
	$message .= "
-------------------------------------
CD未収録
$this->cd_track_mi

";
		$this->cd_track_mi = mysql_real_escape_string($this->cd_track_mi);
		$sql->sendQuery("insert into `aud_cd` values(NULL,'{$circle_id}','12','未収録','','','','','','','','{$this->cd_track_mi}')");
}

mb_language('ja');
mb_internal_encoding("UTF-8");
$headers = "From: " . mb_encode_mimeheader($this->name) . "<$this->email>" . "\r\n" .
   "Reply-To: " . mb_encode_mimeheader($this->name) . "<$this->email>" . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
$parameter = "-finfo@{$_SERVER['SERVER_NAME']}";
$flag = mb_send_mail('webmaster@dojin-music.info', '同人音楽同好会 - 試聴DVD', mb_convert_encoding($message, "iso-2022-jp", "UTF-8"), $headers, $parameter);
$headers = "From: " . mb_encode_mimeheader("同人音楽同好会") . "<webmaster@dojin-music.info>" . "\r\n" .
   "Reply-To: " . mb_encode_mimeheader("同人音楽同好会") . "<webmaster@dojin-music.info>" . "\r\n" .
   'X-Mailer: PHP/' . phpversion();

$message = "投稿頂きありがとうございます。
以下の内容が送信されました。最新の情報は
http://circle.dojin-music.info/2011au/aud.php
最下部の確認フォームからご確認頂けます。

" . $message;
$flag2= mb_send_mail($this->email, '同人音楽同好会 - 試聴DVD応募', mb_convert_encoding($message, "iso-2022-jp", "UTF-8"), $headers, $parameter);

		$fp = fopen("count.txt","r");
		$count = intval(fgets($fp, 4096));
		fclose($fp);
		$count++;
		$fp = fopen("count.txt","w");
		fputs($fp,$count);
		fclose($fp);

		if($flag){ 

		print "<h1 class=\"list_title\">応募完了</h1>";
		print "\n<div class=\"contact_cont\" style=\"text-align:center;\">\n";

		print <<<EOM
	<div style="width:700px; margin:auto; text-align:left;">
	<h2>応募ありがとうございました</h2>
	投稿内容は登録したメールアドレス宛のメールか、後日設置予定の確認画面からご確認下さい。<br />
	９月１日以降にご連絡致します<br />
	今後も同人音楽同好会をよろしくお願いします。<br />
	<br />
	<a href="/">トップページへ戻る</a></div>

</div>
EOM;
		}

	}

	public function checkMail(){
		if(!isset($_REQUEST['name']) || "" === $_REQUEST['name']){
			$this->dispTop("名前が記入されていません");
			$this->dispFooter();
		}
		if(!isset($_REQUEST['email']) OR $_REQUEST['email'] === "" OR !preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_REQUEST['email'])) {
			$this->dispTop("メールが不正です");
			$this->dispFooter();
		}
		if(!isset($_POST['pass'])){
			if(!isset($_REQUEST['password']) || "" === $_REQUEST['password']){
				$this->dispTop("パスワードが記入されていません");
				$this->dispFooter();
			}
			if(!isset($_REQUEST['password2']) || "" === $_REQUEST['password2']){
				$this->dispTop("パスワード確認が記入されていません");
				$this->dispFooter();
			}
			if($_REQUEST['password'] !== $_REQUEST['password2']){
				$this->dispTop("パスワード二つが一致しません");
				$this->dispFooter();
			}
			$this->password = md5($_REQUEST['password']);
		}else{
			$this->password = $_POST['pass'];
		}

		$this->name = $_REQUEST['name'];
		$this->email = $_REQUEST['email'];



	}

	public function checkCount(){
		$fp = fopen("count.txt","r");
		$count = intval(fgets($fp, 4096));
		fclose($fp);
		if(200 < $count){
			print "<center><strong><font color=\"red\">募集サークルが一杯になった為、一時募集を締め切っております。<br />追加募集を行う予定ですのでしばらくお待ち下さい。</font></strong></center>";
		$this->dispFooter();
		}
//		$count++;
//		$fp = fopen("count.txt","w");
//		fputs($fp,$count);
//		fclose($fp);
	}

	public function dispTop($mes=""){

if($mes){
	$mes = "<p style=\"text-align:center; border:solid 1px red; width:520px; margin:auto; padding:5px 10px; color:red;\">$mes</p>";
}

print <<<EOM
<h1 style="width:700px; background-color:#f96; text-align:center; font-size:20px; margin-bottom:10px; margin-left:10px;">試聴DVD参加サークル募集</h1>
<div class="contact_cont" style="text-align:center;">

	<table style="border:solid 1px #000; text-align:left; width:500px; margin:auto;">
	<tr><td>

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
<br />

<strong>締切は８月３１日の予定です。</strong>

</div>
</td></tr>
</table>
</div>

{$mes}
<form action="aud_form.php?mode=form" method="post">
<table style="margin:auto;">
<tr><th>お名前</th><td><input type="text" name="name" /></td></tr>
<tr><th>メール</th><td><input type="text" name="email" /></td></tr>
<tr><th>パスワード</th><td><input type="password" name="password" /></td></tr>
<tr><th>パスワード確認</th><td><input type="password" name="password2" /></td></tr>
<input type="hidden" name="cd_num" value="11">
<tr><td colspan="2"><input type="submit" value="投稿フォームへ"></td></tr>
</table>
</form>



EOM;
	}
}

class Token{

	private function createToken($key){
		$ipad = getenv('REMOTE_ADDR');
		$time = time();
		$rand = mt_rand();

		$key = hash( 'sha256', $key );
		$time = hash( 'md5', $time );
		$rand = hash( 'md5', $rand );
		$ready_token = $key . $time . $rand;
		$token = hash( 'sha256', $ready_token );
		return $token;
	}

	public function setToken($key){
		$original_token = $this->createToken($key);
		$half = substr( $original_token, 0, 10 );
		$_SESSION['half_token'] = substr( $original_token, 10 );
		$_SESSION['original_token'] = $original_token;
		return $half;
	}

	public function checkToken(){
		$ch_token = $_SESSION['original_token'];
		$token = $harf_token.$_SESSION['harf_token'];
		if( strcmp( $ch_token, $token ) === 0 ){
			return true;
		}
		return false;
	}
}

class Sql{

	public function connectSql(){
		$db_host = "mysql239.db.sakura.ne.jp";
		$db_user = "dojin-music";
		$db_pass = "mufohenn";
		$db_name = "dojin-music";
		$con = mysql_pconnect("$db_host","$db_user","$db_pass");	//サーバーに接続
		if ($con == false) {
			error("データベースConnectionエラー (ErrorCode : DB1)<br />サーバーがメンテナンス中の可能性があります。");
		}
		$ret = mysql_select_db("$db_name");	//データベースを選択
		if ($ret == false) {
			error("データベースエラー (ErrorCode : DB2)");
		}
		mysql_query("SET NAMES utf8");
		return $con;
	}

	public function sendQuery($sql){
		$qs = $_SERVER["QUERY_STRING"];
		$sn = $_SERVER["SCRIPT_NAME"];
		$result = mysql_query($sql);	//Queryを実行
		if ($result == false) {
			$error = mysql_error();
			mysql_query("ROLLBACK");
			$mail_body = <<<EOM
SQL : $sql
Error : $error
$qs
$sn
$_SERVER[REMOTE_ADDR]

EOM;
			mb_send_mail("webmaster@dojin-music.info","[dojin-music] データベースエラー",$mail_body,"From: admin@tokyo-gallery.net");
			print("データベースエラー (ErrorCode : DB3)");

		}
		return $result;
	}

}

?>