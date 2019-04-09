<?php
include_once("database.php");
$response = "";
$action = '';
if (isset($_POST['action']))
{
$action = $_POST['action'];

}
else
{
$action = $_GET['action'];
}
if ($action == "fetch_states")
{
    echo "<option>Select State</option>";
    $get = mysqli_query($db, "select * from states order by state asc");
    while ($row = mysqli_fetch_array($get))
    {
        $state = $row['state'];

        echo "<option value='$state'>$state</option>";
    }

}


if ($action == "fetch_lga")
{
    echo "<option>Select Local Government</option>";
    $state = $_POST['state'];
    $get = mysqli_query($db, "select * from lga where state='$state' order by lg asc");
    while ($row = mysqli_fetch_array($get))
    {
     $lg = $row['lg'];
     $id = $row['id']; 
   
        
        $id = $row['id'];
        echo "<option value='$id'>$lg</option>";
    }

}


if ($action == "register")
{
     $name = $_POST['name'];
     $email = $_POST['email'];
     $gsm = $_POST['gsm'];

     $password = $_POST['password']; 
     $cpassword = $_POST['cpassword']; 
     
     $type = $_POST['user_type'];

     $sub_type = NULL;
     $state = NULL;
     $lga = NULL;
     $address = NULL;
     
     
     if ($password == $cpassword)
     {
         $password = md5($password);
     if ($type == "hospital")
     {
         $sub_type = $_POST['hospital_type'];
         
     }
     
     $state = $_POST['state'];
     $lga = $_POST['lga'];
     $address = mysqli_real_escape_string($db, $_POST['address']);
    
     
    
    
    
     $admin_message = "A new User has registered,<br> Name: $name, Type: $type, Location: $state, $lga, $address";
     $user_message = "Welcome to OpenMedic.<br> Thank You For Registering. ";
     $admin_mail = "admin@openmedic.ng";
    
     $subject = "OpenMedic Notification";
    
   
   
     $query = "insert into user (name, email, gsm, state, lga, address, password, type, sub_type) ";
     $query .= " values ('$name', '$email', '$gsm', '$state', '$lga', '$address', '$password', '$type', '$sub_type')";
     $insert = mysqli_query($db,$query);
     if ($insert)
     {
        email($email, $user_message, $subject);
        email($admin_mail, $admin_message, $subject);
        $response = "success";
     }
     else
     {
        $response = "Email of Phone Number already Registered, Please Try Again";
     }

     }
     else
     {
         $response = "Passwords dont match";
     }
    echo $response;     
}


function email($to, $message,$subject){
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: Amplify <info@openmedic.ng>" . "\r\n";
	$body = "<html>
    <hr>
                <p>$message</p>
				<br>
                <br>
                <p>If you did not register on our website, please ignore this email.</p>
    
    <br>
    <hr>
    
    For Help and more info contact us at <a href='http://openmedic.ng'>Amplify</a><br>
    Mail us at <a href='mailto:info@openmedic.ng'>info@openmedic.ng</a>
    </html>";
    @$send_mail = mail($to, $subject, $body, $headers);
}

if ($action == "upload")
{
    if (!isset($_SESSION))
    {
        session_start();
    }
    $user = $_SESSION['user'];
    
    $upload_type = $_POST['upload_type'];
    if ($upload_type == "reg")
    {
        if (isset($_POST['drug_name']) && isset($_POST['drug_desc']) && isset($_POST['pre']) && isset($_POST['status']) && isset($_POST['qty']) )
        {
        $name = $_POST['drug_name'];
        $desc = mysqli_real_escape_string($db, $_POST['drug_desc']);
        $pre = $_POST['pre'];
        $status = $_POST['status'];
        $qty = $_POST['qty'];
        $insert = mysqli_query($db, "insert into drugs (drug_name, drug_desc, presc, status, qty, user) values ('$name','$desc','$pre','$status', '$qty','$user')");
        if ($insert)
        {
            $response = "success";
        }
        else
        {
            $response = "Error, Please Try Again";
        }
        } 
        else
        {
            $response = "Fill all details Please";
        }
       

        
    }
    else
    {


if (!empty($_FILES["upload_file"]))
{
    $file_array = explode(".", $_FILES["upload_file"]["name"]);
    if ($file_array[1] == "xlsx")
        {
            include_once("PHPExcel/IOFactory.php");
            include_once('PHPExcel/PHPExcel.php');
            $run = '';
            $object = PHPExcel_IOFactory::load($_FILES["upload_file"]["tmp_name"]);
            foreach($object->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                for ($row=2; $row<=$highestRow; $row++)
                {
                    $name = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(0,$row)->getValue());
                    $desc = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(1,$row)->getValue());
                    $pre = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(2,$row)->getValue());
                    $qty = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(3,$row)->getValue());
                    $status = mysqli_real_escape_string($db, $worksheet->getCellByColumnAndRow(4,$row)->getValue());
                    
                    $insert = mysqli_query($db, "insert into drugs (drug_name, drug_desc, presc,  qty, status, user) values ('$name','$desc','$pre','$qty', '$status', '$user')");
    

                }
                
              
            }
              if ($insert)
                {
                $response = "success";
                }
                else
                {
                $response = "Error, Please Try Again";
                }


        }
        else
        {
            $response =  'Invalid file';
        }
              //echo $response;
      
}










    }
         echo $response;

}

if ($action == "login")
{

$email  = $_POST['email'];
$password = md5($_POST['password']);

$check =  mysqli_query($db, "select * from user where email='$email' and password='$password'");

$count = mysqli_num_rows($check);
if ($count == 1)
{
$get = mysqli_fetch_array($check);
$type = $get['type'];
    if (!isset($_SESSION))
    {
        session_start();
    }
if ($type !="user")
{
    $_SESSION['data'] = true;
}

    $_SESSION['user'] = $email;
    $response = "success";
}
else
{
    $response = "Incorrect Details";
}

echo $response;
}


