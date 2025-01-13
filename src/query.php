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
        /* Format the table. */
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
        /* Format the text area for SQL queries. */
        textarea {
            font-size: 20px; 
            font-family: consolas;  
            border: 1px solid; 
            width: 100%; height: 150px;
            padding: 10px
        }
    </style>
</head>

<body>
    <!-- Display the interface title and name.  -->
    <div style="text-align: left; padding: 10px; border-bottom: solid gray">
        <h1 style="text-align: left; padding: 10px; border-bottom:solid gray"> Database Term Project</h1>
        <h2> Samarth Kumar (szk0187@auburn.edu) </h2>
    </div>
    
    <!-- Buttons to display all tables or the query page. -->
    <div style="margin-top: 20px">
      <button onclick="location.href='index.php';">Print All Tables</button>
      <button onclick="location.href='query.php';">Execute Query</button>
    </div>

    <!-- List the names of each table in the database. -->
    <h2>Query Tables</h2>
    <h4><?php echo "Table Names: ", implode(", ", $tables); ?></h4>
    
    <!-- Display the text area for queries, as well as the submit and clear buttons. -->
    <div style="margin-top: 30px">
      <form method="POST" action="query.php">
          <textarea id="query" name="query"><?= stripcslashes($_POST["query"])?></textarea><br />
          <input type="submit"/> <button type="button" onclick="document.getElementById('query').value = ''";>Clear</button>
      </form>
    </div>

<!-- Handle the SQL Queries.  -->
<?php
  if (isset($_POST["query"])) 
  {
    $query = stripcslashes($_POST["query"]);
    $q = strtolower($query);

    // Do not allow drop statements.
    $forbidden = "drop";
    if(strpos($q, $forbidden) !== false) 
    {
      echo "<br> DROP statements are forbidden.";
      die();
    }
    
    // Store the query result.
    if ($query !== "") {
    $result = mysqli_query($con, $query);
    
    // Display error message for incorrect queries.
    if ($result == false) 
    {
      echo "<br>" . mysqli_error($con);
      die();
    }
    ?>

    <table >          
      <?php 
        // Display the resulting table. 
        get_query_result($con, $query, $result); 
        echo "<div class='success'>"; 

        // Print the number of rows retrieved for select statements, 
        // or messages indicating insert, create, update, and delete clauses.
        if (strpos(strtolower($query), "select") !== false) 
        {
          echo "Number of Rows Retrieved: " . mysqli_num_rows($result);
        }
        elseif (strpos(strtolower($query), "insert") !== false) 
        {
          echo "Row Inserted.";
        } 
        elseif (strpos(strtolower($query), "create") !== false) 
        {
          echo "Table Created.";
        } 
        elseif (strpos(strtolower($query), "update") !== false) 
        {
          echo "Table Updated.";
        } 
        elseif (strpos(strtolower($query), "delete") !== false) 
        {
          echo "Row(s) Deleted.";
        } 
      ?>        
    </table>
    <?php
    }
  }
?>
</div>
</body>
</html>

<!-- Close the connection.  -->
<?php 
mysqli_close($con);
$con->close();
?>