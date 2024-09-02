<?php

$idCard = @$_POST['idCard'];
$eName = @$_POST['eName'];
$eLastname = @$_POST['eLastname'];
$ePosition = @$_POST['ePosition'];
$eTel = @$_POST['eTel'];

ini_set('display_errors', 1);
error_reporting(~0);

$serverName = "localhost";
$userName = "";
$userPassword = "";
$dbName = "rentcar";

$connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true);

$conn = sqlsrv_connect( $serverName, $connectionInfo);


if($conn){
    // echo "database sucess.\n";

        if(isset($_POST['insert'])){

    $sql = "insert into employee(employee_id, name, surname,position,phone_number)
     values('". $idCard."', '".$eName."', '".$eLastname."', '".$ePosition."', ".$eTel.")";
    //$sql = "insert into rental_car(rental_id, employee_id, citizen_id,rental_date) values('".$rentalNumber."', '".$registrationNumber."', '".$idCard."', '".$rentalDate."')";


    $result = sqlsrv_query($conn, $sql);


    
            if($result === false){
                die(print_r(sqlsrv_errors(), true));
            }
    
            else{
                header("Location: ".$_SERVER['REQUEST_URI']);
                exit();
            }
        }

        elseif(isset($_POST['edit'])){
            $sql = "Update employee Set name= '".$eName."', surname = '".$eLastname."', position = '".$ePosition."', phone_number = ".$eTel." where employee_id = '". $idCard."' ";
    
            $result = sqlsrv_query($conn, $sql);

            if($result === false){
                die(print_r(sqlsrv_errors(), true));
            }
    
            else{
                print "Edit data Compleat<br>";
            }
        }
    
        elseif(isset($_POST['delete'])){
            $sql = "delete from employee 
            where employee_id = '". $idCard."' ";

            $result = sqlsrv_query($conn, $sql);
            if($result === false){
                die(print_r(sqlsrv_errors(), true));
            }
            else{
                
            }

        }
} 
else {
    echo "database false.\n";
    die(print_r(sqlsrv_errors(), true));
}

?>
