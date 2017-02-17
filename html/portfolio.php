<?php
/**********************************************************************
 * portfolio.php - For Cross-Site Request Forgery attack
 **********************************************************************/

// database connection 
$dsn = 'mysql:host=localhost;dbname=owasp';
$db_user = 'root';
$db_pass = '';
$dbh = new PDO($dsn, $db_user, $db_pass);

session_start();
$_SESSION['id']=1;

// function to display portfolio
function print_portfolio($dbh)
{
    print '<table border="1"><tr><th>Symbol</th><th>Shares</th></tr>';
    foreach ($dbh->query(sprintf("SELECT symbol, shares
                                  FROM portfolios
                                  WHERE id='%s'", $_SESSION['id'])) as $holding)
        print "<tr><td>{$holding[0]}</td><td>{$holding[1]}</td></tr>";
    print '</table>';
}

?>

<html>
    <head>
        <title>Portfolio (Cross-Site Request Forgery)</title>
    </head>
    <body>
        <p>Current portfolio:</p>
        <?php print_portfolio($dbh); ?>
    </body>
</html>
