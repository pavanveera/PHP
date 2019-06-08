<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" />
    <style type="text/css">
        .table-nonfluid {
            width: auto !important;
        }
    </style>
</head>
<body>
    <center>
        <h1>Race Names and Distances</h1>
        <?php
            require_once("config.php"); // Database Access

            echo "<table class='table table-bordered table-nonfluid'>"; // Bootstrap CSS class to style the table
                echo "<tr><th>Name</th><th>Distance</th></tr>";

            // Class for generating Table rows
            class TableRows extends RecursiveIteratorIterator { 
                function __construct($it) { 
                    parent::__construct($it, self::LEAVES_ONLY); 
                }

                function current() {
                    return "<td>" . parent::current(). "</td>";
                }

                function beginChildren() { 
                    echo "<tr>"; 
                } 

                function endChildren() { 
                    echo "</tr>" . "\n";
                } 
            } 
         

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT name, distance FROM race"); 
                $stmt->execute();

               // Setting the result of the array to associative array
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

                foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                    echo $v;
                }
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            $conn = null;
            echo "</table>";
        ?> 
    </center>
</body>
</html>