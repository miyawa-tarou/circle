<?php
include('function.php');
header_txt("茶太さんアンケート","茶太");

$age = array("-12" => "12歳以下","13-15" => "13～15歳","16-18" => "16～18歳","19-22" => "19～22歳", "23-25" => " 23～25歳", "26-29" => "26～29歳", "30f" => "30代前半","30l" => "30代後半","40" => "40代","50" => "50代","60" => "60代以上");

$sex = array("male" => "男性","female" => "女性");


$chata_exp = array(
	"0-1" => "1年未満",
	"1" => "1年",
	"2" => "2年",
	"3" => "3年",
	"4" => "4年～5年",
	"6" => "6年～9年",
	"10" => "10年以上"
);

$how_cd = array(
	"LE10" => "10枚以下",
	"LE20" => "11～20枚",
	"LE30" => "21～30枚",
	"LE50" => "31～50枚",
	"LE70" => "51～70枚",
	"LE100" => "71～100枚",
	"GT100" => "101枚以上"
);


$trigger = array(
	"game" => "ゲームのタイアップ",
	"anime" => "アニメのタイアップ",
	"shogyo" => "アニメ・ゲームでない商業作品",
	"web" => "Web公開作品などから",
	"dojin" => "ウサギキノコの同人作品",
	"dojin_other" => "それ以外の同人作品",
	"shodo" => "衝動買い",
	"else" => "その他"
);

$image = array(
	"moe" => "萌え",
	"kawai" => "可愛い",
	"omoshiroi" => "面白い",
	"otonashi" => "おとなしい",
	"genki" => "元気",
	"mazime" => "真面目",
	"mysterious" => "不思議（ミステリアス）",
	"megane" => "眼鏡っ娘",
	"syodoubutu" => "小動物系",
	"iyashi" => "癒し系",
	"doji" => "どじっこ",
	"koakuma" => "小悪魔系",
	"mogemoge" => "もげ",
	"else" => "その他"
);

if($_POST[mode] == "confirm"){
	confirm($_POST[age_s],$_POST[sex_s],$_POST[image_s],$_POST[love_music1_s],$_POST[love_music1_c_s],$_POST[love_music2_s],$_POST[love_music2_c_s],$_POST[love_music3_s],$_POST[love_music3_c_s],$_POST[love_cd1_s],$_POST[love_cd1_c_s],$_POST[love_point_s],$_POST[trigger_s],$_POST[combi_s],$_POST[new_combi_s],$_POST[chata_exp_s],$_POST[how_cd_s],$_POST[karaoke_s],$_POST[whats_chata_s],$_POST[other_s],$_POST[question_s],$_POST[message_s]);


}elseif($_POST[mode] == "regist"){
	if($_POST[send] == "送信"){
		regist($_POST[age_s],$_POST[sex_s],$_POST[image_s],$_POST[love_music1_s],$_POST[love_music1_c_s],$_POST[love_music2_s],$_POST[love_music2_c_s],$_POST[love_music3_s],$_POST[love_music3_c_s],$_POST[love_cd1_s],$_POST[love_cd1_c_s],$_POST[love_point_s],$_POST[trigger_s],$_POST[combi_s],$_POST[new_combi_s],$_POST[chata_exp_s],$_POST[how_cd_s],$_POST[karaoke_s],$_POST[whats_chata_s],$_POST[other_s],$_POST[question_s],$_POST[message_s]);
	}else{
		quest_form($_POST[age_s],$_POST[sex_s],$_POST[image_s],$_POST[love_music1_s],$_POST[love_music1_c_s],$_POST[love_music2_s],$_POST[love_music2_c_s],$_POST[love_music3_s],$_POST[love_music3_c_s],$_POST[love_cd1_s],$_POST[love_cd1_c_s],$_POST[love_point_s],$_POST[trigger_s],$_POST[combi_s],$_POST[new_combi_s],$_POST[chata_exp_s],$_POST[how_cd_s],$_POST[karaoke_s],$_POST[whats_chata_s],$_POST[other_s],$_POST[question_s],$_POST[message_s],"0");
	}
}else{
	quest_form($_POST[age_s],$_POST[sex_s],$_POST[image_s],$_POST[love_music1_s],$_POST[love_music1_c_s],$_POST[love_music2_s],$_POST[love_music2_c_s],$_POST[love_music3_s],$_POST[love_music3_c_s],$_POST[love_cd1_s],$_POST[love_cd1_c_s],$_POST[love_point_s],$_POST[trigger_s],$_POST[combi_s],$_POST[new_combi_s],$_POST[chata_exp_s],$_POST[how_cd_s],$_POST[karaoke_s],$_POST[whats_chata_s],$_POST[other_s],$_POST[question_s],$_POST[message_s],"0");
}


