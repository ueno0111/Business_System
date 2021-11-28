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

        <link href="staff_add.css" rel="stylesheet">
        <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
    </head>

    <body>

        <div class="staff_add">スタッフ追加</div><br />
        <br />
        <form method="post" action="staff_add_check.php">
            <div class="staff_name">スタッフ名を入力してください。</div><br />
            <input type="text" name="name" style="width:200px"><br />
            <div class="staff_pass">パスワードを入力してください。</div><br />
            <input type="password" name="pass" style="width:100px"><br />
            <div class="staff_pass2">パスワードをもう１度入力してください。</div><br />
            <input type="password" name="pass2" style="width:100px"><br />
            <br />
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="ＯＫ">
        </form>

    </body>
</html>