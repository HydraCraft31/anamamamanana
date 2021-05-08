<?php
session_start();
if(!isset($_SESSION["uye_id"])){
    header("location:/girisyapmalisin/");
}

    include ('../ayarlar/ayar.php');    

$token = new token();
if(isset($_POST['destekAc'])){
$token_test = $_POST["spam_token"];
$baslik=$_POST['baslik'];
$kategori=$_POST['kategori'];
$icerik=$_POST['icerik'];
$kanit=$_POST['kanit'];
$ipadres = $_SERVER['REMOTE_ADDR'];
$guncelleme = date('YmdHis');
$durum = "0";

if($token->tokenSorgula($token_test) == false){
    header("location:/destek/");
    die();
}

if($baslik == "" || $kategori == "" || $icerik == ""){
    header("location:/destek/olustur/");
    die();
}
else{
        $ticket_olustur = $db->prepare("INSERT INTO tickets (nick,baslik,kategori,mesaj,durum,son_guncelleme,kanit) VALUES(?,?,?,?,?,?,?)");
        $ticket_olustur->execute(array($oyuncu_oku["username"],strip_tags($baslik),strip_tags($kategori),strip_tags($icerik),strip_tags($durum),strip_tags($guncelleme),strip_tags($kanit)));
        header("location:/destek/gonderildi/");
}
}

    include ('../head.php');

?>
<body>
    <?php
        include('../logo.php');
    ?>
    <div id="wrapper">
        <?php
            include ('../header.php');
        ?>
        <div id="sol">
            <div class="icBaslik"><div class="icBaslikYazi"><i class="fa fa-life-ring fa-3x"></i><font size="6"> <a href="../destek/">DESTEK</a> » DESTEK OLUŞTUR</font></div></div>
            <div class="ic">
                <br>
    <div class="destek-olustur">
        <div style="overflow-x:auto;">
                <form action="" method="POST">
                    <table class="destek-olustur-table">
                        <tr>
                            <td class="kutu1"><font face="Roboto Condensed" size="4">Başlık: *</font></td>
                            <td class="kutu"><input required type="text" id="baslik" name="baslik" class="form-control" maxlength="70" style="width: 100%" placeholder="Bir Başlık Belirleyiniz." /></td>
                        </tr>
                        <tr>
                            <td class="kutu1"><font face="Roboto Condensed" size="4">Konu: *</font></td>
                            <td class="kutu">
                                <select name="kategori" id="kategori" class="form-control" style="width: 101%">
                                    <option value="Genel">Genel</option>
                                    <option value="Öneri">Öneri</option>
                                    <option value="Şikayet">Şikayet</option>
                                    <option value="Hile Bildirimi">Hile Bildirimi</option>
                                    <option value="Ödeme Bildirimi">Ödeme Bildirimi</option>
                                    <option value="Diger islemler">Diğer işlemler</option>
                                </select></td>
                        <tr>
                        <tr>
                            <td class="kutu1"><font face="Roboto Condensed" size="4">Kanıt URL:</font></td>
                            <td class="kutu"><input type="text" id="kanit" name="kanit" class="form-control" style="width: 100%;" placeholder="Resim veya video bağlantı adresini girin." /></td>
                        </tr>
                        <td class="kutu"><font face="Roboto Condensed" size="4"> Mesajınız: *</font></td>
                        </table>
                        <table class="destek-olustur-table">
                        <tr>
                            <td class="kutu"><textarea style="width: 100%; height: 120px;" required type="text" id="icerik" name="icerik" class="form-control" placeholder="Destek ekibimize iletmek istediğiniz mesajı yazın."></textarea></td>
                        </tr>
                        <tr>
                            <td class="kutu"><button type="submit" name="destekAc" class="button-example-1 button-example-green pull-right"><font face="Roboto Condensed" size="4">Gönder</font></button></td>
                        </tr>
                    </table>
                    <input type="hidden" name="spam_token" value="<? echo $_SESSION['spam_token'] ?>" />
                </form>
                <br>
            </div>
            </div>
        </div>
    </div>
        <?php

            include ('../right.php');

        include ('../footer.php');
        
    ?>
    </div>
</body>
</html>
