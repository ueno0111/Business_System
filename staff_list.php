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

        <link href="staff_list.css" rel="stylesheet">
        <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
    </head>
	<body>

		<?php

			try
			{

			$dsn = 'mysql:dbname=takeshiueno_database1;host=mysql1.php.xdomain.ne.jp';//データベースに接続
			$user = 'takeshiueno_0111';//ユーザー名を入力
			$password = '5050Rock';//パスワードを入力
			$dbh = new PDO($dsn,$user,$password);
			$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//接続を実行する

			$sql='SELECT code,name FROM mst_staff WHERE 1';//データベースのテーブルからcode,nameを取得する
			$stmt=$dbh->prepare($sql);//取得したデータを変数へ代入
			$stmt->execute();//　実行

			$dbh=null;//データベース接続を切断

			print '<div class="staff_list">スタッフ一覧</div>'.'<br/><br/>';

			print '<form method="post" action="staff_branch.php">';//staf_branchへ内容を送る
			while(true)
			{
				$rec=$stmt->fetch(PDO::FETCH_ASSOC);//取得したデータを$recに代入する
				if($rec==false)//取得したデータがfalseだった場合は抜ける
				{
					break;
				}
				print '<div class="staff_code">'.'<input type="radio" name="staffcode" value="'.$rec['code'].'".s</div>'.$rec['name'];
				print '<br />';
			}
				print '<input type="submit" name="disp" value="参照">';
				print '<input type="submit" name="add" value="追加">';
				print '<input type="submit" name="edit" value="修正">';
				print '<input type="submit" name="delete" value="削除">';
				print '</form>';

			}
			catch (Exception $e)
			{
				print 'ただいま障害により大変ご迷惑をお掛けしております。';
				exit();
			}

		?>

		<br />
		<a href="../staff_login/staff_top.php">トップメニューへ</a><br />

	</body>
</html>