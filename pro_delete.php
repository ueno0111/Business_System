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

        <link href="pro_delete.css" rel="stylesheet">
        <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
    </head>

        <body>
            <!--削除の確認画面-->
            <?php

            try
            {
                $pro_code=$_GET['procode'];//選択された[商品コード]を受け取っています。

                $dsn = 'mysql:dbname=takeshiueno_database1;host=mysql1.php.xdomain.ne.jp';//データベース接続
                $user = 'takeshiueno_0111';
                $password = '5050Rock';//データベースに接続します
                $dbh = new PDO($dsn,$user,$password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $sql = 'SELECT name,gazou FROM mst_product WHERE code=?';//スタッフコードで絞り込んでいます。１件のレコードに絞り込まれるので、この後、whileループで回すようなことはしません。
                $stmt = $dbh->prepare($sql);
                $data[] = $pro_code;
                $stmt->execute($data);

                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                $pro_name = $rec['name'];//スタッフ名を変数にコピー。この後、使います。
                $pro_gazou_name = $rec['gazou'];

                if($pro_gazou_name == ''){
                    $disp_gazou='';
                }else{
                    $disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
                }
                $dbh = null;
            }
            catch(Exception $e)
            {
                print'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }
            ?>

            <div class="delete">商品削除<br/></div>
            <br/>
            <div class="code">商品コード<br/></div>
            <?php print $pro_code; ?>
            <br/>
            <div class="name">商品名<br/></div>
            <?php print $pro_name; ?>
            <br/>
            <div class="delete_ok">この商品を削除しますか？<br/></div>
            <?php print $disp_gazou;  ?>
            <br/>

        <form method="post" action="pro_delete_done.php">
            <input type="hidden" name="code" value="<?php print $pro_code;?>"><!--お名前をすでに入力済みにしています。-->
            <input type="hidden" name="gazou_name" value="<?php print $pro_gazou_name;?>">
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="OK">
        </form>

        </body>
</html>