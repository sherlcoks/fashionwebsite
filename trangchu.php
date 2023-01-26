<?php
require 'connect.php';
session_start();
$login_name = $_SESSION['userName'];
$randnumber = 8;

if (!isset($login_name)) {
    header('Location: login.html');
}

if (!empty($_GET['id'])) {
    if ($_GET['id'] == 'NU') {
        $where = 'L';
        $_SESSION['seach'] = $where;
    } else
    if ($_GET['id'] == 'NAM') {
        $where = 'M';
        $_SESSION['seach'] = $where;
    } else
    if ($_GET['id'] == 'FULL') {
        $where = '';
        $_SESSION['seach'] = $where;
    }
}

if (!empty($_POST["name"])) {
    $_SESSION['seach'] = $_POST["name"];
}
// $user = $_SESSION['userName'];
// if (!isset($user)) {
//     header("location: login.html");
//     exit();
// }
include 'search-NAM-NU.php';

?>


<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/infostep.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
</head>

<body>

<header>
        <a href="trangchu.php" class="logo">WELCOME</a>
        <div class="navigation">
            <ul class="menu">
                <div class="close-btn"></div>
                <li class="menu-item"><a href="trangchu.php">ホーム</a></li>
                <li class="menu-item">
                    <a class="sub-btn" href="#">ブランド<i class="fas fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li class="sub-item"><a href="#">H&M</a></li>
                        <li class="sub-item"><a href="#">Uniquilo</a></li>
                        <li class="sub-item"><a href="#">luis vitton</a></li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a class="sub-btn" href="#">おすすめ<i class="fas fa-angle-down"></i></a>
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
                <li class="menu-item"><a href="./cart.php">カート</a></li>
                <li class="menu-item"><a href="./account.php?<?=$login_name?>">Account:&nbsp;<span style="color: red;"><?=$login_name?></span></a></li>
                <li class="menu-item"><a href="logout.php">ログアウト</a></li>
            </ul>
        </div>
        <div class="menu-btn"></div>
    </header>

    <section class="section-home">
    </section>
    <section class="section-two">
        <h2>こんにちは、FASHION WEBSITEへようこそ<br></h2>
        <p>毎日、学校や仕事、外出の際、何を着ようか迷ってしまいる人が多いと思います。。 または服を買うとき、自分の体型、身長、体重に合った服の選び方がわからないし。 街に出ると、自分の体の特徴を尊重し、身なりを整えて目立つ人をたくさん見かけます。とはいえ、着こなしがかなりだらしなく、カジュアルな着こなしをしている人も少なくありません。 欠点を隠したり、美しさを見せたりすることはできません。 そこで、アドバイスをしたり、自分に合った服を提案したりするためのスマートなウェブサイトを作成することを思いつきました.毎日、学校や仕事、外出の際、何を着ようか迷ってしまいる人が多いと思います。。
            または服を買うとき、自分の体型、身長、体重に合った服の選び方がわからないし。 街に出ると、自分の体の特徴を尊重し、身なりを整えて目立つ人をたくさん見かけます。とはいえ、着こなしがかなりだらしなく、カジュアルな着こなしをしている人も少なくありません。 欠点を隠したり、美しさを見せたりすることはできません。 そこで、アドバイスをしたり、自分に合った服を提案したりするためのスマートなウェブサイトを作成することを思いつきました.</p>
        <a href="./infostep.html">スタート</a>
        <div class="parent">
            <div class="child" style="background: #<?= $_colorKQ_id ?>;"></div>
            <div class="child" style="background: #<?= $_colorKQ_id_2 ?>;"></div>
        </div>
    </section>
    <div class="listing-search" style="margin: 20px;">
        <form id="<?= $config_name ?>-search-form" action="trangchu.php?action=search" method="POST">
            <h1 style="margin-bottom:100px; color:#FA8F47;">あなたにおすすめの商品</h1>
            
                
                <a href="trangchu.php?id=FULL" >全て</a>
                <a href="trangchu.php?id=NAM" >男</a>
                <a href="trangchu.php?id=NU" >女</a>
                
                <span id="osusume" style="margin-left: 100px; font-size:25px; color:#8B8B8B ">
                    <?= $config_title ?>名: <input class="input" type="text" name="name" value="<?= !empty($name) ? $name : "" ?>" />
                    <input class="btn" type="submit" value="検索">
                </span>
        </form>
    </div>


    <div style="padding: 20px; margin: 20px; text-align: center;">
        <?php if (!empty($_GET['action'])) : ?>
            <p class="ketqua-seach" style="border: 1px solid red;">結果：<span style="color: red;"><?= $totalRecords ?></span> 商品</p>
        <?php else : ?>
            <?php include './pagination.php' ?>
        <?php endif; ?>
    </div>
    
    <section class="section-three">
        <?php if (!empty($totalPages)) : ?>
            <?php while ($row = mysqli_fetch_array($products)) : ?>
                <form action="Cart.php?action=add" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <a href="detail.php?id=<?= $row['id'] ?>" style="text-decoration: none;">
                        <img src="./<?= $row['src_quanao'] ?>" alt="spring clother" width="250px" height="250px">
                        </a>

                        <h1><?= (!empty($row['name'])) ? $row['name'] : "名前未設定" ?></h1>
                        <label>値段: </label><span><?= $row['quanao_price'] ?>円</span><br />
                        <span>数量：</span><input style="text-align: right; padding: 2px; margin: 2px;" type="text" value="1" name="quantity[<?= $row['id'] ?>]" size="1"><br />
                        <p><button>Add to Cart</button></p>
                    </div>
                </form>
            <?php endwhile ?>
        <?php endif ?>


    </section>
    <!-- <section class="section-three">
        <h1>おすすめ</h1>
        <?php
        // echo rand(1, 100);exit;

        // Check connection
        if (!$conn->connect_error) {
            $query = "SELECT MAX(id) FROM quan_ao";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            $id_MAX = $row[0];

            $rand = [];
            for ($i = 0; $i < $randnumber; $i++) {
                $rand[$i] = rand(1, $id_MAX);
            }
            $src_IMG = [];
            for ($i = 0; $i < sizeof($rand); $i++) {
                $sql_10_TOP_srcImage = "SELECT * FROM `quan_ao` WHERE id = '$rand[$i]'";
                $_sql_ = mysqli_query($conn, $sql_10_TOP_srcImage);
                $_sql_img = mysqli_fetch_assoc($_sql_);
                if (empty($_sql_img)) {
                    $sql_10_TOP_srcImage = "SELECT * FROM `quan_ao` WHERE id = '29'";
                    $_sql_ = mysqli_query($conn, $sql_10_TOP_srcImage);
                    $_sql_img = mysqli_fetch_assoc($_sql_);
                    $src_IMG[$i] = $_sql_img;
                } else {
                    $src_IMG[$i] = $_sql_img;
                }
            }
        } else {
            die("Connection failed: " . $conn->connect_error);
        }
        // print_r($src_IMG[0]['quanao_price']);exit;

        ?><?php for ($i = 0; $i < sizeof($src_IMG); $i++) : ?>
            <form action="Cart.php?action=add" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <label>
                            <a href="detail.php?id=<?= $src_IMG[$i]['id'] ?>" style="text-decoration: none;">
                                <img src="./<?= $src_IMG[$i]['src_quanao'] ?>" alt="spring clother" width="250px" height="250px">
                            </a>
                            <h1><?= (!empty($src_IMG[$i]['name'])) ? $src_IMG[$i]['name'] : "未名前" ?></h1>
                            <label>値段: </label><span><?= $src_IMG[$i]['quanao_price'] ?>円</span><br/>
                            <span>数量：</span><input style="text-align: right; padding: 2px; margin: 2px;" type="text" value="1" name="quantity[<?= $src_IMG[$i]['id'] ?>]" size="1"><br/>
                            <input type="submit" value="購入" />
                        </label>
                    </div>
                
            </form>
        <?php endfor ?>
    </section> -->


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
    <?php
    include 'footer.php';
    ?>