<?php
include "connect.php";
session_start();
$login_name = $_SESSION['userName'];
$kensa_KQ = $_SESSION['kensa_KQ'];
$_colorKQ_id = $_SESSION['color_id'];
$_colorKQ_id_2 = $_SESSION['color_id_2'];

// echo"1: $_colorKQ_id, 2: $_colorKQ_id_2";exit;

$result = [
    "status" => false,
    "message" => "現在システムを利用することができません。",
    "result" => []
];

// lay id quan ao
if(!empty($kensa_KQ) && !$conn -> connect_error){
    $conn -> set_charset($DB_CHARSET);
    $quanao_sql = "SELECT * FROM quan_ao WHERE src_quanao LIKE 'image/image-quanao/$kensa_KQ%'";
    // print"$quanao_sql";exit;

    if($kekka = $conn -> query($quanao_sql)){
        $result["status"] = true;
        while($row = $kekka -> fetch_array(MYSQLI_ASSOC)){
            $result["result"][] = $row;
        }
        $kekka -> close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KETQUA</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/infostep.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
</head>

<body>

    <header>
        <a class="logo" onclick="chuyentrang()">ホーム</a>
        <script>
            function chuyentrang() {
                if(window.confirm('結果を削除しますので、ホームページに移動しますか。')){
                    location.href = "trangchu.php";
                }
            }
        </script>
        <div class="navigation">
            <ul class="menu">
                <div class="close-btn"></div>
                <li class="menu-item"><a href="#">Home</a></li>
                <li class="menu-item">
                    <a class="sub-btn" href="#">Brand<i class="fas fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li class="sub-item"><a href="#">H&M</a></li>
                        <li class="sub-item"><a href="#">Uniquilo</a></li>
                        <li class="sub-item"><a href="#">luis vitton</a></li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a class="sub-btn" href="#">Recommend<i class="fas fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li class="sub-item"><a href="#">Simple clother</a></li>
                        <li class="sub-item"><a href="#">Set clother</a></li>
                        <li class="sub-item more">
                            <a class="more-btn" href="#">Other<i class="fas fa-angle-right"></i></a>
                            <ul class="more-menu">
                                <li class="more-item"><a href="#">shoe</a></li>
                                <li class="more-item"><a href="#">caple</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu-item"><a href="#">Services</a></li>
                <li class="menu-item"><a href="#">About</a></li>
                <li class="menu-item"><a href="./account.php?<?=$login_name?>">Account:&nbsp;<span style="color: red;"><?=$login_name?></span></a></li>
                <li class="menu-item"><a href="./Cart.php">カート</a></li>
                <li class="menu-item"><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="menu-btn"></div>
    </header>

    <section class="section-home">
    </section>
    <section class="section-two">
        <h2>こんにちは、FASHION WEBSITEへようこそ<br></h2>
        <div>
        <p>毎日、学校や仕事、外出の際、何を着ようか迷ってしまいる人が多いと思います。。 または服を買うとき、自分の体型、身長、体重に合った服の選び方がわからないし。 街に出ると、自分の体の特徴を尊重し、身なりを整えて目立つ人をたくさん見かけます。とはいえ、着こなしがかなりだらしなく、カジュアルな着こなしをしている人も少なくありません。 欠点を隠したり、美しさを見せたりすることはできません。 そこで、アドバイスをしたり、自分に合った服を提案したりするためのスマートなウェブサイトを作成することを思いつきました.毎日、学校や仕事、外出の際、何を着ようか迷ってしまいる人が多いと思います。。
            または服を買うとき、自分の体型、身長、体重に合った服の選び方がわからないし。 街に出ると、自分の体の特徴を尊重し、身なりを整えて目立つ人をたくさん見かけます。とはいえ、着こなしがかなりだらしなく、カジュアルな着こなしをしている人も少なくありません。 欠点を隠したり、美しさを見せたりすることはできません。 そこで、アドバイスをしたり、自分に合った服を提案したりするためのスマートなウェブサイトを作成することを思いつきました.</p>
        <a id="ketQua" href="./infostep.html">スタート</a><br>
        </div>
        <p><span style="border: 1px red solid; padding:8px; color:yellow; ">結果</span></p>
        <div class="parent">
            <p class="child" style="background: #<?= $_colorKQ_id ?>;"></p>
            <p class="child" style="background: #<?= $_colorKQ_id_2 ?>;"></p>
        </div>
    </section>
    <section class="section-three">
        <h1>おすすめ</h1>
        <?php if($result["status"]): ?>
         <?php foreach($result["result"] as $u): ?>
            <form action="Cart.php?action=add" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <label>
                            <a href="detail.php?id=<?= $u['id'] ?>" style="text-decoration: none;">
                                <img src="./<?= $u['src_quanao'] ?>" alt="spring clother" width="250px" height="250px">
                            </a>
                            <h1><?= (!empty($u['name'])) ? $u['name'] : "未名前" ?></h1>
                            <label>値段: </label><span><?=$u['quanao_price']?>円</span><br/>
                            <span>数量：</span><input style="text-align: right; padding: 2px; margin: 2px;" type="text" value="1" name="quantity[<?= $u['id']?>]" size="1"><br/>
                            <input type="submit" value="購入" />
                        </label>
                    </div>
                
            </form>
         <?php endforeach ?>
        <?php else: ?>
            <div>
                <p class="text-xl"><?= $result["message"] ?></p>
            </div>
        <?php endif ?>
    </section>


    <script type="text/javascript">
        //jquery for toggle dropdown menus
        $(document).ready(function() {
            //toggle sub-menus
            $(".sub-btn").click(function() {
                $(this).next(".sub-menu").slideToggle();
            });

            //toggle more-menus
            $(".more-btn").click(function() {
                $(this).next(".more-menu").slideToggle();
            });
        });

        //javascript for the responsive navigation menu
        var menu = document.querySelector(".menu");
        var menuBtn = document.querySelector(".menu-btn");
        var closeBtn = document.querySelector(".close-btn");

        menuBtn.addEventListener("click", () => {
            menu.classList.add("active");
        });

        closeBtn.addEventListener("click", () => {
            menu.classList.remove("active");
        });

        //javascript for the navigation bar effects on scroll
        window.addEventListener("scroll", function() {
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        });
    </script>
    <script src="./js/ketqua.js"></script>
<?php
include 'footer.php';
?>