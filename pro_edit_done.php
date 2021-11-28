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

        <link href="pro_edit_done.css" rel="stylesheet">
        <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
    </head>

    <body>

        <?php

            try
            { //データベースサーバーの障害対策です。エラートラップ

                require_once('../common/common.php');
                $post=sanitize($_POST);
                $pro_code=$_POST['code'];
                $pro_name=$_POST['name'];
                $pro_price=$_POST['price'];
                $pro_gazou_name_old=$_POST['gazou_name_old'];
                $pro_gazou_name=$_POST['gazou_name'];
                
                $dsn = 'mysql:dbname=takeshiueno_database1;host=mysql1.php.xdomain.ne.jp';//データベース接続
                $user = 'takeshiueno_0111';
                $password = '5050Rock';//データベースに接続します
                $dbh = new PDO($dsn,$user,$password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                    
                $sql='UPDATE mst_product SET name=?,price=?,gazou=? WHERE code=?';
                $stmt=$dbh->prepare($sql);
                $data[]=$pro_name;
                $data[]=$pro_price;
                $data[]=$pro_gazou_name;
                $data[]=$pro_code;
                $stmt->execute($data);

                if($pro_gazou_name_old != $pro_gazou_name){
                    if($pro_gazou_name_old!=''){//もし古い画像があれば削除します。
                        unlink('./gazou/'.$pro_gazou_name_old);
                    }
            }
                $dbh = null;//データベースから切断します

                print '修正しました。<br />';
            }
            catch(Exception $e)
            {//データベースに障害が発生したら、こちらのプログラムが動きます
                print 'ただいま障害により大変ご迷惑をお掛けしています。';
                exit();//強制終了の命令
            }

        ?>

        <a href="pro_list.php">戻る</a><!--商品管理画面へ戻るリンクです。-->
    </body>
</html>