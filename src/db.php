<?php
// Database Credentials: $dbhost, $dbuser, $dbpass, and $dbname are not provided here.

// Table Names
$tables = array("db_book", "db_customer", "db_employee", "db_order_detail", 
"db_order", "db_shipper", "db_subject", "db_supplier");

// Connect to the Database using the credentials.
function get_connection() 
{
    global $dbhost, $dbuser, $dbpass, $dbname;
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Report the error if the connection fails.
    if ($connection->connect_error) 
    {
        die("Could not connect: " . $connection->connect_error);
    }

    return $connection;
}

// Print all the tables from the database.
function get_tables($connection, $tables) 
{
    // Use the SQL query to get the table names.
    $query = "SELECT * FROM $tables";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    // Print the table headers.
    foreach($row as $key => $value) 
    {
        echo "<th>$key</th>";
    }

    // Print the table rows.
    while($row) 
    {
        echo "<tr>";
        foreach($row as $key => $value) 
        {
            echo "<td> $value</td>";
        }
        echo "</tr>";
        $row = mysqli_fetch_assoc($result);
    }
}

// Get the resulting table from the query, as long as forbidden queries are not used.
function get_query_result($connection, $query, $result) 
{
    $numFields = mysqli_num_fields($result);

    // Print the table headers.
    echo "<tr>";
    for($i = 0; $i < $numFields; $i++) 
    {
      $field = mysqli_fetch_field_direct($result, $i);
      echo "<th>" . $field->name . "</th>";
    }
    echo "</tr>";

    // Print the table rows.
    $rows = array();
    while($resultRow = mysqli_fetch_assoc($result)) 
    {
        $rows[] = $resultRow;
    }
    
    foreach($rows as $row) 
    {
        echo "<tr>";
        foreach($row as $col) 
        {
            echo "<td>" . $col . "</td>";
        }
        echo "</tr>";
    }
}

?>