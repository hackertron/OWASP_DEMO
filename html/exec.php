<?php
/**********************************************************************
 * exec() attack
 * 
 * To demonstrate the exploit, try the following:
 * wget -qO- http://localhost:8080/owasp/html/exec.php --post-data="cmd=whoami"
 * wget -qO- http://localhost:8080/owasp/html/exec.php --post-data="cmd=uname -a"
 *
 **********************************************************************/

// handle command requests
if (isset($_POST['cmd']))
    exec($_POST['cmd'], $output);
else
    $output=array();

?>
<html>
    <head>
        <title>exec() Attack</title>
    </head>
    <body>
        <p>Available commands:</p>
        <form method="POST" action="exec.php">
            <select name="cmd">
                <option value='date' selected='selected'>date</option>
                <option value='cal'>cal</option>
                <option value='ls'>ls</option>
            </select>
            <input type="submit" name="exec() it!" />
        </form>
        <hr />
        <p>Output of last command:</p>
        <pre>
<?php
foreach ($output as $line)
    print "$line\n";
?>
        </pre>
    </body>
</html>
