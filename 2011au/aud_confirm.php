<?php
include('../function.php');
header_txt('投稿内容チェック - ','内容チェック');

?>
<h2>確認画面</h2>
<div style="margin:10px 30px;">
投稿内容の確認画面です。<br />
修正な必要な場合は<br />
　dod_dvd◎doujin-ongaku.org（◎を@に）<br />
こちらのアドレスへご連絡下さい。大きな修正でなければ9月10日まで受け付けます。


</div>


<?php

if("confirm" == $_POST['mode']){

	$email =& $_POST['email'];
	$pass =& $_POST['password'];

	if ($email === ""){
		print "メールアドレスが入力されていません<br />"; exit;
	}elseif(preg_match('/^[a-zA-Z0-9_\.\-]+?@[A-Za-z0-9_\.\-]+$/',$email) == FALSE){ 
		print "Ｅメールの入力形式が間違っています<br />";
		exit;
	}

	$sql = new Sql;
	$sql->connectSql();
	$email = mysql_real_escape_string($email);
	$pass = md5(mysql_real_escape_string($pass));
	$result = $sql->sendQuery("SELECT * FROM `aud_circle` WHERE `password` = '{$pass}' AND `mail` = '{$email}' AND `flag` = 0");
	if(!mysql_num_rows($result)){
		print "該当するサークルは登録されていません";
		exit;
	}

	$circle = mysql_fetch_assoc($result);


?>


<form action="aud_form.php?mode=send" method="post">
<table width="600" border style="margin:10px auto;">
<tr><th>音源データURL</th><td><a href="<?php echo $circle['data']; ?>" target="_blank"><?php echo $circle['data']; ?></a><br />（登録時のものになりますので、ファイルサーバの期限切れの可能性はあります）</td></tr>
<tr><th>メッセージ</th><td><?php echo $circle['message']; ?></td></tr>
</table>

<table width="700" border style="margin:10px auto;">
<tr><th>サークル名</th><td><?php echo $circle['name']; ?>（読み：<?php echo $circle['name_kana']; ?>）</td></tr>
<tr><th>サークル結成日</th><td><?php echo $circle['kessei']; ?>
</td></tr>
<?php

if($circle['url'] !== ""){
	print "<tr><th>サークルサイトURL</th><td><a href=\"{$circle['url']}\" target=\"_blank\">{$circle['url']}</a></td></tr>";
}
if($circle['banner'] !== ""){
	print "<tr><th>サークルバナーURL</th><td><a href=\"{$circle['banner'] }\" target=\"_blank\">{$circle['banner'] }</a></td></tr>";
}

?>

<tr><th>固定タグ</th><td>１：<?php echo $circle['tag1']; ?>　２：<?php echo $circle['tag2']; ?></td></tr>
<tr><th>自由タグ</th><td>１：<?php echo $circle['ftag1']; ?>　２：<?php echo $circle['ftag2']; ?></td></tr>
<tr><th>サークル自己紹介</th><td><?php echo $circle['intro']; ?></td></tr>
</table>

<?php
	if(!is_numeric($circle['circle_id'])){
		print "error";
		exit;
	}
	$result = $sql->sendQuery("SELECT * FROM `aud_cd` WHERE `circle_id` = {$circle['circle_id']}");
	while( $cd = mysql_fetch_assoc($result) ){
		?>

<table width="600" border style="margin:10px auto;">
<tr><th>ＣＤ名</th><td><?php echo $cd['name']; ?>（読み：<?php echo $cd['name_kana']; ?>）</td></tr>
<tr><th>頒布開始日</th><td><?php echo $cd['sale']; ?></td></tr>

<?php
	if("" !== $cd['event']){
		print "<tr><th>初頒布イベント</th><td>{$cd['event']}</td></tr>";
	}
	if("" !== $cd['design']){
		print "<tr><th>ジャケット絵師orデザイナー</th><td>{$cd['design']}</td></tr>";
	}
?>

<tr><th>固定タグ</th><td>１：<?php echo $cd['tag1']; ?>　２：<?php echo $cd['tag2']; ?></td></tr>
<tr><th>紹介文</th><td><?php echo $cd['intro']; ?></td></tr>
<tr><th>トラックリスト</th><td><?php echo $cd['track']; ?></td></tr>
</table>

<?php
	}
}else{
	print "不正アクセス";

}

footer();


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