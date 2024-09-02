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
$sql = "select * from employee";
$result = sqlsrv_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');
        body {
            font-family: 'Mitr', sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            display: flex;
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

        .container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            width: 400px;
            margin: 20px;
        }

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
            width: 20%;
        }

        input, button {
            margin-right: 0.5rem;
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

        button {
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
        }

        .main {
            display: flex;
            width: 80%;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }

        .name_cus {
            display: flex;
            align-items: center;
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
    <div>
        <h1>Employee Management System</h1>
        <div class="main">
            <div>
                <form id="EmployeeForm" action="Employee.php" method="POST">
                    <div class="flex">
                        <label for="idCard">รหัสพนักงาน:</label>
                        <input type="text" id="idCard" name="idCard"><br>
                    </div>

                    <div class="name_cus">
                        <label for="eName">ชื่อ:</label>
                        <input type="text" id="eName" name="eName"><br>
        
                        <label for="eLastname">นามสกุล:</label>
                        <input type="text" id="eLastname" name="eLastname"><br>
                    </div>
                    <div class="flex">
                        <label for="ePosition">ตำแหน่ง:</label>
                        <input type="text" id="ePosition" name="ePosition"><br>
                    </div>
        
                    <div class="flex">
                        <label for="eTel">เบอร์โทรศัพท์:</label>
                        <input type="text" id="eTel" name="eTel"><br> 
                    </div>


                    <div class="button-container">
                    <input type="submit" name="insert" value="insert">
                    <input type="submit" name="edit" value="edit">
                    <input type="submit" name="delete" value="delete">

                    </div>
                </form>
            </div>
            <div class="show__table">
                <table id="rentalTable">
                <thead>
                    <!-- ตารางนี้จะถูกอัปเดตด้วย JavaScript -->
                    <tr>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>ตำแหน่ง</th>
                    <th>เบอร์โทรศัพท์</th>
                </tr>
                </thead>
                <tbody>
                <?php while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['employee_id'];?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['surname']; ?></td>
                        <td><?php echo $row['position']; ?></td>
                        <td><?php echo $row['phone_number']; ?></td>
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

    $sql = "insert into employee(employee_id, name, surname,position,phone_number)
     values('". $idCard."', '".$eName."', '".$eLastname."', '".$ePosition."', ".$eTel.")";


    $result = sqlsrv_query($conn, $sql);


    
        if($result === false){
                die(print_r(sqlsrv_errors(), true));
            }
    
            else{
                
            }
        }

        elseif(isset($_POST['edit'])){
            $sql = "Update employee Set name= '".$eName."', surname = '".$eLastname."', position = '".$ePosition."', phone_number = ".$eTel." where employee_id = '". $idCard."' ";
    
            $result = sqlsrv_query($conn, $sql);

            if($result === false){
                die(print_r(sqlsrv_errors(), true));
            }
    
            else{
                
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