<?php
/**********************************************************************
 * buy.php = For Cross-Site Request Forgery attack
 **********************************************************************/

// database connection 
$dsn = 'mysql:host=localhost;dbname=owasp';
$db_user = 'root';
$db_pass = ''; // enter password
$dbh = new PDO($dsn, $db_user, $db_pass);

session_start();
?>

<html>
    <head>
        <title>Cross-Site Request Forgery</title>
    </head>
    <body>
<?php
// handle database inserts
if (isset($_SESSION['id']) &&
    isset($_GET['symbol']) &&
    isset($_GET['shares']))
{
    $stmt = $dbh->prepare('INSERT INTO portfolios (id,symbol,shares)
                           VALUES (:id,:symbol,:shares)');
    $stmt->bindValue(':id',$_SESSION['id']);
    $stmt->bindValue(':symbol',$_GET['symbol']);
    $stmt->bindValue(':shares',$_GET['shares']);
    $stmt->execute();
    echo "<p>You just bought {$_GET['shares']} shares of {$_GET['symbol']}!</p>";
}
?>
    </body>
</html>