if ($action == "fetch")
{
$output = array();
         if (!isset($_SESSION))
    {
        session_start();
    }

$email = $_SESSION['user'];
$query = "select * from drugs where user='$email' order by id desc";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0)
{
  $i = 1;
    while($row = mysqli_fetch_array($result))
    {
        $qty = $row['qty'];
        $id = $row['id'];

        $result2 = array();
        $result2[] = $i; 
        $result2[] = $row['drug_name'];
        $result2[] = $qty;
        //$result2[] = "<button type='button' class='btn btn-primary update' id='".$row['id']."'>Update</button>";
        $result2[] = "<button type='button' class='btn btn-info viewer' id='".$row['id']."'>Edit</button>";
        $output[] = $result2;
   $i++; }
    echo json_encode($output);

}
}

if ($action == "update")
{
    $id = $_POST['id'];
    $qty = $_POST['qty'];

    $up = mysqli_query($db, "update drugs set qty='$qty' where id='$id'");
    if ($up)
    {
        $response = "success";
    }
    else
    {
        $response = "Error, Try Again";
    }
echo $response;
}

if ($action =="fetch_single")
{
    $id = $_POST['id'];
    $response = array();
    $send = mysqli_query($db, "select * from drugs where id='$id'");
    $row = mysqli_fetch_array($send);
    if ($row)
    {
        $response['name'] = $row['drug_name'];
        $response['desc'] = $row['drug_desc'];
        $response['pre'] = $row['presc'];
        $response['status'] = $row['status'];
        $response['qty'] = $row['qty'];
        
    }
    else
    {
        $response['error'] = "Not found";
    }
    echo json_encode($response);
   }

   if($action == "update_")
   {
        if (isset($_POST['drug_name']) && isset($_POST['drug_desc']) && isset($_POST['pre']) && isset($_POST['status']) && isset($_POST['qty']) )
        {
        
        $id = $_POST['id_'];
        $name = $_POST['drug_name'];
        $desc = mysqli_real_escape_string($db, $_POST['drug_desc']);
        $pre = $_POST['pre'];
        $status = $_POST['status'];
        $qty = $_POST['qty'];
        
        $up = mysqli_query($db, "update drugs set drug_name='$name', drug_desc='$desc', presc='$pre', status='$status', qty='$qty' where id='$id'");
        if ($up)
        {
            $response = "success";
        }
        else
        {
            $response = "Error, Try Again";
        }
        
        }
        else
        {
            $response = "Fill all details Please";
        }
        echo $response;
   }

   if ($action == "search")
   {
    $name = $_POST['product_name'];
    $state = $_POST['state_'];
    $lga = $_POST['lga_'];

    $get = mysqli_query($db, "select * from drugs where drug_name like '%$name%'"); 
    $count = mysqli_num_rows($get);
    if ($count != 0)
    {
        $i = 1;
        $response = 
        "
        <table class='table'>
        <tr>
        <th>#</th>
        <th>Drug</th>
        <th>By</th>
        <th>Address</th>
        <th>View</th>
        <th>Request</th>
        </tr>
        ";    
        while($row = mysqli_fetch_array($get))
        {
        $email = $row['user'];
        $drug_name = $row['drug_name'];
             
        $get2 = mysqli_query($db, "select * from user where email='$email'");
        while($row2 = mysqli_fetch_array($get2))
            {
              $state2 = $row2['state'];
              $lga2 = $row2['lga'];
              $address = $row2['address'];
            $name = $row2['name'];
              
              if ($state2 == $state && $lga == $lga2)
              {
              $response .= 
              "
              <tr>
              <td>$i</td>
              <td>$drug_name</td>
              <td>$name</td>
              <td>$address</td>
              <td><button type='button' class='btn btn-primary view_drug' id='".$row['id']."'>View</button></td>
              <td><button type='button' class='btn btn-info request' id='".$row['id']."'>Request</button></td>
              
              </tr>
              ";
              }elseif ($state2 == $state && $lga != $lga2)
              {
                $response .= 
                "
              <tr>
              <td>$i</td>
              <td>$drug_name</td>
              <td>$name</td>
              <td>$address</td>
              <td><button type='button' class='btn btn-primary view_drug' id='".$row['id']."'>View</button></td>
              <td><button type='button' class='btn btn-info request' id='".$row['id']."'>Request</button></td>
              
              </tr>
             
                ";
              }
              else
              {
                  $response = "<h3 class='text-center'>Not result found</h3>";
              }   
            }

        }
    }
    else
    {
        $response = "<h3 class='text-center'>No result found!</h3>";
    }

    echo $response;
   }

   if ($action == "fetch_drug")
   {
   $response = array();
    $id = $_POST['id'];
    $get = mysqli_query($db, "select * from drugs where id='$id'");
    $row = mysqli_fetch_array($get);
    $response['drug_name'] = $row['drug_name'];
    $response['drug_desc'] = $row['drug_desc'];
    $response['presc'] = $row['presc'];
    $response['qty'] = $row['qty'];
    $response['status'] = $row['status'];
    
    $email = $row['user'];

    $get2 = mysqli_query($db, "select * from user where email='$email'");
    $row2 = mysqli_fetch_array($get2);
    $response['name'] = $row2['name'];
    $response['email'] = $row2['email'];
    $response['gsm'] = $row2['gsm'];
    $response['address'] = $row2['address'];
    
    $t = $row2['sub_type']." ".$row2['type'];
    $response['type'] = trim($t);

    echo json_encode($response);
   }
?>