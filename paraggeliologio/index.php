<!DOCTYPE html>
<html>
<head>
<?php
session_start();
 ?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Παραγγελιολόγιο</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
       <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
       
    <link rel="stylesheet" href="css/index.css">   
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<style>
        body{
    font-family: 'Ubuntu Condensed', sans-serif;
}
    a{
    font-family: 'Ubuntu Condensed', sans-serif;
}
    </style>
<body>

<div class="mdi mdi-alert-outline">
   
    </div>
    
    
    </div>
<!--<h2 style="position:absolute;top:17%;left:24%;color:teal;font-size:46px;">DOCUMENT MANAGEMENT SYSTEM </h2>	-->
    <div id="form_wrapper" class="form-wrapper">	
	
        <div id="form_left">
        <img src="images/deltalogo.jpg" style="height:30%;width:15%" alt="Avatar">	
			 <!--<img src="images/logo_delta.jpg" alt="delta icon">		
           <img src="images/pmed.png" alt="delta icon">-->		
					
        </div>
        <div id="form_right">
            <h3 style = "color:#50B8B8">Είσοδος</h3>
			<form action="checklogin.php" method="POST" class="form-group">
            <div class="input_container">          
                <i class="fas fa-address-book"></i>
                <input placeholder="Username" type="text" name="user_name" id="field_email" class='input_field'>
            </div> </br>
            <div class="input_container">
                <i class="fas fa-lock"></i>
                <input  placeholder="Password" type="password" name="password" id="field_password" class='input_field'>
            </div>
</br>
            <input type="submit" value="Login" id='input_submit' class='input_field'>
			</form>       
            <?php if (isset($_SESSION['changedpass'])) { ?>
            <span >            
            <a href="#" style="color:green;">Ο κωδικός σας άλλαξε επιτυχώς!</a>         
 
            </span>
            <?php }?>  
            <span id='create_account'>
                <p style ="font-size:0.75vw;">
            <a href=""  class="w3-bar-item w3-button">Xρησιμοποιήστε τους κωδικούς πρόσβασης όπως και στην πλαταφόρμα Performance Dialog (Διάλογος της Απόδοσης).</a>
            </span>  
            </p>
            </br>                 
             
            </span>
        </div>
        
    </div>
   
</body>
</html>
