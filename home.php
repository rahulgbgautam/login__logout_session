<?php
session_start();

if (!isset($_SESSION['name'])) {

    echo " you are logged out ";
    header('location:login.php');
}

?>

    <!DOCTYPE html>
<html lang="en">
<head>
  <title> Home Page </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<style>
     .nav-link{
            margin-left:90em;
        } 
		
		
		
		    body {
      background-color: black;
      color: white;
      font-family: 'Lucida Grande', Verdana, Arial;
      font-size: 12px;
      background-image: -webkit-gradient(radial,
                            50% 500, 1,
                            50% 500, 400,
                            from(rgba(255, 255, 255, 0.3)),
                            to(rgba(255, 255, 255, 0)));
     background-repeat: no-repeat;
    }

    #container {
      width: 100%;
      height: 700px;
      -webkit-perspective: 800; /* For compatibility with iPhone 3.0, we leave off the units here */
      -webkit-perspective-origin: 50% 225px;
    }
    #stage {
      width: 100%;
      height: 100%;
      -webkit-transition: -webkit-transform 2s;
      -webkit-transform-style: preserve-3d;
    }
    
    #shape {
      position: relative;
      top: 160px;
      margin: 0 auto;
      height: 200px;
      width: 200px;
      -webkit-transform-style: preserve-3d;
    }
    
    .plane {
      position: absolute;
      height: 200px;
      width: 200px;
      border: 1px solid white;
      -webkit-border-radius: 12px;
      -webkit-box-sizing: border-box;
      text-align: center;
      font-family: Times, serif;
      font-size: 124pt;
      color: black;
      background-color: rgba(255, 255, 255, 0.6);
      -webkit-transition: -webkit-transform 2s, opacity 2s;
      -webkit-backface-visibility: hidden;
    }

    #shape.backfaces .plane {
      -webkit-backface-visibility: visible;
    }
    
    #shape {
      -webkit-animation: spin 8s infinite linear;
    }

    @-webkit-keyframes spin {
      from { -webkit-transform: rotateY(0); }
      to   { -webkit-transform: rotateY(-360deg); }
    }

    /* ---------- cube styles ------------- */
    .cube > .one {
      opacity: 0.5;
      -webkit-transform: scale3d(1.2, 1.2, 1.2) rotateX(90deg) translateZ(100px);
    }

    .cube > .two {
      opacity: 0.5;
      -webkit-transform: scale3d(1.2, 1.2, 1.2) translateZ(100px);
    }

    .cube > .three {
      opacity: 0.5;
      -webkit-transform: scale3d(1.2, 1.2, 1.2) rotateY(90deg) translateZ(100px);
    }

    .cube > .four {
      opacity: 0.5;
      -webkit-transform: scale3d(1.2, 1.2, 1.2) rotateY(180deg) translateZ(100px);
    }

    .cube > .five {
      opacity: 0.5;
      -webkit-transform: scale3d(1.2, 1.2, 1.2) rotateY(-90deg) translateZ(100px);
    }

    .cube > .six {
      opacity: 0.5;
      -webkit-transform: scale3d(1.2, 1.2, 1.2) rotateX(-90deg) translateZ(100px) rotate(180deg);
    }


    .cube > .seven {
      -webkit-transform: scale3d(0.8, 0.8, 0.8) rotateX(90deg) translateZ(100px) rotate(180deg);
    }

    .cube > .eight {
      -webkit-transform: scale3d(0.8, 0.8, 0.8) translateZ(100px);
    }

    .cube > .nine {
      -webkit-transform: scale3d(0.8, 0.8, 0.8) rotateY(90deg) translateZ(100px);
    }

    .cube > .ten {
      -webkit-transform: scale3d(0.8, 0.8, 0.8) rotateY(180deg) translateZ(100px);
    }

    .cube > .eleven {
      -webkit-transform: scale3d(0.8, 0.8, 0.8) rotateY(-90deg) translateZ(100px);
    }

    .cube > .twelve {
      -webkit-transform: scale3d(0.8, 0.8, 0.8) rotateX(-90deg) translateZ(100px);
    }

    /* ---------- ring styles ------------- */
    .ring > .one {
      -webkit-transform: translateZ(380px);
    }

    .ring > .two {
      -webkit-transform: rotateY(30deg) translateZ(380px);
    }

    .ring > .three {
      -webkit-transform: rotateY(60deg) translateZ(380px);
    }

    .ring > .four {
      -webkit-transform: rotateY(90deg) translateZ(380px);
    }

    .ring > .five {
      -webkit-transform: rotateY(120deg) translateZ(380px);
    }

    .ring > .six {
      -webkit-transform: rotateY(150deg) translateZ(380px);
    }

    .ring > .seven {
      -webkit-transform: rotateY(180deg) translateZ(380px);
    }

    .ring > .eight {
      -webkit-transform: rotateY(210deg) translateZ(380px);
    }

    .ring > .nine {
      -webkit-transform: rotateY(-120deg) translateZ(380px);
    }

    .ring > .ten {
      -webkit-transform: rotateY(-90deg) translateZ(380px);
    }

    .ring > .eleven {
      -webkit-transform: rotateY(300deg) translateZ(380px);
    }

    .ring > .twelve {
      -webkit-transform: rotateY(330deg) translateZ(380px);
    }

    .controls {
      width: 80%;
      margin: 0 auto;
      padding: 5px 20px;
      -webkit-border-radius: 12px;
      background-color: rgba(255, 255, 255, 0.5);
    }
    .controls > div {
      margin: 10px;
    }
	
	
