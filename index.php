<!DOCTYPE html>
<html>
 
<head>
	<title>Random Location Generator</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <meta name="description" content="Points to a random location on a google map and allows the user to view information such as photographs and wikipedia entries on the generated location. You can generated a new location by clicking on 'Refresh'.">
    <!-- <link rel="stylesheet" type="text/css" href="css/styleMob.css" media="(min-device-width: 320px) and (max-device-width: 768px)"/> -->
    <link rel="stylesheet" type="text/css" href="css/style.css" media=""/>
    
    <script src='jquery-1.7.2.min.js'></script>
    <script type="text/javascript" src="http://www.panoramio.com/wapi/wapi.js?v=1"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAsqQ8P0ggoWRhHzweY5skOm2B4X7OZkvU&amp;sensor=true&amp;libraries=panoramio"></script>
    <script type="text/javascript" src="script.js"></script>
    
  
  
    <!-- Loads google analytics -->
  
	<script type="text/javascript">

  	var _gaq = _gaq || [];
  	_gaq.push(['_setAccount', 'UA-34536404-1']);
  	_gaq.push(['_trackPageview']);

  	(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  	})();

	</script>
    <!-- Loads the share this--> 
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "ee713217-bbb5-4c6e-a0bc-b71cd2c4114b", doNotHash: false, doNotCopy: false, hashAddressBar: true});</script>

</head>

<body onload="initialize()">
<div id="container">
   	<div id="titleBox"><h1><a href="http://www.random-map.com">Random Map</a></h1></div>
	<div id="map_canvas"></div>
	<div id="sidePanel">
	  <h1>Position</h1>
	  <div id="currentPos">
	    <table>
	      
		  <tr>
	       <td>Location:</td>
	       <td><input type="text" id="location"/></td>
	      </tr>
		  
		  <tr>
	      <td>Longitude:</td>
	      <td><input type="text" id="longitude" /></td>
	      </tr>
		  
	      <tr>
	      <td>Latitude:</td>
	      <td><input type="text" id="latitude"/></td>
	      </tr>
	      <tr>
	      <td><Label for="photolayer">Photo Layer:</label></td>
	      <td><input type="checkbox" id="photolayer" name="photolayer" checked/></td>
		  </tr>
	    </table>
			
		</div>
		<div id="miniMap"></div>
		
		<div id="refresh" class='button' onClick="initialize()">
			Refresh
		</div>
		<div id="findMe" class="button" onclick="findUser()">
			Where am I?
		</div>
		
        
		<div id="socialNet">
			<span class='st_sharethis' displayText='ShareThis'></span>
			<span class='st_facebook' displayText='Facebook'></span>
			<span class='st_twitter' displayText='Tweet'></span>
			<span class='st_linkedin' displayText='LinkedIn'></span>
			<span class='st_pinterest' displayText='Pinterest'></span>
			<span class='st_email' displayText='Email'></span>
		</div>
	</div>
	
    <!-- Loads the comments section -->
    <?php
	include 'includes/comments.php';
	?>
	
</div>
</body>

</html>