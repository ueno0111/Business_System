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
            <script src="https://maxcdn.bootstrapcdn.co21m/bootstrap/4.0.0/js/bootstrap.min.js"></script>

            <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script><!--SVG WEBサイトで使うWEBアイコンフォンtを表示する仕組み-->
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js'></script><!--無料のCDN、クラウドフレア、インターネットセキュリティ強化&閲覧の高速化-->

            <script type="text/javascript" src="./parallax.min.js"></script>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/li00bs/lity/1.6.6/lity.css' /><!--セキュリティ-->
            <script src='https://cdnjs.cloudflare.com/ajax/libs/lity/1.6.6/lity.js'></script>

            <link href="staff_edit_check.css" rel="stylesheet">
            <link href="https://unpkg.com/sanitize.css" rel="stylesheet"/>
    </head>
    <body>

        <!--変更内容の確認画面-->
        <?php
            require_once('../common/common.php');

            $post=sanitize($_POST);
            $staff_code=$_POST['code'];//前の画面から入力データを受け取って、変数にコピーしています。$_POSTに前の画面のデータが格納されている
            $staff_name=$_POST['name'];
            $staff_pass=$_POST['pass'];
            $staff_pass2=$_POST['pass2'];

            if($staff_name == ''){  //スタッフ名が入力されていなければ、「スタッフ名が入力されていません」と表示します。」
                print'スタッフ名が入力されていません。<br/>';
            }else{
                print 'スタッフ名:';//スタッフ名が入力されていたら「パスワードが入力されていません。」と表示
                print $staff_name;
                print '<br/>';
            }

            if($staff_pass==''){//パスワードが入力されていない場合、「エラーメッセージを表示」
                print'パスワードが入力されていません　<br/>';
            }

            if($staff_pass!=$staff_pass2){//パスワードと確認の為にもう一度入力してもらったパスワードが同じでないなら、「パスワードが一致しません」と表示します
                print 'パスワードが一致しません。<br/>';
            }
            if($staff_name==''||$staff_pass==''||$staff_pass!=$staff_pass2){//もし入力に問題があったら「戻る」ボタンだけ表示します
                print'<form>';
                print'<input type="button" onclick="history.back()" value="戻る">';
                print'</form>';
            }else{
                $staff_pass=md5($staff_pass);//入力に問題がなければ「戻る」と「OK」。「OK」がクリックされたらデータを連れて次の画面へaff_add_done.php
                //md5は$staffpassを暗号化する
                print'<form method="post" action="staff_edit_done.php">';
                print'<input type="hidden" name="code" value="'.$staff_code.'">';
                print'<input type="hidden" name="name" value="'.$staff_name.'">';
                print'<input type="hidden" name="pass" value="'.$staff_pass.'">';
                print'<br/>';
                print'<input type="button" onclick="history.back()" value="戻る">';
                print'<input type="submit" value="OK">';
                print"<form>";
            }
        ?>
    </body>
</html>