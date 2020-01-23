<?php
  if(isset($_GET['Profile'])){
    include "profile.html";
  }
  elseif(isset($_GET['SkilLs'])){
    include "skills.html";
  }
  elseif(isset($_GET['Work'])){
    include "work.html";
  }
  elseif(isset($_GET['Resume'])){
    include "resume.html";
  }
  elseif(isset($_GET['Download-Resume'])){
    // include "../cv/CV_tubagus.docx";
    header('location:../cv/CV_tubagus.docx');
  }
?>
