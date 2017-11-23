<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel= "stylesheet" type="text/css" href="index_style.css" />
    <script src="handlers.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous" ></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fix My Teeth</title>
</head>

<body>

	<div id="container">
        <div id="content-slider">
      <div id="slider">  <!-- Slider container -->
         <div id="mask">  <!-- Mask -->
         <ul>
         <li id="first" class="firstanimation">  <!-- ID for tooltip and class for animation -->
         <img src="web_elements/background.jpg" alt="Cougar"/>
         </li>
         <li id="second" class="secondanimation">
         <img src="web_elements/background_1.jpg" alt="Lions"/>
         </li>
         <li id="third" class="thirdanimation">
         <img src="web_elements/background_2.jpg" alt="Snowalker"/>
         </li>
         <li id="third" class="fourthanimation">
         <img src="web_elements/background_00.jpg" alt="Msg"/>
         </li>
         </ul>
         </div>  <!-- End Mask -->
         <div class="progress-bar"></div>  <!-- Progress Bar -->
      </div>  <!-- End Slider Container -->
    </div>
    <table>
    <tr>
    <th>
    <div class="group">
      <input type="text"/><span class="highlight"></span><span class="bar"></span>
      <label>Locate Dentist (Address)</label>
    </div>
    </th>
    <th>
    <div class="group">
      <input type="text"/><span class="highlight"></span><span class="bar"></span>
      <label>Your City</label>
    </div>
    </th>
    <th>
    <div class="group">
      <input type="text"/><span class="highlight"></span><span class="bar"></span>
      <label>Specialty</label>
    </div>
    </th>
    <th>
    <div class="group">
      <input type="text"/><span class="highlight"></span><span class="bar"></span>
      <label>Doctor Name</label>
    </div>
    </th>
    </tr>
    <tr>
    <td>
    <div class="group">
     <input type="text" list="browser1"/><span class="highlight"></span><span class="bar"></span>
     <label>Day</label>
        <datalist id="browser1">
                <option value="Not to specify">
 		<option value="Monday">
  		<option value="Tuesday">
 		<option value="Wednesday">
  		<option value="Thursday">
 		<option value="Saturday">
  		<option value="Sunday">
	</datalist>
    </div>
    </td>
    <td>
    <div class="group">
     <input type="text" list="browser0"/><span class="highlight"></span><span class="bar"></span>
     <label>Time Schedule(24h format)</label>
        <datalist id="browser0">
            <option value="Not to specify">
            <option value="00:00">
            <option value="00:30">
            <option value="01:00">
            <option value="01:30">
            <option value="02:00">
            <option value="02:30">
            <option value="03:00">
            <option value="03:30">
            <option value="04:00">
            <option value="04:30">
            <option value="05:00">
            <option value="05:30">
            <option value="06:00">
            <option value="06:30">
            <option value="07:00">
            <option value="07:30">
            <option value="08:00">
            <option value="08:30">
            <option value="09:00">
            <option value="09:30">
            <option value="10:00">
            <option value="10:30">
            <option value="11:00">
            <option value="11:30">
            <option value="12:00">
            <option value="12:30">
            <option value="13:00">
            <option value="13:30">
            <option value="14:00">
            <option value="14:30">
            <option value="15:00">
            <option value="15:30">
            <option value="16:00">
            <option value="16:30">
            <option value="17:00">
            <option value="17:30">
            <option value="18:00">
            <option value="18:30">
            <option value="19:00">
            <option value="19:30">
            <option value="20:00">
            <option value="20:30">
            <option value="21:00">
            <option value="21:30">
            <option value="22:00">
            <option value="22:30">
            <option value="23:00">
            <option value="23:30">
        </datalist>
    </div>
    </td>
    <td>
    <div class="group">
     <input type="text" list="browser2"/><span class="highlight"></span><span class="bar"></span>
     <label>Gender</label>
        <datalist id="browser2">
            <option value="Not to specify">
            <option value="Female">
            <option value="Male">
	</datalist>
    </div>
    </td>
    <td>
    <div class="group">
     <input type="text" list="browser3"/><span class="highlight"></span><span class="bar"></span>
     <label>Photo?</label>
     <input type="checkbox" value="Photo?" />
    </div>
    </td>
    </tr>
    </table>
	</div>

</body>
</html>