//フォーム

function quest_form($age_s,$sex_s,$image_s,$love_music1_s,$love_music1_c_s,$love_music2_s,$love_music2_c_s,$love_music3_s,$love_music3_c_s,$love_cd1_s,$love_cd1_c_s,$love_point_s,$trigger_s,$combi_s,$new_combi_s,$chata_exp_s,$how_cd_s,$karaoke_s,$whats_chata_s,$other_s,$question_s,$message_s,$flag){


global $age;
global $sex;
global $chata_exp;
global $how_cd;
global $trigger;
global $image;

	print "\n<div class=\"contact_cont\" style=\"text-align:center;\">\n";

	if($mes){
		print "\t<p style=\"text-align:center; border:solid 1px red; width:500px; margin:auto; padding:5px 10px; color:red;\">$mes</p>";
	}

	print "
<center>
<h1>茶太さんアンケート</h1>

	<p style=\"text-align:left; border:solid 1px black; width:580px; margin:auto; padding:5px 10px;\">
締切：２０１０年１０月３日<br />
同人音楽同好会の新刊では茶太さん特集を組みます。特集に際して茶太さんアンケートを行います。茶太さんを知っている方は是非お答えください。<br />
<br />
お一人様１回のご回答でお願いします。<br />
選択式質問に関しては集計結果を、自由記入欄に関しては集計結果またはそのまま掲載することがあります。また、茶太さんへ回答内容をお伝えすることがあります。
<br />M3秋頒布予定の同人音楽.bookの茶太さん特集にて回答頂いた結果を発表する予定です。すべての質問項目の結果を掲載するとは限りません。ご了承下さい。</p>
";
if($flag){
	print "<br />	<p style=\"text-align:center; border:solid 1px black; width:540px; margin:auto; padding:5px 10px; color:red;\">
回答必須の設問で未入力の項目があります
	</p>";
}
print "
<form action=\"chata_enq.php\" method=\"post\">
<input type=\"hidden\" name=\"mode\" value=\"confirm\" />
<div style=\"text-align:left; margin-auto; width:700px;\">
";
$new_combi_s = stripslashes(htmlspecialchars($new_combi_s,ENT_QUOTES));
print "

<h2>メールアドレス<span style=\"color:red;\">（必須）</span></h2>
<input type=\"text\" name=\"new_combi_s\" value=\"$new_combi_s\" size=\"50\" maxlength=\"250\" /><br />
重複記入チェックと、もしかしたら何か当たるかもしれないので、その連絡用


<h2>選択式質問<span style=\"color:red;\">（必須）</span></h2>
<h3>1 年齢</h3>";
	$i=0;
	foreach($age as $key => $value){
		$i++;
		if($i==7){
			print "<br />\n";
			$i=1;
		}
		if($key == $age_s){
			print "　<input name=\"age_s\" type=\"radio\" value=\"{$key}\" checked />{$value}\n";
		}else{
			print "　<input name=\"age_s\" type=\"radio\" value=\"{$key}\" />{$value}\n";
		}
	}
	print "<br /><h3>2 性別</h3>\n";
foreach($sex as $key => $value){
	if($key == $sex_s){
		print "　<input name=\"sex_s\" type=\"radio\" value=\"{$key}\" checked />{$value}\n";
	}else{
		print "　<input name=\"sex_s\" type=\"radio\" value=\"{$key}\" />{$value}\n";
	}
}

	print "</select><br /><h3>3 茶太さんファン歴</h3>\n
\n";
	$i=0;
foreach($chata_exp as $key => $value){


	if($key == $chata_exp_s){
		print "　<input name=\"chata_exp_s\" type=\"radio\" value=\"{$key}\" checked />{$value}\n";
	}else{
		print "　<input name=\"chata_exp_s\" type=\"radio\" value=\"{$key}\" />{$value}\n";
	}
}

	print "</select><br /><h3>4 茶太さん参加ＣＤ所有数</h3>\n";
	$i=0;
foreach($how_cd as $key => $value){
		$i++;
		if($i==6){
			print "<br />\n";
			$i=1;
		}
	if($key == $how_cd_s){
		print "　<input name=\"how_cd_s\" type=\"radio\" value=\"{$key}\" checked />{$value}\n";
	}else{
		print "　<input name=\"how_cd_s\" type=\"radio\" value=\"{$key}\" />{$value}\n";
	}
}

	print "<br /><h3>5 茶太さんを知ったきっかけ</h3>\n";
	$i=1;
foreach($trigger as $key => $value){
		if($i==4){
			print "<br />\n";
			$i=1;
		}
		$i++;
	if($key == $trigger_s){
		print "　<input name=\"trigger_s\" type=\"radio\" value=\"{$key}\" checked />{$value}\n";
	}else{
		print "　<input name=\"trigger_s\" type=\"radio\" value=\"{$key}\" />{$value}\n";
	}
}
	print "<br />具体的には？（任意）：<input type=\"text\" name=\"love_point_s\" value=\"$love_point_s\" size=\"50\" maxlength=\"200\" />";

	print "<br /><h3>6 茶太さんのイメージ</h3>\n";
	$i=1;
foreach($image as $key => $value){
		if($i==7){
			print "<br />\n";
			$i=1;
		}
		$i++;
	if($key == $image_s){
		print "　<input name=\"image_s\" type=\"radio\" value=\"{$key}\" checked />{$value}\n";
	}else{
		print "　<input name=\"image_s\" type=\"radio\" value=\"{$key}\" />{$value}\n";
	}
}
	print "<br />自由記入欄（任意）：<input type=\"text\" name=\"whats_chata_s\" value=\"$whats_chata_s\" size=\"50\" maxlength=\"200\" />";


	$love_music1_s = stripslashes(htmlspecialchars($love_music1_s,ENT_QUOTES));
	$love_music1_c_s = stripslashes(htmlspecialchars($love_music1_c_s,ENT_QUOTES));
	$love_music2_s = stripslashes(htmlspecialchars($love_music2_s,ENT_QUOTES));
	$love_music2_c_s = stripslashes(htmlspecialchars($love_music2_c_s,ENT_QUOTES));
	$love_music3_s = stripslashes(htmlspecialchars($love_music3_s,ENT_QUOTES));
	$love_music3_c_s = stripslashes(htmlspecialchars($love_music3_c_s,ENT_QUOTES));
	$love_cd1_s = stripslashes(htmlspecialchars($love_cd1_s,ENT_QUOTES));
	$love_cd1_c_s = stripslashes(htmlspecialchars($love_cd1_c_s,ENT_QUOTES));
	$love_point_s = stripslashes(htmlspecialchars($love_point_s,ENT_QUOTES));
	$trigger_s = stripslashes(htmlspecialchars($trigger_s,ENT_QUOTES));
	$combi_s = stripslashes(htmlspecialchars($combi_s,ENT_QUOTES));
	$whats_chata_s = stripslashes(htmlspecialchars($whats_chata_s,ENT_QUOTES));
	$question_s = stripslashes(htmlspecialchars($question_s,ENT_QUOTES));
	$message_s = stripslashes(htmlspecialchars($message_s,ENT_QUOTES));
	print "　</select><br />

<br />
<h2>自由記入式<span style=\"color:red;\">（一部任意）</span></h2>
<h3>7 茶太さんの曲で好きな曲とコメント（理由等）（3曲まで）</h3>
　曲名１：<input type=\"text\" name=\"love_music1_s\" value=\"$love_music1_s\" size=\"20\" maxlength=\"50\" />　コメント：<input type=\"text\" name=\"love_music1_c_s\" value=\"$love_music1_c_s\" size=\"70\" maxlength=\"200\" /><span style=\"color:red;\">（曲は必須）</span>
<br />
　曲名２：<input type=\"text\" name=\"love_music2_s\" value=\"$love_music2_s\" size=\"20\" maxlength=\"50\" />　コメント：<input type=\"text\" name=\"love_music2_c_s\" value=\"$love_music2_c_s\" size=\"70\" maxlength=\"200\" />
<br />
　曲名３：<input type=\"text\" name=\"love_music3_s\" value=\"$love_music3_s\" size=\"20\" maxlength=\"50\" />　コメント：<input type=\"text\" name=\"love_music3_c_s\" value=\"$love_music3_c_s\" size=\"70\" maxlength=\"200\" />

<h3>8 茶太さん参加ＣＤでお気に入り<span style=\"color:red;\">（ＣＤ名必須）</span></h3>
　<input type=\"text\" name=\"love_cd1_s\" value=\"$love_cd1_s\" size=\"20\" maxlength=\"50\" />　コメント：<input type=\"text\" name=\"love_cd1_c_s\" value=\"$love_cd1_c_s\" size=\"70\" maxlength=\"200\" />

<h3>9 茶太さんへの疑問・質問</h3>
　<input type=\"text\" name=\"question_s\" value=\"$question_s\" size=\"100\" maxlength=\"200\" />
<h3>10 茶太さんへの一言メッセージ</h3>
　<input type=\"text\" name=\"message_s\" value=\"$message_s\" size=\"100\" maxlength=\"200\" />

<p align=\"center\"><input type=\"submit\" value=\"確認\" /></p>
</div>
</center>
</form></div>";



}
//確認画面

