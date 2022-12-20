<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "course";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
;
//taking value from the html input element
$a = $_GET['pageNumber'] - 1;
$num_per_page = 20;
$start_from = $a * $num_per_page;

$query = "select * from student limit $start_from , $num_per_page";
$result = mysqli_query($conn, $query);
//number of records and pages we have
$cons = new mysqli($servername, $username, $password, $dbname);
$querys = "select * from student";
$results = mysqli_query($cons, $querys);
$total_records = mysqli_num_rows($results);
$total_pages = ceil($total_records / $num_per_page);

$conn->close();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        th{
            padding : 5px 10px;
        }
        td{
            text-align: center;
        }
        a{
            padding:5px;
            border: 1px solid black;
            text-decoration: none;
        }
        table{
            margin-bottom: 100px;
        }

    </style>
</head>
<body>
    <table align="center" border='1px'>
        <tr>
            <th>student id</th><th>student full name</th><th>mother name</th><th>gender</th><th>age</th><th>study year</th><th>email</th><th>address</th><th>phone number</th>
        </tr>
        <?php
        while ($row=mysqli_fetch_array($result)){?>
        <tr>
            <td><?php echo $row['student_id'] ?></td>
            <td><?php echo "".$row["first_name"]." ".$row["last_name"]." ".$row["father_name"].""  ?></td>
            <td><?php echo $row['mother_name'] ?></td>
            <td><?php if($row['gender'] == 0){echo "Male";}else{echo "Female";} ?></td>
            <td><?php echo $row['age'] ?></td>
            <td><?php echo $row['study_year'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['address'] ?></td>
            <td><?php echo $row['phone__number'] ?></td>
        </tr>
        <?php 
        }?>

    </table>
    <form method="GET">
    <label>page Number</label>
    <input type="number" name="pageNumber" id="pageNumber">
    <button type="submit" name="submit">nav</button>
    <label for="">from <?php echo $total_pages ?></label>
    </form>

</body>

</html>
