<?php
include('function.php');
header_txt("アンケート - ","");
?>
			<h2>同人音楽.book -2011 秋-　アンケート</h2>

			<p>「レビュー」を書かれることをどのように感じますか？</p>
			<p>レビューなので直接言われる感想のことではなく、ブログなどで批評されることについてです。</p>
			<p>こういうのが一番嬉しい、これはやめて欲しい、読まない、聴き手として読んでる、書いて欲しいなどなど自由に書いて頂きたいと思います。</p>
			<p>匿名アンケートなので、ご協力頂いた方に何かお礼等は出来ませんが、ご協力頂ければ幸いです。</p>
			<p>なおあくまでレビューってどう見られているんだろうというのを知りたいというもので、お答え頂いた内容の感想程度を載せる可能性はありますが、お答え頂いた内容を直接本に掲載致しません。</p>
			<table width="620" border="0" id="table_noborder">
				<tr>
					<td align="right" valign="top">コメント：</td>
					<td>
						<form method="post" action="enq_sys.php" target="_blank">
							<textarea name="Message" rows="7" cols="60"></textarea>
							<input type="submit" value="送信">
							<input type="hidden" name="open" value="message_check">
						</form>
					</td>
				</tr>
			</table>
			<p>今月中くらいまで。</p>

<?php
footer();
?>
