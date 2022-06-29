<?php

session_start();
if(!$_SESSION['code'])
{
    echo "illegal access";
}

$value = $_SESSION['code'];

if($value == $_POST['co'] )
{
    //......
}




?>

<!DOCTYPE html>
<html>

<head>
    <title>auth</title>
</head>

<body>
    <form name="form2" method="POST" >
        <input type="text" name="co">
        <button>submit</button>




    </form>
</body>


</html>