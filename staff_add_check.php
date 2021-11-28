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

		<link href="staff_add_check.css" rel="stylesheet">
		<link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
	</head>

	<body>

		<?php

			require_once('../common/common.php');

			$post=sanitize($_POST);//セキュリティ対策、別の文字に置き換える
			$staff_name=$post['name'];//前のページ
			$staff_pass=$post['pass'];
			$staff_pass2=$post['pass2'];

			if($staff_name=='')
			{
				print 'スタッフ名が入力されていません。<br />';
			}
			else
			{
				print 'スタッフ名：';
				print '<span class="staff_name">'.$staff_name.'</span>';
				print '<br />';
			}

			if($staff_pass=='')
			{
				print 'パスワードが入力されていません。<br />';
			}

			if($staff_pass!=$staff_pass2)
			{
				print 'パスワードが一致しません。<br />';
			}

			if($staff_name=='' || $staff_pass=='' || $staff_pass!=$staff_pass2)
			{
				print '<form>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}
			else
			{
				$staff_pass=md5($staff_pass);
				print '<form method="post" action="staff_add_done.php">';
				print '<input type="hidden" name="name" value="'.$staff_name.'">';
				print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
				print '<br />';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '<input type="submit" value="ＯＫ">';
				print '</form>';
			}

		?>

	</body>
</html>