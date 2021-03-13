<html lang="en">

<head>

<style media="screen">
@media (max-width:420px){
  .span-tb{
    width: 70%!important;
  }

  #br-tb{
    display: block;
  }

  #font-tb{
    font-size: 25px;
  }
}

@media (min-width:421px){
  #br-tb{
    display: none;
  }
}
</style>

<title>Tubagus Aom</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<link href="../font/css/fontello.css" rel="stylesheet">
<!-- <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'> -->
<link rel="shortcut icon" type="image/x-icon" href="../img/mini.png" />
</head>
<body>
<div class="navbar">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
      <a class="brand" href="?Profile=&copy;Tubagus.Aom">
        <!-- <img src="img/user.jpg" alt=""> -->
      </a>
      <ul class="nav nav-collapse pull-left">
        <li><a href="?Profile=&copy;Tubagus.Aom"><i class="icon-user"></i> Profile</a></li> <br id="br-tb">
        <li><a href="?SkilLs=&copy;Tubagus.Aom" class="active"><i class="icon-trophy"></i> Skills</a></li> <br id="br-tb">
        <li><a href="?Work=&copy;Tubagus.Aom"><i class="icon-picture"></i> Work</a></li> <br id="br-tb">
        <li><a href="?Resume=&copy;Tubagus.Aom"><i class="icon-doc-text"></i> Resume</a></li> <br id="br-tb">
      </ul>
      <div class="nav-collapse collapse"></div>
    </div>
  </div>
</div>
<div class="container skills"  style="padding-bottom: 70px">
  <h2>My Skills <br id="br-tb"> ( <font id="font-tb" style="color: #fff">Programming languages</font> )</h2> <br>
  <div class="row">
    <div class="span3 span-tb">
      <div class="ps">
        <h3>php</h3>
      </div>
    </div>
    <div class="span5">
      <h3>php <span>90%</span></h3>
      <div class="expand-bg"> <span class="expand ps2"> &nbsp; </span> </div>
    </div>
  </div>
  <div class="row">
    <div class="span3 span-tb">
      <div class="ai">
        <h3>MySQL</h3>
      </div>
    </div>
    <div class="span5">
      <h3>MySQL <span>80%</span></h3>
      <div class="expand-bg"> <span class="expand ai2"> &nbsp; </span> </div>
    </div>
  </div>
  <div class="row">
    <div class="span3 span-tb">
      <div class="html">
        <h3>HTML</h3>
      </div>
    </div>
    <div class="span5">
      <h3>HTML <span>75%</span></h3>
      <div class="expand-bg"> <span class="expand html2"> &nbsp; </span> </div>
    </div>
  </div>
  <div class="row">
    <div class="span3 span-tb">
      <div class="css">
        <h3>CSS</h3>
      </div>
    </div>
    <div class="span5">
      <h3>CSS <span>85%</span></h3>
      <div class="expand-bg"> <span class="expand css2"> &nbsp; </span> </div>
    </div>
  </div>

  <div class="row">
    <div class="span3 span-tb">
      <div class="js">
        <h3>JS</h3>
      </div>
    </div>
    <div class="span5">
      <h3>JavaScript <span>50%</span></h3>
      <div class="expand-bg"> <span class="expand js2"> &nbsp; </span> </div>
    </div>
  </div>

  <h2 style="padding-top: 50px">My Skills <br id="br-tb"> ( <font id="font-tb" style="color: #fff">Framework</font> )</h2>
  <div class="row">
    <div class="span3 span-tb">
      <div class="ci">
        <h3>CI</h3>
      </div>
    </div>
    <div class="span5">
      <h3>CodeIgniter <span>70%</span></h3>
      <div class="expand-bg"> <span class="expand ci2"> &nbsp; </span> </div>
    </div>
  </div>
</div>

<?=require_once "footer.php"?>

<script src="../js/jquery-1.10.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
  $('#myModal').modal('hidden')
</script>
</body>
</html>
