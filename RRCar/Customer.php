<?php

$idCard = @$_POST['idCard'];
$cName = @$_POST['cName'];
$cLastname = @$_POST['cLastname'];
$cAddress = @$_POST['cAddress'];
$cTel = @$_POST['cTel'];
$cbrith = @$_POST['cbrith'];
$cEmail = @$_POST['cEmail'];

//$timestamp = strtotime($cbrith);

ini_set('display_errors', 1);
error_reporting(~0);

// $serverName = "localhost";
// $userName = "";
// $userPassword = "";
// $dbName = "rentcar";

// $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true);

// $conn = sqlsrv_connect( $serverName, $connectionInfo);

$servername ="MSI\SQLEXPRESS";
$connectionInfo= array("Database" => "RRCar",
 "UID" => "sa",
 "PWD" => "1234");

$conn =  sqlsrv_connect($servername, $connectionInfo);
$sql = "select * from customer";
$result = sqlsrv_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RRCar/Customer</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');
        body {
            font-family: 'Mitr', sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            display: flex;

            background-image: url('img/BG2.png');
            background-size: cover; /* หรือใช้ 'contain' หากต้องการรูปที่เล็กลง */
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        h1 {
            color: #333;
            justify-content: center;
            text-align: center;
        }

        div {
            flex: 1;
            /* padding: 10px; */
        }

        /* .container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            width: 400px;
            margin: 20px;
        } */

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.4); */
        }

        label {
            display: block;
            margin-bottom: 5px;
            margin-right: 0.5rem;
            width: 50%;
        }

        input, button {
            /* margin-right: 0.5rem; */
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
            white-space: nowrap;
        }

        th, td {
            padding: 16px;
            text-align: center;
            /* white-space: nowrap; */
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        .button-container {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        /* button {
            font-family: 'Mitr', sans-serif;
            background-color: blue;
            color: white;
            cursor: pointer;
            flex: 1;
            border-radius: 50px;
            box-sizing: border-box;
        }

        button:hover {
            background-color: rgb(88, 155, 255);
        } */

        .main {
            display: flex;
            background-color: #fff;
            width: 100%;
            padding: 18px;
            /* margin: auto; */
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.4);
        }

        .name_cus {
            display: flex;
            align-items: center;
        }

        .show__table {
            padding: 18px;
            font-size: 14px;
        }

        .flex{
            display: flex ;
            align-items: center;
        }

    </style>
</head>
<body>
    <div>
        <h1>Customer</h1>
        <div class="main">
            <div>
                <form id="customerForm" method="POST" action="Customer.php">
                    <div class="flex">
                        <label for="idCard">เลขบัตรประชาชน</label>
                        <input type="text" id="idCard" name="idCard"><br>
                    </div>

                    <div class="name_cus">
                        <label for="cName">ชื่อ</label>
                        <input type="text" id="cName" name="cName"><br>
                    </div>

                    <div class="name_cus">
                        <label for="cName">นามสกุล</label>
                        <input type="text" id="cLastname" name="cLastname"><br>
                    </div>

                    <div class="flex">
                        <label for="cAddress">ที่อยู่</label>
                        <input type="text" id="cAddress" name="cAddress"><br>
                    </div>

                    <div class="flex">
                        <label for="cbirth">วัน/เดือน/ปีเกิด</label>
                        <input type="date" id="cbirth" name="cbirth"><br>
                    </div>
        
                    <div class="flex">
                        <label for="cAddress">เบอร์โทรศัพท์</label>
                        <input type="text" id="cTel" name="cTel"><br> 
                    </div>

                    <div class="flex">
                        <label for="cEmail">อีเมล</label>
                        <input type="text" id="cEmail" name="cEmail"><br>
                    </div>

                    <div class="button-container">
                    <input type="submit" name="insert" value="Insert">
                    <input type="submit" name="edit" value="Edit">
                    <input type="submit" name="delete" value="Delete">
                    <input type="submit" name="show" value="Show">
                    </div>

                </form>
            </div>
            <div class="show__table">
                <table id="rentalTable">
                    <!-- ตารางนี้จะถูกอัปเดตด้วย JavaScript -->
                    <tr>
                    <thead>
                    <th>เลขบัตรประชาชน</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>ที่อยู่</th>
                    <th>วัน/เดือน/ปี</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>อีเมล</th>
                    </tr>
                    </thead>
                
                <tbody>
                <?php while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['citizen_id'];?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['surname']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['birth_date']->format('d-m-Y');?></td>
                        <td><?php echo $row['phone_number']; ?></td>
                        <td><?php echo $row['email']; ?></td>
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

    $sql = "insert into customer(citizen_id, name, surname,address,birth_date, phone_number, email)
     values('".$idCard."', '".$cName."', '".$cLastname."', '".$cAddress."', '".$cbrith."', '".$cTel."', '".$cEmail."')";


    $result = sqlsrv_query($conn, $sql);


    
        if($result === false){
                die(print_r(sqlsrv_errors(), true));
            }
    
            else{
                
            }
        }

        elseif(isset($_POST['edit'])){
            $sql = "Update customer Set name= '".$cName."', surname = '".$cLastname."', address = '".$cAddress."',birth_date = '".$cbrith."', phone_number = '".$cTel."' where citizen_id = '".$idCard."' ";
    
            $result = sqlsrv_query($conn, $sql);

            if($result === false){
                die(print_r(sqlsrv_errors(), true));
            }
    
            else{
                
            }
        }
    
        elseif(isset($_POST['delete'])){
            $sql = "delete from customer 
            where citizen_id = '".$idCard."' ";

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

<!-- <!DOCTYPE html>
<html>
<body>

<p>
<form method="POST" action="Home.html">
<input type="submit" name="home" value="home">
</form>


</p>

</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            /* padding: 0; */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            min-height: 100vh;
        }

        p {
            margin-bottom: 90px;
        }

        form {
            margin: 0;
            padding: 0;
            /* background-color: #86B8F4; */
        }
    </style>
</head>
<body>

<p>
    <form method="POST" action="Home.html">
        <input type="submit" name="home" value="Back to Home">
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