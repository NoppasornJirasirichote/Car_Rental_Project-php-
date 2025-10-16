<?php

$registrationNumber = @$_POST['registrationNumber'];
$noLicence = @$_POST['noLicence'];
$province = @$_POST['province'];
$cars = @$_POST['cars'];
$Models = @$_POST['Models'];
$colors = @$_POST['colors'];
$years = @$_POST['years'];
$price = @$_POST['price'];
$status = @$_POST['status'];

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
$sql = "select * from Cars";
$result = sqlsrv_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RRCar/Cars</title>
    <style>
        /* ===================== import font ===================== */
        @import url('https://fonts.googleapis.com/css2?family=Mitr&display=swap');

        /* ===================== setting body ===================== */
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
        /* ===================== decorate tag in page all tag ===================== */

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
            /* width: 100%; */
            background-color: #fff;
            padding: 50px;
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

        select {
            width: 100px;
            height: 40px;
            margin-bottom: 10px;
        }

        .form-group {
            display: flex;
            flex-wrap: wrap;
            width: 64%;
        }

        .main {
            display: flex;
            background-color: #fff;
            width: 100%;
            padding: 18px;
            /* margin: auto; */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
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
        <h1>Cars</h1>
        <div class="main">
            <div>
                <form id="carsForm" method="POST" action="Cars.php">
                    <div class="flex">
                        <label for="registrationNumber">เลขตัวถัง</label>
                        <input type="text" id="registrationNumber" name="registrationNumber"><br>
                    </div>
                  
                    <div class="flex">
                        <label for="rentalNumber">เลขทะเบียน</label>
                        <input type="text" id="noLicence" name="noLicence"><br>
                    </div>
                    
                    <div class="flex">
                        <label for="idCard">จังหวัด</label>
                        <input type="text" id="province" name="province"><br>
                    </div>
                    
                    <!-- <form> -->
                    <div class="form-group">
                        <label for="cars">ยี่ห้อรถยนต์</label>
                        <select name="cars" id="cars">
                        <option value="">-เลือก-</option>
                        <option value="Toyota">Toyota</option>
                        <option value="Honda">Honda</option>
                        <option value="Ford">Ford</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="models">รุ่นรถยนต์</label>
                        <select name="Models" id="Models">
                        <option value="">-เลือก-</option>
                        <option value="Camry">Camry</option>
                        <option value="Civic">Civic</option>
                        <option value="Mustang">Mustang</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="colors">สีรถยนต์</label>
                        <select name="colors" id="colors">
                        <option value="">-เลือก-</option>
                        <option value="Blue">Blue</option>
                        <option value="Red">Red</option>
                        <option value="Black">Black</option>
                        </select>
                    </div>
                    <!-- </form> -->
                    
                    <div class="flex">
                        <label for="idCard">ปีที่ผลิต</label>
                        <input type="text" id="years" name="years"><br>
                    </div>
                    
                    <div class="flex">
                        <label for="idCard">ราคาเช่าต่อวัน</label>
                        <input type="text" id="price" name="price"><br>
                    </div>
                    
                   <div class="form-group">
                        <label for="status">สถานะ</label>
                        <select name="status" id="status">
                        <option value="">-เลือก-</option>
                        <option value="Available">Available</option>
                        <option value="Rented">Rented</option>
                        </select>
                   </div>

                    <!-- <div class="button-container">
                        <button type="button" onclick="addData()">เพิ่ม</button>
                        <button type="button" onclick="deleteData()">ลบ</button>
                        <button type="button" onclick="editData()">แก้ไข</button>
                    </div> -->
                    
                    <div class="button-container">
                    <input type="submit" name="insert" value="Insert">
                    <input type="submit" name="edit" value="Edit">
                    <input type="submit" name="delete" value="Delete">
                    <input type="submit" name="show" value="Show">
                    </div>
                    
                </form>
            </div>
            <div class="show__table">
                <table id="carsTable">
                    <!-- ตารางนี้จะถูกอัปเดตด้วย JavaScript -->
                    <thead>
                    <tr>
                        <th>เลขที่ตัวถัง</th>
                        <th>เลขทะเบียน</th>
                        <th>จังหวัด</th>
                        <th>ยี่ห้อรถยนต์</th>
                        <th>รุ่นรถยนต์</th>
                        <th>สีรถยนต์</th>
                        <th>ปีที่ผลิต</th>
                        <th>ราคาเช่าต่อวัน</th>
                        <th>สถานะ</th>
                    </tr>
                    </thead>
                    <tbody>
                <?php while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['Number']; ?></td>
                        <td><?php echo $row['RegistrationPlate']; ?></td>
                        <td><?php echo $row['Province']; ?></td>
                        <td><?php echo $row['Brand']; ?></td>
                        <td><?php echo $row['CarModel']; ?></td>
                        <td><?php echo $row['CarColor']; ?></td>
                        <td><?php echo $row['ManufacturingYear']; ?></td>
                        <td><?php echo $row['RentalPricePerDay']; ?></td>
                        <td><?php echo $row['Status']; ?></td>

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


    if(isset($_POST['show'])){

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

        elseif(isset($_POST['insert'])){

    $sql = "insert into Cars(Number, RegistrationPlate, Province, Brand, CarModel, CarColor, ManufacturingYear, RentalPricePerDay, Status)
     values(".$registrationNumber.", '".$noLicence."', '".$province."', '".$cars."', '".$Models."', '".$colors."', ".$years.", ".$price.", '".$status."')";


    $result = sqlsrv_query($conn, $sql);


    
        if($result === false){
                die(print_r(sqlsrv_errors(), true));
            }
    
            else{
                
            }
        }

        elseif(isset($_POST['edit'])){
            $sql = "Update Cars Set RegistrationPlate = '".$noLicence."', Province = '".$province."', Brand = '".$cars."', CarModel = '".$Models."', CarColor = '".$colors."', ManufacturingYear = ".$years.", RentalPricePerDay = ".$price.", Status = '".$status."' where Number = ".$registrationNumber." ";
    
            $result = sqlsrv_query($conn, $sql);

            if($result === false){
                die(print_r(sqlsrv_errors(), true));
            }
    
            else{
                
            }
        }
    
        elseif(isset($_POST['delete'])){
            $sql = "delete from cars
            where Number = ".$registrationNumber." ";

            $result = sqlsrv_query($conn, $sql);
            if($result === false){
                die(print_r(sqlsrv_errors(), true));
            }
            else{
                
            }

        }

        elseif(isset($_POST['home'])){

            $sql = "select * from Cars";   
        
            $result = sqlsrv_query($conn, $sql);
        
        
            
                    if($result === false){
                        die(print_r(sqlsrv_errors(), true));
                    }
            
                    else{?>
                        <html>
                            <body>
                        <a href = "Home.html">  </a>
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
            margin-bottom: 30px;
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