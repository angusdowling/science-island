<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Science Island</title>

    <!-- Styles -->
    <link href="/science/docs/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="/science/docs/css/master.css" rel="stylesheet" type="text/css">
    <!-- /Styles -->
    
	<script src="/science/docs/js/jquery-1.11.1.js" type="text/javascript"></script>

    <script>
     function resizeIframe( newHeight ){
        $('#realmContent').css('height', parseInt(newHeight, 10) + 100 + 'px').slideDown(300);
     }
    </script>

    <script>
        var thisVariable = <?php $blue ?>;
    </script>
</head>

<body>

    <?php include '/docs/includes/navbar.php' ?>

    <!-- <div id="upgradeBrowser">
        <p>Your browser is not supported. Please download a Chrome or Firefox to browse this website.</p>
    </div> -->

    <div class="content">
        <div id="unityPlayer">

            <div class="missing">
                <a href="http://unity3d.com/webplayer/" title="Unity Web Player. Install now!">
                    <img alt="Unity Web Player. Install now!" src="http://webplayer.unity3d.com/installation/getunity.png" width="193" height="63" />
                </a>
            </div>

            <div class="broken">
                <a href="http://unity3d.com/webplayer/" title="Unity Web Player. Install now! Restart your browser after install.">
                    <img alt="Unity Web Player. Install now! Restart your browser after install." src="http://webplayer.unity3d.com/installation/getunityrestart.png" width="193" height="63" />
                </a>
            </div>

        </div>
    </div>

	<div id="htmlContent"></div>

    <!-- Scripts -->
    <!-- Unity.js is required on on index page -->
    <script type='text/javascript' src='/science/docs/js/unity.js'></script> 

    <!-- main.js is required on all pages -->
    <script type='text/javascript' src='/science/docs/js/main.js'></script>
    <!-- /Scripts -->
</body>
</html>
