<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
$con=mysqli_connect("localhost","root","","db_test");
if(!$con)
{
    die(mysqli_error($con));
}
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['sub1']))
    {
        if(!empty($_POST['name'])&&!empty($_POST['email'])&&!empty($_POST['password']))
        {
            $name=$_POST['name'];
            $email=$_POST["email"];
            $password=$_POST["password"];
        }
    }
    if(isset($_POST['sub2']))
    {
        if(!empty($_POST['name'])&&!empty($_POST['upemail']))
        {
            $name=$_POST['name'];
            $upemail=$_POST['upemail'];
        }
    }
    if(isset($_POST['sub3']))
    {
        if(!empty($_POST['email'])&&!empty($_POST['uppass']))
        {
            $email=$_POST["email"];
            $uppassword=$_POST['uppass'];
        }   
    }
}
$sql="CREATE TABLE `register` ( `name` VARCHAR(20) NOT NULL , `email` VARCHAR(20) NOT NULL , `password` VARCHAR(20) NOT NULL , PRIMARY KEY (`email`))";
$createtable=mysqli_query($con,$sql);
if(!$createtable)
{
    echo mysqli_error($con)."<br>";
}

if(isset($_POST['sub1']))
{
    if(!empty($_POST['name'])&&!empty($_POST['email'])&&!empty($_POST['password']))
    {
        $sql="INSERT INTO `register` (`name`,`email`, `password`) VALUES ('$name','$email', '$password');";
        $result=mysqli_query($con,$sql);
        if($result)
        {
            echo"success<br>";
        }
        else
        {
            echo "user already exist<br>";
        }
        $_POST = array();
    }
}
// else
// {
//     echo"Please Enter UserName And Password<br>";
// }
if(isset($_POST['sub2']))
{
    if(!empty($_POST['name'])&&!empty($_POST['upemail']))
    {
        $sql="UPDATE `register` SET `email` = '$upemail' WHERE `name` = '$name';";
        $result=mysqli_query($con,$sql);
        if(mysqli_affected_rows($con))
        {
            echo"Username Updated To $upemail<br>";
        }
        else
        {
            echo"Something went wrong<br>";
        }
        $_POST = array();
    }

}
// else
// {
//     echo "please enter Updated Email <br>";
// }
if(isset($_POST['sub3']))
{
    if(!empty($_POST['email'])&&!empty($_POST['uppass']))
    {
    $sql="UPDATE `register` SET `password` = '$uppassword' WHERE `email` = '$email';";
    $result=mysqli_query($con,$sql);
    if(mysqli_affected_rows($con))
    {
        echo"Password Updated<br>";
    }
    else
    {
        echo"Something went wrong<br>";
    }
    $_POST = array();
    }   
}
// else
// {
//     echo"Please Enter Updated Password<br>";
// }
echo var_dump($_POST);
?>
<body>
    <form action="system.php" method="post">
        Name <input type="text" name="name"><br>
        Email<input type="email" name="email"><br>
        Password<input type="password" name="password"><br>
        <button type="submit" name="sub1">Submit</button>
        </form>
        <br>
        <form action="system.php" method="post">
            Name <input type="text" name="name" id=""><br>
            Updated Email<input type="email" name="upemail" ><br>
            <button type="submit" name="sub2">Submit</button>
        </form>
        <form action="system.php" method="post">
        Email <input type="email" name="email" id=""><br>
        Updated Password <input type="password" name="uppass" ><br>
        <button type="submit" name="sub3">Submit</button>
        </form>
    
</body>
</html>