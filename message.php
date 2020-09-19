<?php
include('function.php');
header_txt("メッセージ送信 - ","フォーム,メッセージ");
?>
<?php
	define("MESSAGELOG", "message.log");				//トップ

	$Message = trim($_REQUEST["Message"]);	//検索文字列

	switch ($_REQUEST["open"]){
		case "message_check":
			ViewMessage($Message);
			break;
		case "message_outlog":
			$ErrValue = MsgErrCheck($Message);
			if($ErrValue == 1){
				ViewOKMessage($Message);
				OutPutMsgLog($Message);
				return;
			}else{
				ViewMsgErr($ErrValue);
				return;
			}
			break;
		default:
			break;
	}

	//NEWSログに出力
	function OutPutMsgLog($Message)
	{

		$IP = getenv("REMOTE_ADDR"); 			// ユーザのIPアドレス
		$User = getenv("HTTP_USER_AGENT");	//ユーザのブラウザ

		// ファイルが存在しないかサイズが0の時
		if(!file_exists(MESSAGELOG) or !is_readable(MESSAGELOG)){
			exit("<p>「".MESSAGELOG."」が見つかりませんでした</p>");
			return;
		}else{
			$ArrayNewsLog = file(MESSAGELOG);
		}

		$fp = @fopen(MESSAGELOG, "w");
		if(!$fp){
			exit("<p>Newsログの書き込みに失敗しました。</p>");
		}else{
			flock($fp, LOCK_EX);		//ファイルをロック
			$Log = date("Ymd G:i:s")."\t".
					gethostbyaddr($IP)."\t".
					$User."\t".
					ConvBR(htmlspecialchars($Message))."\n";
			array_unshift($ArrayNewsLog,$Log);
			$cont = '';
			foreach ($ArrayNewsLog as $Value){
				$cont .= $Value;
			}
			fputs($fp,$cont);			//書き込み
			flock($fp, LOCK_UN);		//ロックを解除
			fclose($fp);
		}
	}

	function MsgErrCheck($Message)
	{
		
		if($Message == ""){
			return -1;
		}

		if(!preg_match("/[\\x80-\\xFF]/", $Message)){
			return -2;
		}

		return 1;

	}

	//改行を<br>にする
	function ConvBR($str)
	{
		return preg_replace("/(\r\n|\n|\r)/", "<br />", $str);
	}

	//メッセージチェック
	function ViewMessage($Message)
	{

		$Msg = ConvBR(htmlspecialchars($Message));

echo <<<VIEWMESSAGE
		<div id="mainContent">
			<h2>メッセージ送信</h2>
			<form method='post' action="message.php" target="_self" enctype="multipart/form-data">
				<p>下記の内容でメッセージが送信されます。<br />
				よろしければ送信ボタンを押してください。</p>
				<hr width="100%" />
				<p>$Msg</p>
				<hr width="100%" />
				<div align="center">
					<input type="submit" value="送信する">
					<input type="button" value="やめる" onClick="self.close()">
					<input type="hidden" name="Message" value="$Message">
					<input type="hidden" name="open" value="message_outlog">
				</div>
			</form>
		</div>

VIEWMESSAGE;

	}

	//
	function ViewMsgErr($MsgErr)
	{
		$Value = "";

		switch ($MsgErr){
			case -1:
				$Value = "メッセージを入力してください。";
				break;
			case -2:
				$Value = "スパム対策のためメッセージに日本語を加えてください。";
				break;
		}
	
echo <<<VIEWMSGERR
		<div id="mainContent">
			<h2>メッセージ送信</h2>
			<form method='post' action="message.php" target="_self" enctype="multipart/form-data">
				<p><font color="red">$Value</font></p>
				<div align="center">
					<input type="button" value="閉じる" onClick="self.close();">
				</div>
			</form>
		</div>

VIEWMSGERR;

	}

	function ViewOKMessage($Message)
	{

		$Message = ConvBR(htmlspecialchars($Message));

echo <<<VIEWOKMESSAGE
		<div id="mainContent">
			<h2>メッセージ送信</h2>
				<p>メッセージありがとうござます。<br />
				下記の内容でメッセージが送信されました。</p>
				<hr width="100%" />
				<p>$Message</p>
				<hr width="100%" />
				<div align="center">
					<input type="button" value="閉じる" onClick="self.close();">
				</div>
			</div>
		</div>

VIEWOKMESSAGE;

	}

?>
	</di>
<?php
footer();
?>