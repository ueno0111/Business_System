<?php
session_start();//サーバーとPCに合言葉を設定する。Cookieの領域に合言葉として記憶する。
session_regenerate_id(true);//セッションIDの自動変更
if(isset($_SESSION['login'])==false)//ログインができていない場合はfalseだった場合
{
	print 'ログインされていません。<br />';
	print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
	exit();
}
else{
	print  '<span class="staff_name">'.$_SESSION['staff_name'].'</span>'.'さんログイン中';
	print '<br />';
}
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>でんぱ＠農業組合</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"><!--Bootstrap CSS  CDN読み込み-->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><!--Google Hosted Libraries  GoogleのBootstrapCDNを使ったJSの読み込み-->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

			<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--SVG WEBサイトで使うWEBアイコンフォンtを表示する仕組み-->
			<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js'></script><!--無料のCDN、クラウドフレア、インターネットセキュリティ強化&閲覧の高速化-->

			<script type="text/javascript" src="./parallax.min.js"></script>
			<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/li00bs/lity/1.6.6/lity.css' /><!--セキュリティ-->
			<script src='https://cdnjs.cloudflare.com/ajax/libs/lity/1.6.6/lity.js'></script>

			<link href="staff_top.css" rel="stylesheet">
			<link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
	</head>
	<body>
		<main>
			<section class="shop">
				<div class="title">
					ショップ管理トップメニュー<br />
					<br />
				</div>
				<div class="bord"></div>
			</section>

			<a href="../staff/staff_list.php">スタッフ管理</a><br />
			<br />
			<a href="../product/pro_list.php">商品管理</a><br />
			<br />
			<a href="../order/order_download.php">注文ダウンロード</a><br />
			<br />
			<a href="staff_logout.php">ログアウト</a><br />
		</main>
	</body>
</html>