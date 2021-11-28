<?php
	session_start();
	session_regenerate_id(true);
	if(isset($_SESSION['login'])==false)
	{
		print 'ログインされていません。<br />';
		print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
		exit();
	}
	else
	{
		print '<span class="staff_name">'. $_SESSION['staff_name'].'</span>';
		print 'さんログイン中<br />';
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
		<script src="https://maxcdn.bootstrapcdn.co21m/bootstrap/4.0.0/js/bootstrap.min.js"></script>

		<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--SVG WEBサイトで使うWEBアイコンフォンtを表示する仕組み-->
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js'></script><!--無料のCDN、クラウドフレア、インターネットセキュリティ強化&閲覧の高速化-->

		<script type="text/javascript" src="./parallax.min.js"></script>
		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/li00bs/lity/1.6.6/lity.css' /><!--セキュリティ-->
		<script src='https://cdnjs.cloudflare.com/ajax/libs/lity/1.6.6/lity.js'></script>

		<link href="staff_edit_done.css" rel="stylesheet">
		<link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
	</head>
	<body>

		<?php

			try
			{

			require_once('../common/common.php');

			$post=sanitize($_POST);
			$staff_code=$post['code'];
			$staff_name=$post['name'];
			$staff_pass=$post['pass'];

			$dsn = 'mysql:dbname=takeshiueno_database1;host=mysql1.php.xdomain.ne.jp';//データベース接続
			$user = 'takeshiueno_0111';
			$password = '5050Rock';//データベースに接続します
			$dbh = new PDO($dsn,$user,$password);
			$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			$sql='UPDATE mst_staff SET name=?,password=? WHERE code=?';
			$stmt=$dbh->prepare($sql);
			$data[]=$staff_name;
			$data[]=$staff_pass;
			$data[]=$staff_code;
			$stmt->execute($data);

			$dbh=null;

			}
			catch (Exception $e)
			{
				print 'ただいま障害により大変ご迷惑をお掛けしております。';
				exit();
			}

		?>

		<div class="staff_edit">修正しました。<br /></div>
		<br />
	<a href="staff_list.php"> 戻る</a>

	</body>
</html>