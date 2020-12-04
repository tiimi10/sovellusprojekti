<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html>
<title>Welcome</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/application/third_party/w3.css">
<body>
    
<!--navbar-->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"> Home</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="#login" class="w3-bar-item w3-button">Log in</a>
    </div>
  </div>
</div>
   
<!--header-->
<header class="w3-display-container w3-content w3-wide w3-padding-64" style="max-width:1000px;" id="home">
  <img class="w3-image" src="/images/pointer.jpg" alt="Architecture" width="1280" height="1060">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>GPS</b></span> <span class="w3-hide-small w3-text-black">-Tracker</span></h1>
  </div>
</header>
 
<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">    
 
<!-- About Section -->
  <div class="w3-container w3-padding-32" id="about">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">About</h3>
    <h4 class="w3-border-light-grey w3-padding-12">IoT-device</h4>
    <p>Microcontroller with gps-receiver and nb-iot transmitter.<br>
        1. Device can collect gps-information.<br>
        2. Device knows when owners mobile-phone is nearby<br>
        3. Device can send collected data to the database in server <br>
        4. Device can receive orders (make sound order so owner can find device)
    </p>
    <h4 class="w3-border-light-grey w3-padding-12">Web-UI</h4>
    <p>1. Can display sent information from database, ie locations on the map.<br>
        2. The user can instruct the IoT device to beep. (IoT starts beeping)<br>
        3. Can send alarm message if the device is stolern. The alarm message arrives, for example, in an e-mail or as a text message
    </p>
    <h4 class="w3-border-light-grey w3-padding-12">Data processing algorithm</h4>
    <p>1. Server that runs database and web-UI and can process data coming from device.<br>
        2. Database that stores collected data  <br>
        3. Based on the information received, algorithm knows whether the device is stolen or not and issues an alarm.<br>
        2. Location information from users mobile can be used too for the algorithm


    </p>
  </div>    
  
  <!-- Login Section -->
  <div class="w3-container w3-padding-32" id="login">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Enter login details</h3>
    <form name="frmUser" method="post" action="/index.php/main/login">    
      <input class="w3-input w3-border" type="text" placeholder="Email" name="user_name">
      <input class="w3-input w3-section w3-border" type="password" placeholder="Password" name="password">
      <div class="message"><?php if($_SESSION['message']!="") { echo $_SESSION['message']; } ?></div>
      <button class="w3-button w3-black w3-section" type="submit">
        <i class="fa fa-paper-plane"></i> SUBMIT
      </button>
    </form>
  </div>
  
  <!-- Image of prototype -->
  <div class="w3-display-container w3-content w3-wide w3-padding-64" style="max-width:1000px;">
      <img src="/images/prototype.jpg" class="w3-image" style="width:100%">
  </div>

    
</div>

</body>
</html>