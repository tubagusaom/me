
<?php
  // $base_ = (empty($_SERVER['HTTPS']) OR strtolower($_SERVER['HTTPS']) === 'off') ? 'http' : 'https';
  // $base_ .= '://'. $_SERVER['HTTP_HOST'];
  //
  // if ($_SERVER['HTTP_HOST'] == "localhost") {
  //   $base_app = $base_.str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']).APPPATH.'/';
  // }else{
  //   $base_app = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $base_.'/');
  // }

  if ($_SERVER['HTTP_HOST'] == "tb.indonesia-kompeten.com" ) {
    header('location:tubagus?Profile');
    $linkurl = "https://tb.indonesia-kompeten.com";

  }else {
    $linkurl = "http://mandala.web.id";
?>


<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تبغس اوم Portfolio</title>
    <link rel="shortcut icon" type="image/x-icon" href="../img/mini.png" />
  </head>

  <frameset border="0" rows="100%,*" cols="100%" frameborder="no">
    <frame name="TopFrame" scrolling="yes" noresize src="<?=$linkurl."/tubagus?Profile"?>">
    <frame name="BottomFrame" scrolling="no" noresize>
    <noframes></noframes>
  </frameset>

</html>



<?php
  }
  // header('location:tubagus?Profile');
?>
