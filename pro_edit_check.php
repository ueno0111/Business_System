<?php
	session_start();//合言葉を確認します
	session_regenerate_id(true);
	if(isset($_SESSION['login'])==false){//もしログインOKの証拠がなかったら...
		print'ログインされていません。<br/>';
		print'<a href="../staff_login/staff_login.html">ログイン画面へ</a>';//ログイン画面を戻ります
		exit();//プログラム強制終了
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

		<link href="pro_edit_check.css" rel="stylesheet">
		<link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
	</head>
	<body>

		<?php

			require_once('../common/common.php');
			$post=sanitize($_POST);
			$pro_code=$_POST['code'];
			$pro_name=$_POST['name'];
			$pro_price=$_POST['price'];
			$pro_gazou_name_old=$_POST['gazou_name_old'];
			$pro_gazou=$_FILES['gazou'];

			if($pro_name=='')
			{
				print '<span>商品名</span>'.'が入力されていません。<br />';
			}
			else
			{
				print '<span>商品名</span>'.':';
				print $pro_name;
				print '<br />';
			}

			if(preg_match('/\A[0-9]+\z/',$pro_price)==0)
			{
				print '<span>価格</span>'.'をきちんと入力してください。<br />';
			}
			else
			{
				print '<span>価格</span>'.':';
				print $pro_price;
				print '円<br />';
			}

			if($pro_gazou['size']>0)
			{
				if($pro_gazou['size']>1000000)
				{
					print '画像が大き過ぎます';
				}
				else
				{
					move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
					print '<img src="./gazou/'.$pro_gazou['name'].'">';
					print '<br />';
				}
			}

			if($pro_name=='' || preg_match('/\A[0-9]+\z/',$pro_price)==0 || $pro_gazou['size']>1000000)
			{
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
			else
			{
				print '上記のように変更します。<br />';
				print '<form method="post" action="pro_edit_done.php">';
				print '<input type="hidden" name="code" value="'.$pro_code.'">';
				print '<input type="hidden" name="name" value="'.$pro_name.'">';
				print '<input type="hidden" name="price" value="'.$pro_price.'">';
				print '<input type="hidden" name="gazou_name_old" value="'.$pro_gazou_name_old.'">';
				print '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
				print '<br />';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '<input type="submit" value="ＯＫ">';
				print '</form>';
			}

		?>
	</body>
</html>