<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><? echo "$panel_baslik"; ?></title>

<link href="<? echo "$site_url"; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<? echo "$site_url"; ?>css/datepicker3.css" rel="stylesheet">
<link href="<? echo "$site_url"; ?>css/styles.css" rel="stylesheet">
<link href="<? echo $site_url ?>/img/favicon.ico" rel="Shortcut Icon" type="image/x-icon">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

    <script src="//code.jquery.com/jquery-2.2.1.min.js"></script>
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

</head>