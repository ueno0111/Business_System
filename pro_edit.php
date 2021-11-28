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
<html lang="en">
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

        <link href="pro_edit.css" rel="stylesheet">
        <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
    </head>

    <body>
        <!--スタッフ情報の更新ページ-->
        <?php

        try
        {
            $pro_code=$_GET['procode'];//選択された[スタッフコード]を受け取っています。

            $dsn = 'mysql:dbname=takeshiueno_database1;host=mysql1.php.xdomain.ne.jp';//データベース接続
            $user = 'takeshiueno_0111';
            $password = '5050Rock';//データベースに接続します
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
            $stmt=$dbh->prepare($sql);
            $data[]=$pro_code;
            $stmt->execute($data);

            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            $pro_name=$rec['name'];
            $pro_price=$rec['price'];
            $pro_gazou_name_old=$rec['gazou'];

            $dbh=null;

            if($pro_gazou_name_old=='')
            {
                $disp_gazou='';
            }
            else
            {
                $disp_gazou='<img src="./gazou/'.$pro_gazou_name_old.'">';
            }

            }
            catch(Exception $e)
            {
                print 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }

            ?>

            <div class="edit">商品修正<br /></div>
            <br />
            <div class="code">商品コード<br /></div>
            <?php print $pro_code; ?>
            <br />
            <br />
            <form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
                <input type="hidden" name="code" value="<?php print $pro_code; ?>">
                <input type="hidden" name="gazou_name_old" value="<?php print $pro_gazou_name_old; ?>">
                <div class="name">商品名<br /></div>
                <input type="text" name="name" style="width:300pxx" value="<?php print $pro_name; ?>"><br />
                <div class="price">価格<br /></div>
                <input type="text" name="price" style="width:200px" value="<?php print $pro_price; ?>">円<br />
                <br />
                <div class="gazou">画像を選んでください。<br /></div>
                <?php print $disp_gazou; ?>
                <br />
                <div class="file">
                <input type="file" name="gazou"><br />
                </div>
                <br />
                
                <div class="back">
                    <input type="button" onclick="history.back()" value="戻る">
                    <input type="submit" value="ＯＫ">
                </div>
            </form>
    </body>
</html>