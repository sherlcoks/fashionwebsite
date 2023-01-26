<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>product details</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./css/style.css" >
    </head>
    <body>
    <header>
        <a href="trangchu.php" class="logo">WELCOME</a>
        <div class="navigation">
            <ul class="menu">
                <div class="close-btn"></div>
                <li class="menu-item"><a href="#">ホーム</a></li>
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
                <li class="menu-item"><a href="#">サービス</a></li>
                <li class="menu-item"><a href="#">お問い合わせ</a></li>
                <li class="menu-item"><a href="./account.php?<?=$login_name?>">Account:&nbsp;</a></li>
                <li class="menu-item"><a href="logout.php">ログアウト</a></li>
            </ul>
        </div>
        <div class="menu-btn"></div>
    </header>

        <?php
        include 'connect.php';
        $result = mysqli_query($conn, "SELECT * FROM `quan_ao` WHERE `id` = ".$_GET['id']);
        $product = mysqli_fetch_assoc($result);
        $imgLibrary = mysqli_query($conn, "SELECT * FROM `image_library` WHERE `quan_ao_id` = ".$_GET['id']);
        $product['images'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
        ?>
        <div class="container">
            <h2>商品明細</h2>
            <div id="product-detail">
                <div id="product-img">
                    <img src="<?=$product['src_quanao']?>" />
                </div>
                <div id="product-info">
                    <h1><?=$product['id_quanao']?></h1>
                    <form id="add-to-cart-form" action="Cart.php?action=add" method="post" enctype="multipart/form-data">
                        <div class="color">
                            <input type="radio" name="color" value="blue" id="color" style="display: none;" class="color" >
                            <!-- neu khong co trong kho thi an no di  display: none; -->
                            <label style=" background-color:#9FB8D0; padding:15px 15px 15px 15px; margin:15px 1px 15px 15px; border-radius:20px;"></label>
                            <input type="radio" name="color" value="brown" id="color" style="display: none;" class="color">
                            <label style=" background-color:#53352B; padding:15px 15px 15px 15px; margin:15px 1px 15px 15px; border-radius:20px"></label>
                            <input type="radio" name="color" value="gray" id="color" style="display: none;" class="color">
                            <label style=" background-color:gray; padding:15px 15px 15px 15px; margin:15px 1px 15px 15px; border-radius:20px"></label> 
                            <input type="radio" name="color" value="green" id="color" style="display: none;" class="color">
                            <label style=" background-color:#35532B; padding:15px 15px 15px 15px; margin:15px 1px 15px 15px; border-radius:20px"></label>
                        </div>
                        
                        <div class="size">
                             <!-- neu khong co trong kho thi an no di  display: none; -->
                            <input type="radio" name="size" value="s" id="size" style="display: none;" class="size">
                            <label style=" font-weight: bolder; border:1px solid black; padding:10px 10px 10px 10px;margin:15px 15px 15px 1px;"  >S</label>
                            <input type="radio" name="size" value="m" id="size" style="display: none;" class="size">
                            <label style=" font-weight: bolder; border:1px solid black; padding:10px 10px 10px 10px;margin:15px 15px 15px 1px;" >M</label>
                            <input type="radio" name="size" value="l" id="size" style="display: none;" class="size">
                            <label style=" font-weight: bolder;border:1px solid black; padding:10px 10px 10px 10px;margin:15px 15px 15px 1px;" >L</label> 
                            <input type="radio" name="size" value="xl" id="size" style="display: none;" class="size">
                            <label style=" font-weight: bolder;border:1px solid black; padding:10px 10px 10px 10px;margin:15px 15px 15px 1px;" >XL</label>
                        </div>
                        <label>値段: </label><span class="product-price"><?= number_format($product['quanao_price'], 0, ",", ".") ?> 円</span><br/>
                        <input type="text" value="1" name="quantity[<?=$product['id']?>]" size="2" /><br/>
                        <input type="submit" value="購入" />
                    </form>
                    <?php if(!empty($product['images'])){ ?>
                    <div id="gallery">
                        <ul>
                            <?php foreach($product['images'] as $img) { ?>
                                <li><img src="<?=$img['path']?>" /></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
                <div class="clear-both">
                    <div>CONTENT:</div>
                    &nbsp;&nbsp;<?=$product['content']?>
                </div>
            </div>
        </div>
        <script>
            
             const color = document.querySelectorAll('label');
            color.forEach(element => {
            element.addEventListener('click',()=>{
                color.forEach(element => {
                    element.style.border="none";
                });
                element.style.border="2px solid black";
                

            })
                 
        });      
        </script>
    </body>
</html>