function confirm($age_s,$sex_s,$image_s,$love_music1_s,$love_music1_c_s,$love_music2_s,$love_music2_c_s,$love_music3_s,$love_music3_c_s,$love_cd1_s,$love_cd1_c_s,$love_point_s,$trigger_s,$combi_s,$new_combi_s,$chata_exp_s,$how_cd_s,$karaoke_s,$whats_chata_s,$other_s,$question_s,$message_s){


if(!$age_s OR !$image_s OR !$sex_s OR !$love_music1_s OR !$love_cd1_s OR !$trigger_s OR !$chata_exp_s OR !$how_cd_s OR !$new_combi_s OR !preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $new_combi_s)){

	quest_form($age_s,$sex_s,$image_s,$love_music1_s,$love_music1_c_s,$love_music2_s,$love_music2_c_s,$love_music3_s,$love_music3_c_s,$love_cd1_s,$love_cd1_c_s,$love_point_s,$trigger_s,$combi_s,$new_combi_s,$chata_exp_s,$how_cd_s,$karaoke_s,$whats_chata_s,$other_s,$question_s,$message_s,"1");
}else{

if((!$love_music1_s AND $love_music1_c_s) OR (!$love_music2_s AND $love_music2_c_s) OR (!$love_music3_s AND $love_music3_c_s) OR (!$love_cd1_s AND $love_cd1_c_s)){
	quest_form($age_s,$sex_s,$image_s,$love_music1_s,$love_music1_c_s,$love_music2_s,$love_music2_c_s,$love_music3_s,$love_music3_c_s,$love_cd1_s,$love_cd1_c_s,$love_point_s,$trigger_s,$combi_s,$new_combi_s,$chata_exp_s,$how_cd_s,$karaoke_s,$whats_chata_s,$other_s,$question_s,$message_s,"2");
}else{


global $age;
global $sex;
global $chata_exp;
global $how_cd;
global $trigger;
global $image;

	$love_music1_s = stripslashes(htmlspecialchars($love_music1_s,ENT_QUOTES));
	$love_music1_c_s = stripslashes(htmlspecialchars($love_music1_c_s,ENT_QUOTES));
	$love_music2_s = stripslashes(htmlspecialchars($love_music2_s,ENT_QUOTES));
	$love_music2_c_s = stripslashes(htmlspecialchars($love_music2_c_s,ENT_QUOTES));
	$love_music3_s = stripslashes(htmlspecialchars($love_music3_s,ENT_QUOTES));
	$love_music3_c_s = stripslashes(htmlspecialchars($love_music3_c_s,ENT_QUOTES));
	$love_cd1_s = stripslashes(htmlspecialchars($love_cd1_s,ENT_QUOTES));
	$love_cd1_c_s = stripslashes(htmlspecialchars($love_cd1_c_s,ENT_QUOTES));
	$love_point_s = stripslashes(htmlspecialchars($love_point_s,ENT_QUOTES));
	$trigger_s = stripslashes(htmlspecialchars($trigger_s,ENT_QUOTES));
	$combi_s = stripslashes(htmlspecialchars($combi_s,ENT_QUOTES));
	$new_combi_s = stripslashes(htmlspecialchars($new_combi_s,ENT_QUOTES));
	$whats_chata_s = stripslashes(htmlspecialchars($whats_chata_s,ENT_QUOTES));
	$question_s = stripslashes(htmlspecialchars($question_s,ENT_QUOTES));
	$message_s = stripslashes(htmlspecialchars($message_s,ENT_QUOTES));


	$hidden = "";

	foreach($age as $key => $value){
		if($key == $age_s){
			$value1 = $value;
			$hidden .= "<input type=\"hidden\" name=\"age_s\" value=\"{$key}\" />\n";
		}
	}
	foreach($sex as $key => $value){
		if($key == $sex_s){
			$value2 = $value;
			$hidden .= "<input type=\"hidden\" name=\"sex_s\" value=\"{$key}\" />\n";
		}
	}
	foreach($chata_exp as $key => $value){
		if($key == $chata_exp_s){
			$value3 = $value;
			$hidden .= "<input type=\"hidden\" name=\"chata_exp_s\" value=\"{$key}\" />\n";
		}
	}
	foreach($how_cd as $key => $value){
		if($key == $how_cd_s){
			$value4 = $value;
			$hidden .= "<input type=\"hidden\" name=\"how_cd_s\" value=\"{$key}\" />\n";
		}
	}
	foreach($trigger as $key => $value){
		if($key == $trigger_s){
			$value5 = $value;
			$hidden .= "<input type=\"hidden\" name=\"trigger_s\" value=\"{$key}\" />\n";
			if($love_point_s){
				$value5 .= "（{$love_point_s}）";
			}
		}
	}
	foreach($image as $key => $value){
		if($key == $image_s){
			$value8 = $value;
			$hidden .= "<input type=\"hidden\" name=\"image_s\" value=\"{$key}\" />\n";
			if($whats_chata_s){
				$value8 .= "（{$whats_chata_s}）";
			}
		}
	}


	$hidden .= "<input type=\"hidden\" name=\"image_s\" value=\"{$image_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"love_music1_s\" value=\"{$love_music1_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"love_music1_c_s\" value=\"{$love_music1_c_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"love_music2_s\" value=\"{$love_music2_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"love_music2_c_s\" value=\"{$love_music2_c_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"love_music3_s\" value=\"{$love_music3_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"love_music3_c_s\" value=\"{$love_music3_c_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"love_cd1_s\" value=\"{$love_cd1_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"love_cd1_c_s\" value=\"{$love_cd1_c_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"love_point_s\" value=\"{$love_point_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"trigger_s\" value=\"{$trigger_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"combi_s\" value=\"{$combi_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"new_combi_s\" value=\"{$new_combi_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"whats_chata_s\" value=\"{$whats_chata_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"question_s\" value=\"{$question_s}\" />\n";
	$hidden .= "<input type=\"hidden\" name=\"message_s\" value=\"{$message_s}\" />\n";


	if($love_music1_s == ""){
		$value6_1 = "未記入";
	}elseif($love_music1_c_s){
		$value6_1 = "{$love_music1_s}「{$love_music1_c_s}」";
	}else{
		$value6_1 = "$love_music1_s";
	}
	if($love_music2_s == ""){
		$value6_2 = "未記入";
	}elseif($love_music2_c_s){
		$value6_2 = "{$love_music2_s}「{$love_music2_c_s}」";
	}else{
		$value6_2 = "$love_music2_s";
	}
	if($love_music3_s == ""){
		$value6_3 = "未記入";
	}elseif($love_music3_c_s){
		$value6_3 = "{$love_music3_s}「{$love_music3_c_s}」";
	}else{
		$value6_3 = "$love_music3_s";
	}
	if($love_cd1_s == ""){
		$value7 = "未記入";
	}elseif($love_cd1_c_s){
		$value7 = "{$love_cd1_s}「{$love_cd1_c_s}」";
	}else{
		$value7 = "{$love_cd1_s}";
	}
	if($love_point_s == ""){
		$value9 = "未記入";
	}else{
		$value9 = $love_point_s;
	}
	if($whats_chata_s == ""){
		$value10 = "未記入";
	}else{
		$value10 = $whats_chata_s;
	}
	if($combi_s == ""){
		$value11 = "未記入";
	}else{
		$value11 = $combi_s;
	}
	if($new_combi_s == ""){
		$value12 = "未記入";
	}else{
		$value12 = $new_combi_s;
	}
	if($question_s == ""){
		$value13 = "未記入";
	}else{
		$value13 = $question_s;
	}
	if($message_s == ""){
		$value14 = "未記入";
	}else{
		$value14 = $message_s;
	}



echo <<<VIEW
			<h2>入力確認</h2>
			<p>下記内容で問題が無ければ送信ボタンを押してください</p>
			<form action="chata_enq.php" method="post">
			<input type="hidden" name="mode" value="regist" />
			<p>$new_combi_s</p>
			<h3>1 年齢</h3>
			<p>$value1</p>
			<h3>2 性別</h3>
			<p>$value2</p>
			<h3>3 茶太さんファン歴</h3>
			<p>$value3</p>
			<h3>4 茶太さんＣＤ所有数</h3>
			<p>$value4</p>
			<h3>5 茶太さんを知ったきっかけ</h3>
			<p>$value5</p>
			<h3>6 茶太さんのイメージは？</h3>
			<p>$value8</p>
			<h3>6 茶太さんの曲で好きな曲（3曲まで）</h3>
			<p>$value6_1</p>
			<p>$value6_2</p>
			<p>$value6_3</p>
			<h3>7 茶太さん参加ＣＤでお気に入り</h3>
			<p>$value7</p>
			<h3>8 茶太さんへの疑問・質問</h3>
			<p>$value13</p>
			<h3>9 茶太さんへの一言メッセージ</h3>
			<p>$value14</p>
			$hidden
			<p align="center">
				<input type="submit" name="send" value="送信" />　
				<input type="submit" name="send" value="修正" />
			</p>
			</form>
			<br />

VIEW;
	}
}
}


