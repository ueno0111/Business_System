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

        <link href="staff_disp.css" rel="stylesheet">
        <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
	</head>

	<body>

		<?php

			try
			{

			$staff_code=$_GET['staffcode'];

			$dsn = 'mysql:dbname=takeshiueno_database1;host=mysql1.php.xdomain.ne.jp';//データベース接続
			$user = 'takeshiueno_0111';
			$password = '5050Rock';//データベースに接続します
			$dbh = new PDO($dsn,$user,$password);
			$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			$sql='SELECT name FROM mst_staff WHERE code=?';
			$stmt=$dbh->prepare($sql);
			$data[]=$staff_code;
			$stmt->execute($data);

			$rec=$stmt->fetch(PDO::FETCH_ASSOC);
			$staff_name=$rec['name'];

			$dbh=null;

			}
			catch(Exception $e)
			{
				print'ただいま障害により大変ご迷惑をお掛けしております。';
				exit();
			}

		?>

		<div class="staff_info">スタッフ情報参照<br /></div>
		<br />
		<div class="staff_code">スタッフコード<br /></div>
		<?php print $staff_code; ?>
		<br />
		<div class="staff_name2">スタッフ名<br /></div>
		<?php print $staff_name; ?>
		<br />
		<br />
		<form>
			<input type="button" onclick="history.back()" value="戻る">
		</form>

	</body>
</html>