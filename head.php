<!DOCTYPE html>
<html>
<head>
    <base href="<?php echo $site_url ?>" />
    <meta charset="utf-8" />
    <title><?php echo $baslik ?></title>
    <meta content="<?php echo $site_url ?>" property="og:url">
    <meta content="article" property="og:type">
    <meta content="<?php echo $baslik ?>" property="og:title">
    <meta content="<?php echo $site_url ?>/img/link-image.jpg" property="og:image">
    <meta content="<?php echo $aciklama ?>" property="og:description">
    <meta content="<?php echo $sunucu_ismi ?>" property="og:site_name">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="<?php echo $aciklama ?>" name="description">
    <meta content="LeaderOS" name="author">
    <meta content="<?php echo $anahtar_kelimeler ?>" name="keywords">
    <link href="<?php echo $site_url ?>/img/favicon.ico" rel="Shortcut Icon" type="image/x-icon">

    <!--CSS-->
    <link href="<?php echo $site_url ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo $site_url ?>/css/button.css" rel="stylesheet">
    <link href="<?php echo $site_url ?>/css/flags.css" rel="stylesheet">
    <link href="<?php echo $site_url ?>/css/tab.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $site_url ?>/css/swiper.min.css">
    <link rel="stylesheet" href="<?php echo $site_url ?>/css/sweetalert.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php echo $site_url ?>/css/component.css" />
    <!--CSS SON-->

    <!--JS--> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="<?php echo $site_url ?>/js/clipboard.min.js"></script>
    <script src="<?php echo $site_url ?>/js/jquery.scrollUp.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="<?php echo $site_url ?>/js/scripts.js"></script>
    <script src="<?php echo $site_url ?>/js/modernizr.custom.js"></script>
    <script>
        $(function () {
            $.scrollUp();
        });

    </script>
    <script src="<?php echo $site_url ?>/js/tab.js"></script>
   
    <script src="//momentjs.com/downloads/moment.min.js"></script>
    <script src="//ujafedny.org/assets/bower_components/moment/locale/*.js"></script>   <!-- Your preferred locale instead of * -->
    <script>
    var rq = '//mcapi.us/server/status?ip=<?php echo $ip ?>';     // <---- Your Minecraft server IP here; add &port=<port> if you are using a different port
    var error = 'unknown';              // of 25565. For instance: https://mcapi.us/server/status?ip=s.nerd.nu&port=25565 
    var classes = {                 // more info in https://mcapi.us/
        error: "fa-question",
        false: "fa-times",
        true: "fa-check",
    };
    var allclasses = "";
    for(i in classes) {
        allclasses += ' '+classes[i];
    };
    function q(addr, cb) {
        $.ajax({
            url: rq,
            type: 'GET',
            dataType: 'json',
            data: {ip: addr, players: true},
        })
        .done(function(data) {
            console.log("success");
            console.log(data);
            cb(data);
        })
        .fail(function(data) {
            console.log("error");
        })
        .always(function() {
        });
    }
    function setclass(o, c) {
        o.removeClass(allclasses);
        o.addClass(classes[c]);
        o.html('');
    }
    function settext(o, t) {
        o.removeClass(allclasses);
        o.html(t);
    }
    function display(data) {
        var np = $('#numplayers'),
            version = $('#version'),
            online = $('#online'),
            max = $('#max'),
            updated = $('#updated'),
            d = new Date(data.last_updated*1000);
        moment.locale('*');             // The locale which you have used before.
        settext(updated, moment(d).fromNow());
        setclass(online, data.online);
        if (data.online) {
        settext(np, data.players.now);
        } else {
        settext(np, '0/0');
        }
    }
    $(document).ready(function() {
        q('//lentium.xyz', display);
    });
    </script>
     <!--JS SON-->
</head>