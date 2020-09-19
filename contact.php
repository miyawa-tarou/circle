<?php
include('function.php');
header_txt("CONTACT - ","コンタクト");
?>


			<h2>連絡先</h2>
			<p>質問や感想など何かありましたら下記までご連絡ください。<br />
			メッセージ機能は匿名で手軽に投稿できますのでお気軽にご連絡ください。</p>
			<table width="510" border="0" id="table_noborder">
				<tr>
					<td align="right">メール：</td>
					<td width="440">dob_book☆doujin-ongaku.org (☆を@に書き換えてください)</td>
				</tr>
				<tr>
					<td align="right" valign="top">メッセージ：</td>
					<td>
						<form method="post" action="message.php" target="_blank">
							<textarea name="Message" rows="3" cols="50"></textarea>
							<input type="submit" value="送信">
							<input type="hidden" name="open" value="message_check">
						</form>
					</td>
				</tr>
			</table>

<?php
footer();
?>
