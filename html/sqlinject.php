<!DOCTYPE html>
<html>
<head>
	<title>OWASP DEMO</title>
	
	<script src="//fast.eager.io/E2AE4lvdR0.js"></script>
</head>
<body>



<?php
/**********************************************************************
 * SQL Injection attack
 * 
 * To demonstrate the exploit, try the following URL's:
 *
 * Fail:    http://localhost:8080/owasp/html/sqlinject.php?user=chris&password=badpwd
 * Success: http://localhost:8080/owasp/html/sqlinject.php?user=chris&password=password
 * Exploit: http://localhost:8080/owasp/html/sqlinject.php?user=chris&password='OR''='
 * Exploit: http://localhost:8080/owasp/html/sqlinject.php?user=';DROP TABLE test;
 **********************************************************************/
 
// database connection
$dsn = 'mysql:host=localhost;dbname=owasp';
$db_user = 'root';
$db_password = 'kamehameha';
$dbh = new PDO($dsn, $db_user, $db_password);

// login credentials
$user = isset($_GET['user']) ? $_GET['user'] : '';
$password = isset($_GET['password']) ? $_GET['password'] : '';

// database query to test login credentials
$sql = sprintf("SELECT 1
                FROM users
                WHERE id='%s'
                AND pwd='%s'", $user, $password);

// authenticate user
$success = false;
foreach($dbh->query($sql) as $row)
{
    // if any rows returned, we logged in
    $success = true;
}

// print results
if ($success)
    echo "Successful login!\n";
else
    echo "Bad username or password\n";
?>
</body>
</html>
