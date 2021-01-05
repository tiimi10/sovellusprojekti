<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html>
<title>Welcome</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/application/css/w3.css">
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
  <img class="w3-image w3-padding-64" src="/images/pointer.jpg" alt="Pointer" style="width:80%">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>GPS</b></span> <span class="w3-text-black">Tracker</span></h1>
  </div>
</header>
 
<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">    
 
  <!-- About Section -->
  <div class="w3-container w3-padding-32" id="about">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">About</h3>
    <h4 class="w3-border-light-grey w3-padding-12">What is it?</h4>
    <p>
        This device is small and low power tracker, that collects gps-locations and sends them further. <br>
        It could be attached for example in car, motorbike, bicycle or anything you don't want to be stolen.<br>
        You can mark device as stolen in this webpage and after that, you will see exact location of the device every minute <br>
        One user can track many different devices and all of them are shown on map. Also whole location history can be shown as list of coordinates.
    </p>
    <h4 class="w3-border-light-grey w3-padding-12">IoT-device</h4>
    <p>Microcontroller with gps-receiver and LoRa transmitter.<br>
       -Device collects gps-location and sends collected data to the LoRaWAN-gateway <br>
       -Device also can receive status information (stolen or safe) and make actions based on that.<br>
       -If status is stolen, device starts sending location more often.
    </p>
    <h4 class="w3-border-light-grey w3-padding-12">Data transmission</h4>
    <p> -LoRa transmitter uses 863Hz frequency to send decoded data packets. <br>
        -From LoRaWAN gateway, data will go to the thinkpark server. <br>
        -In thinkpark-portal, we can monitor data and set our application server where data will be forwarded. <br>
        -Location data and device information will be sent to our server with JSON-packets by HTTP POST-requests. Locations will be stored to the database.<br>
        -Downlink messages to the IoT-node (with status info) can be sent too with HTTP POST-requests.<br>
        -Device only receives downlink messages when it sends uplink messages. This way we can save power.  
    </p>
    <h4 class="w3-border-light-grey w3-padding-12">Web-UI</h4>
    <p>Web-page which shows location information from database and put locations also on the map.<br>
       -There is main page with information about this project and login form.<br>
       -After succesful login, you can see your devices and each ones location history.<br>
       -You can mark device as stolen or safe and information will be sent to the device.
    </p>
    <div id="spoiler" style="display:none"> 
      <h4 class="w3-border-light-grey w3-padding-12">More</h4>
      <p> This project was an application project of telecommunications. Our team size was three persons <br>
          Project was done using Scrum-project managment framework and Trello.<br>
          Github was used for version controlling: <a href="https://github.com/tiimi10/sovellusprojekti" target="_blank" >Link to Github repository</a><br>
          Project poster and example of the tracker page(click to open):          
      </p>
      <img id="poster" src="/images/poster.png" alt="Project poster" style="width:100%;max-width:200px">
      <img id="webpage" src="/images/web_client.png" alt="Example of the tracker page" style="width:100%;max-width:200px">
      <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
      </div>
      <script>
      // Get the modal
      var modal = document.getElementById("myModal");
      //var modal2 = document.getElementById("myModal");

      // Get the image and insert it inside the modal - use its "alt" text as a caption
      var img = document.getElementById("poster");
      var img2 = document.getElementById("webpage");
      var modalImg = document.getElementById("img01");
      var captionText = document.getElementById("caption");
      img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
      }
      img2.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
      }

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() { 
        modal.style.display = "none";
      }
      </script>
    </div>
    <button class="w3-button w3-black w3-section " title="Click to show/hide content" type="button" onclick="
      if(document.getElementById('spoiler') .style.display==='none') {
        document.getElementById('spoiler') .style.display='';
        document.getElementById('lbl').innerHTML = 'Hide';
      }else{
        document.getElementById('spoiler') .style.display='none';
        document.getElementById('lbl').innerHTML = 'Click for more';
      }"><label id="lbl"></label></button>
    <script>document.getElementById('lbl').innerHTML = 'Click for more';</script>
  </div>
</div>


<!-- Image of network diagram -->
<div class="w3-display-container w3-content  w3-padding-32" style="max-width:1500px;" >
    <img class="w3-image" src="/images/network_diagram.jpg" alt="Network diagram" style="width:100%">
  <div class="w3-display-topmiddle ">
    <h4 class="w3-border-light-grey w3-padding-12">Network diagram</h4>
  </div>
</div>
 
<div class="w3-content w3-padding" style="max-width:1564px">  

  <!-- Login Section -->
  <div class="w3-container w3-padding-32" id="login">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Enter login details</h3>
    <form name="frmUser" method="post" action="/index.php/main/login">    
      <input class="w3-input w3-border" type="text" placeholder="Email" name="user_name">
      <input class="w3-input w3-section w3-border" type="password" placeholder="Password" name="password">
      <div class="message"><?php if(isset($SESSION['message'])){if($_SESSION['message']!="") { echo $_SESSION['message']; }} ?></div>
      <button class="w3-button w3-black w3-section" type="submit">
        <i class="fa fa-paper-plane"></i> SUBMIT
      </button>
    </form>
  </div>
  
  <!-- Image of prototype -->
  <div class="w3-display-container w3-content w3-padding-64" style="max-width:1000px;">
      <img src="/images/prototype.jpg" class="w3-image" style="width:100%">
      <div class="w3-display-topmiddle ">
        <h4 class="w3-border-light-grey w3-padding-12">Image of the prototype</h4>
      </div>
  </div>

    
</div>

</body>
</html>