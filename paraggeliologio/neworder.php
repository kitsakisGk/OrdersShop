<?php
include("dbconfig.php");
session_start();
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (isset($_POST["submitneworder"])) {

    for ($i = 0; $i <= $_SESSION['$counter2']; $i++) {
        $amountvariable = "amount" . $i;
        $productcodevariable = "productcode" . $i;
        if (!empty($_POST[$amountvariable]) > 0) {
            $productcode = $_POST[$productcodevariable];
            $amount = $_POST[$amountvariable];
            $user = $_SESSION["PMEU_User"];
            $parameters = [$user, $productcode, $amount];
            //print_r($parameters);    
            sqlsrv_configure('WarningsReturnAsErrors', 0);
            $sqlins = "{call dbo.PDO_NewOrder(?,?,?)}";
            $stmtins = sqlsrv_query($db, $sqlins, $parameters, array("Scrollable" => SQLSRV_CURSOR_KEYSET));
            if ($stmtins === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
                exit;
            }
        }
    }
    $deliverydate = $_SESSION["DeliveryDate"];
    $plant =  $_SESSION['Plant'];
    $user = $_SESSION["PMEU_User"];
    $parameters2 = [$user, $deliverydate, $plant];
    //print_r($parameters2);    
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $sqlins2 = "{call dbo.PDO_FinishOrder(?,?,?)}";
    $stmtins2 = sqlsrv_query($db, $sqlins2, $parameters2, array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    if ($stmtins2 === false) {
        echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
        exit;
    }

    $sqlsendmid = "exec sp_SendOrder_SAP";
    if (!$stmtsendmid = sqlsrv_prepare($db, $sqlsendmid,)) {
        echo "Statement could not be prepared.<br><br>\n";
        die(print_r(sqlsrv_errors(), true));
    }
    if (sqlsrv_execute($stmtsendmid) === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}

if (isset($_POST["saveorder"])) {

    for ($j = 0; $j <= $_SESSION['$counter2']; $j++) {
        $amountvariable = "amount" . $j;
        $productcodevariable = "productcode" . $j;
        if (!empty($_POST[$amountvariable]) > 0) {
            $productcode = $_POST[$productcodevariable];
            $amount = $_POST[$amountvariable];
            $user = $_SESSION["PMEU_User"];
            $parameters = [$user, $productcode, $amount];
            // print_r($parameters);    
            sqlsrv_configure('WarningsReturnAsErrors', 0);
            $sqlins = "{call dbo.PDO_NewOrder(?,?,?)}";
            $stmtins = sqlsrv_query($db, $sqlins, $parameters, array("Scrollable" => SQLSRV_CURSOR_KEYSET));
            if ($stmtins === false) {
                echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
                exit;
            }
        }
    }
    $deliverydate = $_SESSION["DeliveryDate"];
    $plant =  $_SESSION['Plant'];
    $user = $_SESSION["PMEU_User"];
    $parameters2 = [$user, $deliverydate, $plant];
    //print_r($parameters2);    
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $sqlins2 = "{call dbo.PDO_FinishSavedOrder(?,?,?)}";
    $stmtins2 = sqlsrv_query($db, $sqlins2, $parameters2, array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    if ($stmtins2 === false) {
        echo "Error (sqlsrv_query): " . print_r(sqlsrv_errors(), true);
        exit;
    }
}


//}
//echo "<script>if(confirm( 'Η παραγγελία καταχωρήθηκε' )){document.location.href='hub.php'};</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>




    <title>Παραγγελιολόγιο</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>-->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-indigo.css">

    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: "Open Sans", sans-serif
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            text-align: center;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            display: inline-block;

            margin: 0 auto;
            border: none;
            outline: none;
            cursor: pointer;
            text-align: center;



            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #009688;
            color: white;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            /*border: 1px solid #ccc;*/
            border-top: none;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: whitesmoke;
            color: gray;
            padding: 15px;
        }

        .btntop {
            margin-top: 5px;
        }

        .btnbot {
            margin-bottom: 5px;
            margin-left: 5px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #A9A9A9;
        }

        input[type="text"] {
            background: transparent;
            border: none;
        }


        .grouplabel {
            background: #3F51B5;
            color: white;
            /*border: 1px solid black;
            border-radius: 5px;*/
        }
    </style>

    <script type="text/javascript">
        function doMath(x) {
            var amount = parseFloat(document.getElementById('amount' + x).value);
            var price = parseFloat(document.getElementById('price' + x).value);
            var total = (amount * price).toFixed(2);
            if (isNaN(total)) {
                total = 0, 00;
            }
            document.getElementById('total' + x).value = total;
            var totals = '<?php echo  $_SESSION['$counter2']; ?>';
            const ordertotals = [];
            for (let i = 0; i < totals; i++) {
                var amount = parseFloat(document.getElementById('amount' + i).value);
                var price = parseFloat(document.getElementById('price' + i).value);
                var total = (amount * price);


                if (isNaN(total)) {
                    total = 0;
                }
                ordertotals[i] = total;
            }
            var ordertotal = ordertotals.reduce(function(a, b) {
                return (parseFloat(a) + parseFloat(b)).toFixed(2);
            }, 0);
            document.getElementById("ordertotal").value = ordertotal;
        }
    </script>



</head>

<body onload="setTimeout(onLoadAlert, 2000)">
    <script>
        
        function onLoadAlert() {
            //sleep(3000);
            alert('Η παραγγελία έχει καταχωρηθεί, θα αποσυνδεθείτε.');
            window.location.href = 'logout.php';

        }
    </script>
    <script type="text/javascript">
        /*
    document.onreadystatechange = function(){//window.addEventListener('readystatechange',function(){...}); (for Netscape) and window.attachEvent('onreadystatechange',function(){...}); (for IE and Opera) also work
    var ask = window.confirm("Η παραγγελία έχει καταχωρηθεί, θα αποσυνδεθείτε.");
        if (ask) {     
    
            window.location.href = "logout.php";
    
        }
    /*  if( document.readyState=='complete')
           ifconfirm ('Η παραγγελία έχει καταχωρηθεί, θα αποσυνδεθείτε.') 
        window.location.href = 'logout.php';
    
    }  */
    </script>
    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar  w3-left-align w3-large" style ="background : #FA2A4C;"> 
        <img class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-right " STYLE="width:15%;height:10%;" src="images/deltistas.png" alt="Avatar">    
   
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right  w3-hover-white w3-large "  href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
            <H5 class="w3-bar-item w3-button w3-hide-small w3-left  w3-hover-gray" STYLE="COLOR:white"> Μια καλή διατροφή ξεκινάει με Δέλτα - <span style = "color:#50B8B8"><strong>Μαζί το κάνουμε πράξη</strong> </span></H5> <!--EMPLOYEE PERFORMANCE & DEVELOPMENT MANAGEMENT SYSTEM -->
           </div>
    </div>

    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
    <H5 class="w3-bar-item w3-button w3-hide-small w3-left  w3-hover-gray" STYLE="COLOR:white"> Μια καλή διατροφή ξεκινάει με Δέλτα - <span style = "color:#50B8B8"><strong>Μαζί το κάνουμε πράξη</strong> </span></H5> <!--EMPLOYEE PERFORMANCE & DEVELOPMENT MANAGEMENT SYSTEM -->
       </div>



    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
        <!-- The Grid -->
        <div class="w3-row">
            <!-- Left Column -->
            <div class="w3-col m3">
                <!-- Profile -->
                <div class="w3-card w3-round w3-white">
                    <div class="w3-container">
                        <!--<h3 class="w3-center">PME</h3> -->
                        <p class="w3-center"><img src="images/deltalogo.jpg" style="height:140px;width:150px" alt="Avatar"></p>
                        <h4 class="w3-text-grey w3-center">Στοιχεία Εργαζομένου/νης</h4>
                        <hr>
                        <?php
                        $parameters2 = [$_SESSION["PMEU_User"]];
                        $sql2 = "{call dbo.sp_Order_DeliveryDate(?)}";
                        if (!$stmt2 = sqlsrv_prepare($db, $sql2, $parameters2)) {
                            echo "Statement could not be prepared.<br><br>\n";
                            die(print_r(sqlsrv_errors(), true));
                        }
                        if (sqlsrv_execute($stmt2) === false) {
                            die(print_r(sqlsrv_errors(), true));
                        } else {
                            while ($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {

                                $deliverydate = date_format($row2['DeliveryDate'], 'd-m-Y');
                                $diffdate = $row2['DiffDate'];
                                $_SESSION['DeliveryDate'] = $row2['DeliveryDate'];
                                $plant = $row2['DeliveryPlant'];
                                $_SESSION['Plant'] = $plant;
                                $_SESSION['OrderState'] = $row2['OrderState'];
                            }
                        } ?>
                               <p class="w3-border w3-padding w3-center w3-amber " style = "width:100%;font-size:0.8vw"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                               Η παραγγελία ενδέχεται να αλλάξει σε περίπτωση μη επάρκειας αποθεμάτων προς διάθεση. </p>
                       <p class="w3-border w3-padding w3-center w3-dark-gray " style = "width:100%;">Φόρμα Παραγγελίας Προϊόντων (Ημ.Παράδοσης : <strong> <?php echo $deliverydate; ?></strong>) </p>






                        <?php
                        $parameters = [$_SESSION["PMEU_User"]];
                        $sql = "{call dbo.SelectEmployeeData(?)}";
                        if (!$stmt = sqlsrv_prepare($db, $sql, $parameters)) {
                            echo "Statement could not be prepared.<br><br>\n";
                            die(print_r(sqlsrv_errors(), true));
                        }
                        if (sqlsrv_execute($stmt) === false) {
                            die(print_r(sqlsrv_errors(), true));
                        } else {
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

                                $user = $row['PMEU_User'];
                                $password = $row['PMEU_Pwd'];
                                $cardno = $row['PMEU_CardNo'];
                                $displayname = $row['PMEU_DisplayName'];
                                $email = $row['PMEU_Mail'];
                                $jobtitle = $row['PMEU_Title'];
                                $department = $row['PMEU_Department'];
                                $plant = $row['PMEU_Plant'];
                                $supervisor = $row['PMEU_SuperVisor'];
                                $managerflg = $row['ManagerFlag'];
                                $_SESSION['statecheck'] = $row['State'];
                            }
                        }
                        ?>
                        <h5><i class="fa fa-user fa-fw  w3-large "></i> - <?php echo $displayname; ?></h5>
                        <p><i class="fa fa-address-book fa-fw  w3-large "></i> - <?php echo $jobtitle; ?></p>
                        <p><i class="fa fa-building-o fa-fw  w3-large "></i> - <?php echo $department; ?></p>
                        <p><i class="fa fa-building fa-fw  w3-large "></i> - <?php echo $plant; ?></p>
                        <!--  <p><i class="fa fa-envelope-o fa-fw  w3-large "></i> - <?php //echo $email; 
                                                                                        ?></p>
                        <p><i class="fa fa-address-card-o fa-fw  w3-large "></i> - <?php //echo $cardno; 
                                                                                    ?></p>
                        <p style="color:#334191"><i class="fa fa-users fa-fw  w3-large "></i> - <?php //echo $supervisor; 
                                                                                                ?></p><br>  -->

                    </div>
                </div>
                <br>

                <!-- Accordion -->


                <br>
                <!-- Interests -->
                <div class="w3-card w3-round w3-white">
                    <a href="logout.php" onclick=" return confirm('Are you sure you want to logout?');">
                        <div class="w3-container  w3-padding"  style="background:#50B8B8;color:white;">
                            <i class="fa Example of sign-out fa-sign-out fa-fw"></i> Αποσύνδεση
                        </div>
                    </a>
                </div>
                <br>

                <!-- Alert Box 
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>Hey!</strong></p>
        <p>People are looking at your profile. Find out who.</p>
      </div>
      -->
                <!-- End Left Column -->
            </div>

            <!-- Middle Column -->
            <div class="w3-col m9">

                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white">
                        <p class="w3-center"><img src="images/deltashopping.png" style="width:30%;padding:20px;" alt="Avatar"></p>



                            <?php
                            // edw itan  }  
                            ?>
                            <?php if ($_SESSION['OrderState'] == 10) { ?>
                                <h3 class="w3-border w3-padding w3-center  " style ="background : #FA2A4C;color:white;">Η παραγγελία σας αποθηκεύτηκε επιτυχώς! </h3>
                            <?php } else { ?>
                                <h3 class="w3-border w3-padding w3-center  " style ="background : #FA2A4C;color:white;">Η παραγγελία έχει σταλεί επιτυχώς! </h3>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- End Middle Column -->
            </div>


        </div>

        <!-- End Grid -->
    </div>

    <!-- End Page Container -->
    </div>
    <br>

    <!-- Footer -->
    <!--<footer class="container-fluid text-center">
        <p>Performance & Development <a href="https://www.delta.gr" title="delta.gr" target="_blank" class="w3-hover-opacity">delta.gr</a></p>
    </footer>  -->

    <footer class="w3-container  w3-center" style ="background : #FA2A4C;">
    <h4 style="color:white">Μια καλή διατροφή ξεκινάει με Δέλτα - <span style = "color:#50B8B8"><strong>Μαζί το κάνουμε πράξη</strong> </span></h4>
    </footer>

    <script>
        // Accordion
        function myFunction(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                x.previousElementSibling.className += " w3-theme-d1";
            } else {
                x.className = x.className.replace("w3-show", "");
                x.previousElementSibling.className =
                    x.previousElementSibling.className.replace(" w3-theme-d1", "");
            }
        }

        // Used to toggle the menu on smaller screens when clicking on the menu button
        function openNav() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }
    </script>
</body>

</html>