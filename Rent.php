<?php

$rentalNumber = @$_POST['rentalNumber'];
$regintionNumber = @$_POST['regintionNumber'];
$idCard = @$_POST['idCard'];
$rentalDate = @$_POST['rentalDate'];
$returnDate = @$_POST['returnDate'];
$actualReturnDate = @$_POST['actualReturnDate'];
$employeeCode = @$_POST['employeeCode'];

ini_set('display_errors', 1);
error_reporting(~0);
            

$serverName = "localhost";
$userName = "";
$userPassword = "";
$dbName = "rentcar";

$connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true);

$conn = sqlsrv_connect( $serverName, $connectionInfo);
$sql = "select * from rental_car";
$result = sqlsrv_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental</title>
    <style>
        /* ===================== import font ===================== */
        @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');

        /* ===================== setting body ===================== */
        body {
            font-family: 'Mitr', sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            display: flex;
        }

        /* ===================== decorate all h1 ===================== */
        h1 {
            color: #333;
            justify-content: center;
            text-align: center;
        }

        /* ===================== decorate all div ===================== */
        div {
            flex: 1;
            /* padding: 10px; */
        }

        /* ===================== decorate all form ===================== */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.4); */
        }

        /* ===================== decorate all lable ===================== */
        label {
            display: block;
            margin-bottom: 5px;
            margin-right: 0.5rem;
            width: 20%;
        }

        /* ===================== decorate all tag(input and button) ===================== */
        input, button {
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        /* ===================== setting table ===================== */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .button-container {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        /* ===================== decorate all tag(button) all ===================== */
        button {
            font-family: 'Mitr', sans-serif;
            background-color: blue;
            color: white;
            cursor: pointer;
            flex: 1;
            border-radius: 50px;
            box-sizing: border-box;
        }

        /* ===================== when hover button change color buuton ===================== */
        button:hover {
            background-color: rgb(88, 155, 255);
        }

        .main {
            display: flex;
            width: 80%;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }

        .show__table {
            padding: 20px;
        }

        .flex{
            display: flex ;
            align-items: center;
        }
    </style>
</head>
<body>
    <!-- ครึ่งทางซ้าย: Form -->
    <div>
        <h1>Rental Management System</h1>
        <div class="main">
            <!-- ===================== create form in div for rental ===================== -->
            <div>
                <form id="rentalForm" action="Rent.php" method="POST" >
                    <div class="flex">
                        <label for="rentalNumber">เลขที่เช่ารถ:</label>
                        <input type="text" id="rentalNumber" name="rentalNumber"><br>
                    </div>
                    
                    <di class="flex">
                        <label for="registrationNumber">เลขตัวถัง:</label>
                        <input type="text" id="registrationNumber" name="registrationNumber"><br>
                    </di>
        
                    <div class="flex">
                        <label for="idCard">เลขบัตรประชาชน:</label>
                        <input type="text" id="idCard" name="idCard"><br>
                    </div>

                    <div class="flex">
                        <label for="rentalDate">วันที่เช่า:</label>
                        <input type="date" id="rentalDate" name="rentalDate"><br>    
            
                        <label for="returnDate">วันที่คืน:</label>
                        <input type="date" id="returnDate" name="returnDate"><br>
                    </div>
        
                    <div class="flex">
                        <label for="actualReturnDate">วันที่คืนจริง:</label>
                        <input type="date" id="actualReturnDate" name="actualReturnDate"><br>
                    </div>
        
                    <div class="flex">
                        <label for="employeeCode">รหัสพนักงาน:</label>
                        <input type="text" id="employeeCode" name="employeeCode"><br>
                    </div>
        
                    <!-- ===================== create button for submit form ===================== -->
                    <div class="button-container">
                    <input type="submit" name="insert" value="insert">
                    <input type="submit" name="edit" value="edit">
                    <input type="submit" name="delete" value="delete">
                    <input type="submit" name="show" value="show">
                    </div>
                </form>
            </div>
            <!-- ===================== create table for show table when get data in php ===================== -->
            <div class="show__table">
                <table id="rentalTable">
                    <!-- ตารางนี้จะถูกอัปเดตด้วย php -->
                    <tr>
                    <thead>
                    <th>เลขที่เช่ารถ</th>
                    <th>เลขบัตรประชาชน</th>
                    <th>เลขตัวถัง</th>
                    <th>รหัสพนักงาน</th>
                    <th>วันที่เช่า</th>
                    <th>วันที่คืน</th>
                    <th>วันที่คืนจริง</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['rental_id']; ?></td>
                        <td><?php echo $row['citizen_id'];?></td>
                        <td><?php echo $row['Number']; ?></td>
                        <td><?php echo $row['employee_id']; ?></td>
                        <td><?php echo $row['rental_date']->format('d-m-Y');?></td>
                        <td><?php echo $row['return_date']->format('d-m-Y');?></td>
                        <td><?php echo $row['actual_return_date']->format('d-m-Y');?></td>
                        
                    </tr>
                <?php endwhile ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>

<?php
if($conn){

    
if(isset($_POST['insert'])){

$sql = "insert into rental_car(rental_id , citizen_id , employee_id , Number , rental_date , return_date , actual_return_date)
values('".$rentalNumber."', ".$idCard.", '".$employeeCode."', ".$regintionNumber.", '".$rentalDate."', '".$returnDate."', '".$actualReturnDate."' )";


$result = sqlsrv_query($conn, $sql);



if($result === false){
        die(print_r(sqlsrv_errors(), true));
    }

    else{
        
    }
}

elseif(isset($_POST['edit'])){
    $sql = "Update rental_car Set citizen_id = '".$regintionNumber."', employee_id = ".$idCard.", Number = ".$employeeCode.", rental_date = '".$rentalDate."', return_date = '".$returnDate."', actual_return_date = '".$actualReturnDate."' where rental_id = '".$rentalNumber."' ";

    $result = sqlsrv_query($conn, $sql);

    if($result === false){
        die(print_r(sqlsrv_errors(), true));
    }

    else{
        
    }
}

elseif(isset($_POST['delete'])){
    $sql = "delete from rental_car 
    where rental_id = '".$rentalNumber."' ";

    $result = sqlsrv_query($conn, $sql);
    if($result === false){
        die(print_r(sqlsrv_errors(), true));
    }
    else{
        
    }

}
elseif(isset($_POST['show'])){

    $sql = "select * from Cars";   

    $result = sqlsrv_query($conn, $sql);


    
            if($result === false){
                die(print_r(sqlsrv_errors(), true));
            }
    
            else{?>
                <html>
                    <body>
                <a href = "show.html">  </a>
            </body>
            </html>
                <?php
            }
        }

} 
else {
echo "database false.\n";
die(print_r(sqlsrv_errors(), true));
}

?>

<!DOCTYPE html>
<html>
<body>

<p>
<form method="POST" action="Home.html">
<input type="submit" name="home" value="home">
</form>


</p>

</body>
</html>

<?php
if(isset($_POST['home'])){

$sql = "select * from Cars";   

$result = sqlsrv_query($conn, $sql);



        if($result === false){
            die(print_r(sqlsrv_errors(), true));
        }

        else{?>
            <html>
                <body>
            <a href = "http://127.0.0.1/RRCAR/Home.html#">  </a>
        </body>
        </html>
            <?php
        }
    }
    ?>