</style>


<body>

<nav class="navbar navbar-expand-sm bg-secondry navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">
    
  </a>
  
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
         <a class="nav-link text-light" href="logout.php"><h3>Logout</h3> </a>
    </li>
  </ul>
</nav>


<div class="container">
    
    <h4> User Name Is <?php echo $_SESSION['name']; ?> </h4>

</div>



  <div class="controls">
    <h1> Toggle for Different Shape </h1>

    <div><button onclick="toggleShape()">Toggle Shape</button></div>
    <div><input type="checkbox" id="backfaces" onclick="toggleBackfaces()" checked><label for="backfaces">Backfaces visible</label></div>
  </div>
  
  
  
  
  <div id="container">
    <div id="stage">
      <div id="shape" class="cube backfaces">
        <div class="plane one">1</div>
        <div class="plane two">2</div>
        <div class="plane three">3</div>
        <div class="plane four">4</div>
        <div class="plane five">5</div>
        <div class="plane six">6</div>
        <div class="plane seven">7</div>
        <div class="plane eight">8</div>
        <div class="plane nine">9</div>
        <div class="plane ten">10</div>
        <div class="plane eleven">11</div>
        <div class="plane twelve">12</div>
      </div>
    </div>
  </div>
  
  
  
  
  
  


  <script type="text/javascript" charset="utf-8">
    function hasClassName(inElement, inClassName)
    {
        var regExp = new RegExp('(?:^|\\s+)' + inClassName + '(?:\\s+|$)');
        return regExp.test(inElement.className);
    }

    function addClassName(inElement, inClassName)
    {
        if (!hasClassName(inElement, inClassName))
            inElement.className = [inElement.className, inClassName].join(' ');
    }

    function removeClassName(inElement, inClassName)
    {
        if (hasClassName(inElement, inClassName)) {
            var regExp = new RegExp('(?:^|\\s+)' + inClassName + '(?:\\s+|$)', 'g');
            var curClasses = inElement.className;
            inElement.className = curClasses.replace(regExp, ' ');
        }
    }

    function toggleClassName(inElement, inClassName)
    {
        if (hasClassName(inElement, inClassName))
            removeClassName(inElement, inClassName);
        else
            addClassName(inElement, inClassName);
    }

    function toggleShape()
    {
      var shape = document.getElementById('shape');
      if (hasClassName(shape, 'ring')) {
        removeClassName(shape, 'ring');
        addClassName(shape, 'cube');
      } else {
        removeClassName(shape, 'cube');
        addClassName(shape, 'ring');
      }
      
      // Move the ring back in Z so it's not so in-your-face.
      var stage = document.getElementById('stage');
      if (hasClassName(shape, 'ring'))
        stage.style.webkitTransform = 'translateZ(-200px)';
      else
        stage.style.webkitTransform = '';
    }
    
    function toggleBackfaces()
    {
      var backfacesVisible = document.getElementById('backfaces').checked;
      var shape = document.getElementById('shape');
      if (backfacesVisible)
        addClassName(shape, 'backfaces');
      else
        removeClassName(shape, 'backfaces');
    }
  </script>


</body>
</html>