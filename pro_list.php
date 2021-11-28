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

        <link href="pro_list.css" rel="stylesheet">
        <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
    </head>

    <body>
        <?php
            try
            {
                $dsn = 'mysql:dbname=takeshiueno_database1;host=mysql1.php.xdomain.ne.jp';
                $user = 'takeshiueno_0111';
                $password = '5050Rock';//データベースに接続します
                $dbh = new PDO($dsn,$user,$password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $sql='SELECT code,name,price,gazou FROM mst_product WHERE 1';
                $stmt=$dbh->prepare($sql);
                $stmt->execute();

                $dbh=null;

                print '<div class="product">'.'<div class="product_text">商品一覧</div><br /><br />'.'</div>';
                

                print '<form method="post" action="pro_branch.php">';
                while(true)
                {
                    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if($rec==false)
                    {
                        break;
                    }

                    $pro_gazou=$rec['gazou'];
                    if($pro_gazou==""){//もしも画像のファイルがあれば表示のタグを準備
                        $disp_gazou='';//空なら何も表示されない
                    }else{
                        $disp_gazou='<img src="./gazou/'.$pro_gazou.'">';
                    }
                    print '<div class="content">'.'<input type="radio" name="procode" value="'.$rec['code']. '">';
                    print $rec['name'].'---';//名前を表示しています。
                    print $rec['price'].'円'.'</div>';
                    print '<div class="gazou">'.$disp_gazou.'</div>';
                    print '<br />';
                }
                    print '<input type="submit" name="disp" value="参照">';
                    print '<input type="submit" name="add" value="追加">';
                    print '<input type="submit" name="edit" value="修正">';;//[修正]ボタンを表示しています。
                    print '<input type="submit" name="delete" value="削除">';
                    print '</form>';

                }
                catch (Exception $e)
                {
                    print 'ただいま障害により大変ご迷惑をお掛けしております。';
                    exit();
                }

        ?>

            </br>
            <div class="top"><a href="../staff_login/staff_top.php">トップメニューへ</a></br></div>
    </body>
</html>