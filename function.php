<?php
/*
if(! preg_match("/^www./", $_SERVER["HTTP_HOST"])){
	header( "HTTP/1.1 301 Moved Permanently" );
	header( "Location: http://www.". $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] );
}


include '/home/tokyo-gallery/www/circle/ra/phptrack.php';
_raTrack();
*/
function header_txt($title,$keywords, $desc = '', $image = ''){
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="google-site-verification" content="yLLDjCPgw8-IJvApy-MefdQPAosURtnqF5xib5642OM" />
        <meta name="description" content="同人音楽好きのサークル関係者が集まって作成する本のサイト。<?php echo $desc; ?>" />
        <meta name="keywords" content="<?php  echo $keywords; ?>,同人音楽,同人音楽同好会,同人音楽.book,同人音楽本" />
        <title><?php echo $title; ?>同人音楽同好会</title>

        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@DojinOngakuClub" />
        <meta property="og:url" content="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
        <meta property="og:title" content="<?php echo $title; ?>同人音楽同好会" />
        <meta property="og:description" content="<?php echo $desc; ?><?php echo $title; ?>同人音楽同好会" />
        <meta property="og:image" content="<?php echo $image === '' ? 'http://circle.dojin-music.info/image/rogo.png' : $image; ?>" />

        <link href="/dod.css" rel="stylesheet" type="text/css" />
    </head>
    <body id="body">
    <div id="contain" style="height:100%;">
    <div id="header">
        <h1 style="float:left;"><a href="/"><img src="/image/rogo.png" alt="同人音楽同好会" width="333" height="92" /></a></h1>

        <table style="float:right;"><tr><td>
                    <!-- Place this tag where you want the +1 button to render. -->
                    <div class="g-plusone" data-annotation="inline" data-width="120"></div>

                    <!-- Place this tag after the last +1 button tag. -->
                    <script type="text/javascript">
                        window.___gcfg = {lang: 'ja'};

                        (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/plusone.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                        })();
                    </script>
                </td><td>

                    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja">ツイート</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </td>
                <td>

                    <div data-plugins-type="mixi-favorite" data-service-key="fcf6bfa54ea5cf0a640e128db50dc6a1547f8034" data-size="medium" data-href="" data-show-faces="false" data-show-count="true" data-show-comment="true" data-width=""></div><script type="text/javascript">(function(d) {var s = d.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//static.mixi.jp/js/plugins.js#lang=ja';d.getElementsByTagName('head')[0].appendChild(s);})(document);</script>

                </td>
            </tr></table>
        <hr  style="clear:both;">
    </div>
    <div id="left">
        <div id="menubox">
            <ul>
                <li><a href="/"><img src="/image/menu/home.gif" onmouseover="this.src='/image/menu/home_on.gif'" onmouseout="this.src='/image/menu/home.gif'" alt="HOME"></a></li>
                <li><a href="/concept.php"><img src="/image/menu/concept.gif" onmouseover="this.src='/image/menu/concept_on.gif'" onmouseout="this.src='/image/menu/concept.gif'" alt="CONCEPT"></a></li>
                <li><a href="/member.php"><img src="/image/menu/member.gif" onmouseover="this.src='/image/menu/member_on.gif'" onmouseout="this.src='/image/menu/member.gif'" alt="MEMBER"></a></li>
                <li><a href="/product.php"><img src="/image/menu/products.gif" onmouseover="this.src='/image/menu/products_on.gif'" onmouseout="this.src='/image/menu/products.gif'" alt="PRODUCTS"></a></li>
                <li><a href="/contents.php"><img src="/image/menu/contents.gif" onmouseover="this.src='/image/menu/contents_on.gif'" onmouseout="this.src='/image/menu/contents.gif'" alt="CONTENTS"></a></li>
                <li><a href="/contact.php"><img src="/image/menu/contact.gif" onmouseover="this.src='/image/menu/contact_on.gif'" onmouseout="this.src='/image/menu/contact.gif'" alt="CONTACT"></a></li>
                <li><a href="/link.php"><img src="/image/menu/link.gif" onmouseover="this.src='/image/menu/link_on.gif'" onmouseout="this.src='/image/menu/link.gif'" alt="LINK"></a></li>
            </ul>
        </div>


    </div>
    <div id="Right">
    <div id="mainContent">
    <?php
}

function footer(){


    ?>
    </div>
    </div>
    <div id="footer" style="width:900px; clear:both;">
        <hr />
        <div align="center" class="style1">Copyright &copy; 2008-<?php echo date('Y'); ?>,同人音楽同好会 All Rights Reserved.</div>
    </div>


    </div>
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-3045582-4']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
    </body>
    </html>

    <?php

    exit;
}

?>