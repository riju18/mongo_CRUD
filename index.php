<?php
   require 'vendor/autoload.php';

   $sfirstname=$slastname=$susername=$spassword=$semail=$sid=$search="";

   $client = new MongoDB\Client();                     // mongo client;
   $db = $client->profile;                             // profile database is created;
   $collection = $db->information; // information collection is created;

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mongo CRUD</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style media="screen">
   *{ margin: 0; padding: 0; outline: 0; }
    #create{
      width: 500px;
      border-bottom: 1px solid black;
      margin: 20px auto;
      padding: 5px;
      padding-bottom: 20px;
    }
    #create input{
      margin-bottom: 5px;
      margin-left: 5px;
      border-radius: 5px;
      padding: 3px;
      border: 1.5px solid black;
    }
    #create input[type=submit]{
      cursor: pointer;
    }
    #create .output_msg{
      margin-left: 150px;
      color: blue;
      font-weight: bold;
      text-decoration: underline gray;
    }
    #read{
      width: 700px;
      margin: 20px auto;
      padding: 5px;
    }
    #read .show{
      width: 100%;
      margin: 0 auto;
    }
    #read .show tr td{
      border: 1px solid black;
      border-collapse: collapse;
      padding: 10px;
      text-align: center;
      margin: 50px auto;
    }
    #read input[type=submit]{
      cursor: pointer;
      color: blue;
      border: 1px solid black;
      padding: 1.5px;
      border-radius: 2px;
    }
  </style>
</head>
<body>
  <?php

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

      if ( isset ( $_POST['sub'] ) ) {         //insert operation
        $firstname = $_POST['fname'] ;
        $lastname = $_POST['lname'];
        $username = $_POST['uname'];
        $password = $_POST['pass'];
        $email = $_POST['mail'];

        $dataInsert = $collection->insertOne(
         ['firstname'=>$firstname,'lastname'=>$lastname,'username'=>$username,'password'=>$password,'email'=>$email]
          );
      }

      if ( isset ( $_POST['upd'] ) ){      //update operation
        $ufirstname = $_POST['fname'] ;
        $ulastname = $_POST['lname'];
        $uusername = $_POST['uname'];
        $upassword = $_POST['pass'];
        $uemail = $_POST['mail'];
        $uid = $_POST['idd'];

        $update = $collection->updateOne(
          [
            'username' => $uusername
          ],
          [
            '$set' => [ 'firstname' => $ufirstname, 'lastname' => $ulastname, 'username' => $uusername, 'password' => $upassword, 'email' => $uemail ]
          ]
        );
      }

      if ( isset ( $_POST['del'] ) ){      //delete operation
        $dusername = $_POST['uname'];

        $delete = $collection->deleteOne(
          [
            'username' => $dusername
          ]
        );
      }

      if ( isset ( $_POST['src'] ) ) {  //search operation
        $search = $_POST['sear'];
        $search = $collection->find(
          [
            '$or' => [ [ 'username' => $search ], [ '_id' => $search ] ]  //search by id or username
          ]
        );
        foreach ($search as $value) {
          $sfirstname = $value['firstname'];
          $slastname = $value['lastname'];
          $susername = $value['username'];
          $spassword = $value['password'];
          $semail = $value['email'];
          $sid = $value['_id'];
        }
      }
    }
   ?>
  <div id="create">
      <form class="" action="" method="post">

        <table>

          <tr>
            <td>FirstName: </td>
            <td><input type="text" name="fname" value="<?php echo $sfirstname; ?>"> </td>
          </tr>
          <tr>
            <td>Lastname: </td>
            <td><input type="text" name="lname" value="<?php echo $slastname; ?>"> </td>
          </tr>
          <tr>
            <td>Username: </td>
            <td><input type="text" name="uname" value="<?php echo $susername; ?>"> </td>
          </tr>
          <tr>
            <td>Password: </td>
            <td><input type="password" name="pass" value="<?php echo $spassword; ?>"> </td>
          </tr>
          <tr>
            <td>Email: </td>
            <td><input type="email" name="mail" value="<?php echo $semail; ?>"> </td>
          </tr>

          <tr>
            <td></td>
            <td><input type="hidden" name="idd" value="<?php echo $sid; ?>"> </td>
          </tr>

          <tr>
            <td></td>
            <td><input type="submit" name="sub" value="submit"> <input style="color:blue" type="submit" name="upd" value="update"> <input style="color:red" type="submit" name="del" value="delete"></td>
          </tr>

          <tr>
            <td></td>
            <td><input type="text" name="sear" placeholder="search by username or id" value=""> <input type="submit" name="src" value="search"></td>
          </tr>

         </table>
      </form>
  </div>
  <div id="read">
    <?php
      $read = $collection->find(   //read operaion
        [],
        [ 'projection' => [ '_id' => 0 ] ]
      );
      echo "<table class='show'>";
      echo "<tr style='font-weight:bold;font-family:verdana'>";
      echo "<td>firstname</td>";
      echo "<td>lastname</td>";
      echo "<td>username</td>";
      echo "<td>password</td>";
      echo "<td>email</td>";
      echo "</tr>";
      foreach ($read as $value) {
        echo "<tr>";
        echo "<td>".$value['firstname']."</td>";
        echo "<td>".$value['lastname']."</td>";
        echo "<td>".$value['username']."</td>";
        echo "<td>".$value['password']."</td>";
        echo "<td>".$value['email']."</td>";
        echo "</tr>";
      }
     ?>
  </div>
</body>
</html>
