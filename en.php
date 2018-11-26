<?php
// Modified by Tianyi: adding top-right widget info
// lazy config check/load
if (file_exists('LookingGlass/Config.php')) {
  require 'LookingGlass/Config.php';
  if (!isset($ipv4, $ipv6, $siteName, $siteUrl, $serverLocation, $testFiles, $theme)) {
    exit('Configuration variable/s missing. Please run configure.sh');
  }
} else {
  exit('Config.php does not exist. Please run configure.sh');
}

function getIP() {
  if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }
  return $ip_address;
}

?>
<!DOCTYPE html>
<html lang="en">
<!--
                 __ _
               .: .' '.
              /: /     \_
             ;: ;  ,-'/`:\
             |: | |  |() :|
             ;: ;  '-.\_:/
              \: \     /`
               ':_'._.'
                  ||
                 /__\
      .---.     {====}
    .'   _,"-,__|::  |
   /    ((O)=;--.::  |
  ;      `|: |  |::  |
  |       |: |  |::  |            *****************************
  |       |: |  |::  |            * LookingGlass by Telephone *
  |       |: |  |::  |            *  http://iamtelephone.com  *
  |       |: |  |::  |            *****************************
  |       |: |  |::  |
  |      /:'__\ |::  |
  |     [______]|::  |
  |      `----` |::  |__
  |         _.--|::  |  ''--._
  ;       .'  __{====}__      '.
   \    .'_.-'._ `""` _.'-._    '.
    '--'/`      `''''`      `\    '.__
        '._                _.'
           `""--......--""`
-->
  <head>
    <meta charset="utf-8">
    <title><?php echo $siteName; ?> - Looking Glass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LookingGlass - Open source PHP looking glass">
    <meta name="author" content="Telephone">

    <!-- IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Styles -->
    <link href="assets/css/<?php echo $theme; ?>.min.css" rel="stylesheet">
  </head>
  <body>
    <!-- Container -->
    <div class="container">

      <!-- Header -->
      <header class="header nohighlight" id="overview">
        <div class="row">
          <div class="span12">
            <h1><a id="title" href="<?php echo $siteUrl; ?>/en.php"><?php echo $siteName; ?></a></h1>
          </div>
        </div>
      </header>

      <!-- Network Information -->
      <section id="information">
        <div class="row">
          <div class="span8">
            <div class="well">
              <span id="legend">Network information</span><!-- IE/Safari dislike <legend> out of context -->
              <p>Server Location: <b><?php echo $serverLocation; ?></b></p>
              <div style="margin-left: 10px;">
                <p>Test IPv4: <?php echo $ipv4; ?></p>
                <p><?php if (!empty($ipv6)) { echo 'Test IPv6: ',$ipv6; } ?></p>
                <p>Test files: <?php
                  foreach ($testFiles as $val) {
                    echo "<a href=\"{$val}.test\" id=\"testfile\">{$val}</a> ";
                  }
                ?></p>
              </div>
              <p>Your IP Address: <b><a href="#tests" id="userip"><?php echo getIP(); ?></a></b></p>
            </div>
          </div>

        <div class="span4">
            <div class="well">
              <span id="legend">
                更多信息
              </span>
              <p><a href="/">Wordpress速度演示</a></p>
              <p><a href="https://www.gubo.org/reliable-vps-providers/">本站所有VPS列表</a></p>
              <p><a href="http://w3.gubo.org/status/">在线时间</a></p>
              <p><a href="http://www.vpscang.com/">VPS仓 - VPS大全</a></p>
            </div>
          </div>
        </div>
      </section>

      <!-- Network Tests -->
      <section id="tests">
        <div class="row">
          <div class="span12">
            <form class="well form-inline" id="networktest" action="#results" method="post">
              <fieldset>
                <span id="legend">Network tests</span>
                <div id="hosterror" class="control-group">
                  <div class="controls">
                    <input id="host" name="host" type="text" class="input-large" placeholder="Host or IP address">
                  </div>
                </div>
                <select name="cmd" class="input-medium" style="margin-left: 5px;">
                  <option value="host">host</option>
                  <option value="mtr">mtr</option>
                  <?php if (!empty($ipv6)) { echo '<option value="mtr6">mtr6</option>'; } ?>
                  <option value="ping" selected="selected">ping</option>
                  <?php if (!empty($ipv6)) { echo '<option value="ping6">ping6</option>'; } ?>
                  <option value="traceroute">traceroute</option>
                  <?php if (!empty($ipv6)) { echo '<option value="traceroute6">traceroute6</option>'; } ?>
                </select>
                <button type="submit" id="submit" name="submit" class="btn btn-primary" style="margin-left: 10px;">Run Test</button>
              </fieldset>
            </form>
          </div>
        </div>
      </section>

      <!-- Results -->
      <section id="results" style="display:none">
        <div class="row">
          <div class="span12">
            <div class="well">
              <span id="legend">Results</span>
              <pre id="response" style="display:none"></pre>
            </div>
          </div>
        </div>
      </section>

      <!-- Footer -->
      <footer class="footer nohighlight">
        <p class="pull-right">
            <a href="<?php echo $siteUrl; ?>">中文</a>
            <a href="#">Back to top</a>
        </p>
        <p>Modified by <a href="https://github.com/ILLKX/LookingGlass-Gayyi">LookingGlass</a> - Powered by <a href="https://github.com/telephone/LookingGlass">LookingGlass</a></p>
      </footer>

    </div><!-- /container -->

    <!-- Javascript -->
    <script src="assets/js/jquery-1.11.2.min.js"></script>
    <script src="assets/js/LookingGlassEn.min.js"></script>
    <script src="assets/js/XMLHttpRequest.min.js"></script>
  </body>
</html>
