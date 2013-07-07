<?php
session_start();
 //require('add/check.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<META http-equiv="Content-Type" content="text/html" charset="UTF-8">
<html>
<head>
<title>Base Controller</title>
<link rel="stylesheet" href="css/css.css" type="text/css" />
</head>
<body>
<div id="hlavny">
	<span id="spanovy">» [<?php echo date('m-d-Y H:i:s', time());?>]<br>» <?php $name="vkristi";echo $name;?>@unattended:~$<div class="cursor"> </div></span>
  <div id="lavy">
  	<h1 style="margin-left:15px;">Links</h1>
<?php include('add/l_menu.html'); ?>
  </div>
  <div id="stred">
   <p style="margin-bottom: 30px;">Here you can graphical difference between programs used</p>
   <!-- <table cellspacing="0" cellpadding="0" summary="Software bundle 1 is top used bundle by far.">
      <caption align="top">Top used bundles on various machines (value of bundles is in thousands)<br /><br /></caption>
      <tr>
        <th scope="col" class="graf"><span class="auraltext">Bundle</span> </th>
        <th scope="col" class="graf"><span class="auraltext">Thousands of usages</span> </th>
      </tr>
      <tr>
        <td class="first">Linux bundle 1</td>
        <td class="value first"><img src="images/bar.png" alt="" width="200" height="16" />17.12</td>
      </tr>
      <tr>
        <td class="graf">Linux bundle 2</td>
        <td class="value"><img src="images/bar.png" alt="" width="104" height="16" />8.88</td>
      </tr>
      <tr>
        <td class="graf">Linux bundle 3</td>
        <td class="value"><img src="images/bar.png" alt="" width="98" height="16" />8.36</td>
      </tr>
      <tr>
        <td class="graf">Windows bundle 1</td>
        <td class="value"><img src="images/bar.png" alt="" width="70" height="16" />5.96</td>
      </tr>
      <tr>
        <td class="graf">Windows bundle 2</td>
        <td class="value"><img src="images/bar.png" alt="" width="56" height="16" />4.78</td>
      </tr>
      <tr>
        <td class="graf">IBM OS/2</td>
        <td class="value"><img src="images/bar.png" alt="" width="54" height="16" />4.62</td>
      </tr>
      <tr>
        <td class="graf">Solaris bundle</td>
        <td class="value"><img src="images/bar.png" alt="" width="50" height="16" />4.30</td>
      </tr>
      <tr>
        <td class="graf">BSD bundle</td>
        <td class="value"><img src="images/bar.png" alt="" width="39" height="16" />3.33</td>
      </tr>
      <tr>
        <td class="value last">MAC OS X bundle</td>
        <td class="value last"><img src="images/bar.png" alt="" width="12" height="16" />1.04</td>
      </tr>
    </table> -->


     <!--  <div class="pie" data-start="0" data-value="30"></div>
      <div class="pie highlight" data-start="30" data-value="30"></div>
      <div class="pie" data-start="60" data-value="40"></div>
      <div class="pie big" data-start="100" data-value="260"></div>-->
<!--       <div class="legend">
    <div id="browse-FF-lbl">Firefox <span>32.3%</span></div>
    <div id="browse-IE-lbl">Internet Explorer <span>30.5%</span></div>
    <div id="browse-Safari-lbl">Safari <span>2.8%</span></div>
    <div id="browse-Chrome-lbl">Chrome <span>1.7%</span></div>
    <div id="browse-Other-lbl">Other <span>1.6%</span></div>
    <div id="browse-Unknown-lbl">Uknown <span>31.1%</span></div>
  </div>

<div id="piece1" class="hold">
    <div class="pie"></div>
</div>
<div id="piece2" class="hold">
    <div class="pie"></div>
</div>
<div id="piece3" class="hold">
    <div class="pie"></div>
</div> -->

<div class="pieContainer">
     <div class="pieBackground"></div>
     <div id="pieSlice1" class="hold"><div class="pie"></div></div>
</div>

  </div>
  <div id="pravy">



		 <?php include('add/r_menu.html'); ?>

  </div>
</div>
</body>
</html>