//送信

function regist($age_s,$sex_s,$image_s,$love_music1_s,$love_music1_c_s,$love_music2_s,$love_music2_c_s,$love_music3_s,$love_music3_c_s,$love_cd1_s,$love_cd1_c_s,$love_point_s,$trigger_s,$combi_s,$new_combi_s,$chata_exp_s,$how_cd_s,$karaoke_s,$whats_chata_s,$other_s,$question_s,$message_s){


	$d =  date("Y-m-d H:i:s");


	$artist = str_replace(",", "、",$artist);
	$trigger1 = str_replace(",", "、",$trigger1);
	$else_s = str_replace(",", "、",$else_s);
//	$else_s = preg_replace("/\n|\r/", " ", $else_s);

	$ip = $_SERVER["REMOTE_ADDR"];

	$insert = fopen("enq_res.txt", "a");

	fputs($insert, "$d,$new_combi_s,$age_s,$sex_s,$love_music1_s,$love_music1_c_s,$love_music2_s,$love_music2_c_s,$love_music3_s,$love_music3_c_s,$love_cd1_s,$love_cd1_c_s,$trigger_s,$love_point_s,$chata_exp_s,$question_s,$message_s,$combi_s,$how_cd_s,$image_s,$whats_chata_s,$karaoke_s,$other_s,$ip\n");
	fclose($insert);

	print "<h2>送信完了</h2>";

	print "<p align=\"center\">アンケートにご協力頂きありがとうございました！<br />\n";
	print "同人音楽.bookが完成しましたらよろしくお願いいたします。</p>\n";
	print "<p align=\"center\"><a href=\"index.php\">同人音楽同好会トップに戻る</a></p>";
}


footer();
?>
