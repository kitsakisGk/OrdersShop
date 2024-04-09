<?php
session_start();
include("dbconfig.php");
//include("objectivestatecheck.php");
include("perobjectcounter.php");
include("devobjectcounter.php");
include("fiscalyear.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Παραγγελιολόγιο</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
            background: #FA2A4C;
            color: white;
            /*border: 1px solid black;
            border-radius: 5px;*/
        }

        @media (max-width: 480px) {

            body {
                display: grid;
            }

            div.w3-content {
                width: 100% !important; /* Adjust this value as needed */

            }

            div.m9 {
                width: 100% !important; /* Adjust this value as needed */
                font-size:20px !important;
            }
            
            .btn-primary {
                padding: 10px 0px 5px 0px;
            }
            
            th:nth-child(1) {
            display: none;
            }

            .products tr td:first-child,
            .products tr th:first-child {
                display: none;
            }

            .products tr.grouplabel td,
            .products tr.grouplabel th {
                display: table-cell;
            }

        }

        @media (max-width: 797px) {

            body {
                display: grid;
            }

            div.w3-content {
                width: 100% !important; /* Adjust this value as needed */

            }

            div.m9 {
                width: 100% !important; /* Adjust this value as needed */
                font-size:20px !important;
            }

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
    <script>
        function ShowOrder() {
            var totals = '<?php echo  $_SESSION['$counter2']; ?>';

            for (let i = 0; i < totals; i++) {
                var amount = parseFloat(document.getElementById('amount' + i).value);

                if (isNaN(amount)) {
                    var x = document.OrderForm.line + i;
                    console.log(x);
                    document.getElementById('line' + i).style.display = 'none';
                }
            }
        }


        function validate() {
            if (document.OrderForm.ordertotal.value >= 70.01) {
                alert("Το ποσό της παραγγελίας υπερβαίνει τα 70€!");
                return false;
            } else if (document.OrderForm.ordertotal.value > 0 && document.OrderForm.ordertotal.value <= 70.01) {
                return true;
            } else {
                alert("Δεν έχετε επιλέξει προϊόντα!");
                return false;
            }
        }
    </script>



</head>

<body>
    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar  w3-left-align w3-large" style ="background : #FA2A4C;">       
       <img class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-right " STYLE="width:15%;height:10%;" src="images/deltistas.png" alt="Avatar">    
   
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right  w3-hover-white w3-large "  href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
            <H5 class="w3-bar-item w3-button w3-hide-small w3-left  w3-hover-gray" STYLE="COLOR:white"> Μια καλή διατροφή ξεκινάει με Δέλτα - <span style = "color:#50B8B8"><strong>Μαζί το κάνουμε πράξη</strong> </span></H5> <!--EMPLOYEE PERFORMANCE & DEVELOPMENT MANAGEMENT SYSTEM -->
           
             </div>
    </div>

    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block  w3-hide w3-hide-large w3-hide-medium w3-large">
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
                                $_SESSION['DiffDate'] = $diffdate;
                                $_SESSION['DeliveryDate'] = $row2['DeliveryDate'];
                                $plant = $row2['DeliveryPlant'];
                                $_SESSION['Plant'] = $plant;
                                $_SESSION['OrderState'] = $row2['OrderState'];
                                $_SESSION['SavedProducts'] = $row2['SavedProducts'];
                            }
                        } ?>
                         <p class="w3-border w3-padding w3-center w3-amber " id="no_products" style = "width:100%;font-size:0.8em"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                         Η παραγγελία ενδέχεται να αλλάξει σε περίπτωση μη επάρκειας αποθεμάτων προς διάθεση. </p>

                        <p class="w3-border w3-padding w3-center w3-dark-gray " style = "width:100%;">Φόρμα Παραγγελίας Προϊόντων (Ημ.Παράδοσης : <strong> <?php echo $deliverydate; ?></strong>) </p>

                        <?php
                        if ($diffdate == 0) { ?>
                            <p class="w3-border w3-padding w3-center " style="background:#FC3A5B;color:#2FD5CE;"><strong><a href="order.php">Υπάρχει ήδη απεσταλμένη παραγγελία για τις : <?php echo $deliverydate; ?>!</strong></a> </p>
                        <?php }
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
                        <div class="w3-container  w3-padding" style="background:#50B8B8;color:white;">
                            <i class="fa Example of sign-out fa-sign-out fa-fw"></i> Αποσύνδεση
                        </div>
                    </a>
                </div>
                <br>
                <!-- End Left Column -->
            </div>

            <!-- Middle Column -->
            <div class="w3-col m9" id="mid_table">

                <div class="w3-row-padding">
                    <div class="w3-col m12">
                        <div class="w3-card w3-round w3-white">
                            <p class="w3-center"><img src="images/deltashopping.png" style="width:30%;padding:20px;" alt="Avatar"></p>

                            <?php if ($_SESSION['DiffDate'] != 0) { ?> <!-- onsubmit="return  validate()" -->
                                <form class="form-inline" action="neworder.php" autocomplete="off" method="POST" id="OrderForm" name="OrderForm"  onsubmit="return validate();"> 
                                    <!-- onsubmit="return  validate()"  -->

                                    <table class="w3-center w3-table input " id="grid" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th class="w3-center ">Kωδικός</th>
                                                <th class="w3-center " style="">Περιγραφή Προιόντος</th>
                                                <th class="w3-center ">Tεμάχια</th>
                                                <th class="w3-center ">Τιμή Μονάδας</th>
                                                <th class="w3-center ">Σύνολο (ΦΠΑ)</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $sql2 = "exec PDO_EidosCategory";
                                        if (!$stmt2 = sqlsrv_prepare($db, $sql2,)) {
                                            echo "Statement could not be prepared.<br><br>\n";
                                            die(print_r(sqlsrv_errors(), true));
                                        }
                                        if (sqlsrv_execute($stmt2) === false) {
                                            die(print_r(sqlsrv_errors(), true));
                                        } else {
                                            while ($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {

                                                $prodcategory[] = $row2['ProdCategory'];
                                            }
                                        }
                                        //print_r($prodcategory);
                                        $counter = 0;
                                        $_SESSION['$counter2'] = 0;
                                        foreach ($prodcategory as $prodcategoryv) {

                                        ?>
                                            <tbody class="products" id="<?php echo "section" . $counter; ?>">
                                                <tr class="grouplabel w3-center ">
                                                    <th colspan="5" class=" w3-center"><?php echo $prodcategory[$counter]; ?> </th>
                                                </tr>

                                                <?php
                                                $parameters3 = [$prodcategoryv, $_SESSION['PMEU_User']];
                                                $sql3 = "{call dbo.PDO_EidosFromCategory(?,?)}";
                                                if (!$stmt3 = sqlsrv_prepare($db, $sql3, $parameters3)) {
                                                    echo "Statement could not be prepared.<br><br>\n";
                                                    die(print_r(sqlsrv_errors(), true));
                                                }
                                                if (sqlsrv_execute($stmt3) === false) {
                                                    die(print_r(sqlsrv_errors(), true));
                                                } else {
                                                    while ($row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {

                                                        $productcode = $row3['ProductCode'];
                                                        $productdescr = $row3['ProductDescr'];
                                                        $price = $row3['Price'];
                                                        $amount = $row3['OrderAmount'];

                                                        echo "<tr id = 'line" . $x . "' height='10px'><td><input type='text' class='w3-input w3-center' value = '" . $productcode . "' style='font-weight: bold;font-size:0.6em;'  name ='productcode" . $_SESSION['$counter2'] . "'  id='productcode" . $_SESSION['$counter2'] . "' readonly='true'>
                                                        </td><td align ='left' style ='font-size:0.6em;vertical-align: middle;'>" . $productdescr . "</td><td style ='text-align ='center' >
                                                        <input type='number' class='w3-input w3-center amounts' style ='font-size:0.6em;width:60%;margin-left:15px;'step='1' min = '0'  value = '" . $amount . "' name ='amount" . $_SESSION['$counter2'] . "'  id='amount" . $_SESSION['$counter2'] . "' onBlur='doMath(" . $_SESSION['$counter2'] . ");' ></td> ";

                                                        if ((float)$price < 1) {
                                                            echo " <td><input type='text' class='w3-input w3-center' value = 0" . $price . " style='font-weight: bold;font-size:0.6em;'  name='price' id='price" . $_SESSION['$counter2'] . "' readonly='true'>";
                                                        } else {
                                                            echo " <td><input type='text' class='w3-input w3-center' value = '" . $price . "' style='font-weight: bold;font-size:0.6em;'  name='price' id='price" . $_SESSION['$counter2'] . "' readonly='true'>";
                                                        }
                                                        echo "                                                    
                                                    <td><input type='text' class='w3-input w3-center' placeholder = '0,00' style='font-weight: bold;font-size:0.6em;'  name='total" . $_SESSION['$counter2'] . "' id='total" . $_SESSION['$counter2'] . "' readonly='true'>
                                                    </td></tr>";
                                                        $_SESSION['$counter2']++;
                                                    }
                                                }
                                                $counter++;
                                                ?>
                                            </tbody>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                    </br>
                                    <!-- <button id="ViewOrder" type="button" onclick="OrderView()">Εμφάνιση Παραγγελίας</button> -->
                                    </br>
                                    <div style="padding:10px;">
                                        <label for="ordertotal" class="w3-right" style="background:#50B8B8;color:white;width:50%;"> ΤΕΛΙΚΟ ΣΥΝΟΛΟ (συμπ. ΦΠΑ)</label>
                                        </br>
                                        </br>
                                        <h3><input type='text' class=' w3-right' value="0" min="0,01" max="70,00" style='font-weight:bold;padding:10px 10px;box-sizing:border-box;border :2px solid #50B8B8;width:24%;text-align: right; ' name='ordertotal' id='ordertotal' readonly='true'></h3>
                                    </div>
                                    </br>
                                    </br>
                                    </br>

                                    <div style="padding:10px;">
                                        <?php if ($diffdate == 0) { ?>
                                            <input type="button" value="Έλεγχος Παραγγελίας" id='btnHide' name='showorder' style="background:#334191;width:60%;border: none;font-size:1vw;height:auto;" class=' btn btn-primary ' disabled>

                                            <input type="submit" value="Αποστολή Παραγγελίας" id='submit' name='submit' style="background:#334191;width:40%;border: none;font-size:1vw;height:auto;" class=' btn btn-primary ' disabled>
                                        <?php  } else {  ?>
                                            <input type="button" value="Έλεγχος Παραγγελίας" id='btnHide' name='showorder' style="color:white;background:#9E9E9E;" class=' btn  '>
                                            <input type="button" value=" Όλα" id='btnReset' name='showorder' style="color:white;background:#9E9E9E" class=' btn  '>
                                            <input type="submit" value="Προσωρινή Αποθ." name='saveorder' style="background:#616161;width:33%;border:none;font-size:auto;height:auto;" class=' btn btn-primary ' >   <!-- onclick ="validatesave();"    onclick ="validate();"  -->
                                            <input type="submit" value="Υποβολή" name='submitneworder' style="background:#FFC107;width:30%;border:none;font-size:auto;height:auto; padding-top:5px;" class=' btn btn-primary '>
                                        <?php  }  ?>
                                    </div>
                                </form>




                            <?php } else {  ?>
                                <h3 class="w3-border w3-padding w3-center  " style ="background : #FA2A4C;color:white;">Η παραγγελία σας έχει υποβληθεί επιτυχώς! </h3>
                            <?php }  ?>


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

    <footer class="w3-container  w3-center  footer-size" style ="background : #FA2A4C;">
    <h4 style="color:white">Μια καλή διατροφή ξεκινάει με Δέλτα - <span style = "color:#50B8B8"><strong>Μαζί το κάνουμε πράξη</strong> </span></h4>
    </footer>
    <script>
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


    <script>
        $(document).ready(function() {
            if (<?php echo $_SESSION['OrderState']; ?>== 10 ){
                $("table td  .amounts").each(function() {
                    var cell = $(this).val();
                    //  var cell = $.trim($(this).text());
                    if (cell == 0) {
                        ($(this).parent()).parent().hide();
                        $(".grouplabel").hide();
                        $("btnReset").show();

                    }
                });
                doMath(<?php echo  $_SESSION['SavedProducts'];?>)
            }
            /*  $("table td  .amounts").each(function() {
                  var cellText = $(this).text();
                  if ($.trim(cellText) == '') {
                      $(this).css('background-color', 'cyan');
                  }
              });  */
            $('#btnHide').click(function() {
                $("table td  .amounts").each(function() {
                    var cell = $(this).val();
                    //  var cell = $.trim($(this).text());
                    if (cell == 0) {
                        ($(this).parent()).parent().hide();
                        $(".grouplabel").hide();
                        $("btnReset").show();

                    }
                });
            });
            $('#btnReset').click(function() {
                $("#grid tr").each(function() {
                    $(this).show();
                });
            });
        });


        /*<input type="button" id="btnHide" Value=" Hide Empty Rows " />
        <input type="button" id="btnReset" Value=" Reset " />  */
    </script>

<script>
    $('#OrderForm').on('keydown', 'input', function (event) {
    if (event.which == 13) {
        var $allInputs = $('#OrderForm .amounts, #OrderForm select')
        var $this = $(event.target);
        var index = $allInputs.index($this);
        if (index < $allInputs.length - 1) {
            event.preventDefault();
            $allInputs[index+1].focus()
        }
    }
});
    </script>


    <script>
        function validate() {

            if (document.OrderForm.ordertotal.value >= 70.01) {
                alert("Το ποσό της παραγγελίας υπερβαίνει τα 70€!");               
                return false;
            } else if (document.OrderForm.ordertotal.value > 0 && document.OrderForm.ordertotal.value <= 70.01) {          
            
                   // if (confirm('Είτε σίγουρος οτι θέλετε να υποβάλετε οριστικά την παραγγελία;')) {
                    return true;
                   // document.OrderForm.submit();
                                  }  else {
                alert("Δεν έχετε επιλέξει προϊόντα!");
                return false;
            }
            
        }
        function validatesave() {

if (document.OrderForm.ordertotal.value >= 70.01) {
    alert("Το ποσό της παραγγελίας υπερβαίνει τα 70€!");
    return false;
} else if (document.OrderForm.ordertotal.value > 0 && document.OrderForm.ordertotal.value <= 70.01) {
        
        //return true;
        document.OrderForm.submit();
   
      }  else {
    alert("Δεν έχετε επιλέξει προϊόντα!");
    return false;
}
}

/*
        function validatesave() {

            if (document.OrderForm.ordertotal.value >= 70.01) {
                alert("Το ποσό της παραγγελίας υπερβαίνει τα 70€!");
                return false;
            } else if (document.OrderForm.ordertotal.value > 0 && document.OrderForm.ordertotal.value <= 70.01) {


                return true;


                //return true;
            } else {
                alert("Δεν έχετε επιλέξει προϊόντα!");
                return false;
            }
        }

        */
    </script>


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