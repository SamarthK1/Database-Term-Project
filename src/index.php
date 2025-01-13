<?php
require "db.php";
$con = get_connection();
?>

<!DOCTYPE html>
<html>

<head>
    <title>DB Term Project</title>
    <style>
        /* Format the body. */
        body {
            color: #000000;
            width: 750px;
            margin: 30px;
        }
        /* Format the tables. */
        table {
            width: 75%;
            border-collapse: collapse;
        }
        th, td {
            text-align: center;
            border: 1px solid black;
            padding: 10px;
        }
        tr {
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #ebebeb;
        }
    </style>
</head>

<body>
    <!-- Display the interface title and name. -->
    <div style="text-align: left; padding: 10px; border-bottom: solid gray">
        <h1 style="text-align: left; padding: 10px; border-bottom:solid gray"> Database Term Project</h1>
        <h2> Samarth Kumar (szk0187@auburn.edu) </h2>
    </div>
    
    <!-- Buttons to either display all tables or the query page. -->
    <div style="margin-top: 20px">
        <button onclick="window.location.href='index.php'">Print All Tables</button>
        <button onclick="window.location.href='query.php'">Execute Query</button>
    </div>

    <!-- Display every table of the database. -->
    <h2> All Tables </h2>
    <?php
    foreach($tables as $table) {  ?>
        <h3>Table: <?= $table ?></h3>
        <table>
            <tr><?php get_tables($con, $table); ?></tr>
        </table>
    <?php 
    } 
    ?>
</body>
</html>

<!-- Close the connection. -->
<?php
mysqli_close($con);
$con->close();
?>
