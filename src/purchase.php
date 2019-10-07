<html>
<head><title>Order Confirmation</title></head>
<h2>Order Confirmation</h2>

<?php
#ARPAN SHARMA


    /* Userids 1,2 and 3 already exist in the customers table for database 'as1472', they can be used*/
    
    #defining variable and storing the values of all form elements from the insert.php file
    
    #id for records already present in database
    $curid=$_POST['curid'];
    #values of number of products ordered upon form submission
    $quantity1=$_POST['quantity1'];
    $quantity2=$_POST['quantity2'];
    $quantity3=$_POST['quantity3'];
    #id, name as well as zipcode fields if creating a new record in customers table
    $uid=$_POST['userid'];
    $name=$_POST['name'];
    $zip=$_POST['zip'];
    #ucwords() method in order to capitalize the first letter of the name entered
    $name=ucwords($name);
    #rand() method to create order numbers
    $orderid=rand();
    #to obtain local date dynamically in the format as reuired by column in orders table
    $today = date("Ymd");
    #to obtain local date time dynamically
    $dt = new DateTime();
    
    #to check that if both new user id feild or existing user id are empty then send back to insert.php
    if(empty($curid) && empty($uid)){
       header('Location: insert.php');
            }
    #server for connecting to db
$servername = "student-db.cse.unt.edu";
    #credentials such as username and password for database login
$username = "as1472";
$password = "as1472";
    #name of database
$data = "as1472";

// Create connection
$conn = new mysqli($servername, $username, $password, $data);

// Check connection
if ($conn->connect_error) {
    die("Something went wrong! please try again!");
}
    #identifying the product selection made
    $choice=$_POST['select'];
    switch($choice){
        case 1:if(empty($quantity1)){
            header ('Location: insert.php');
        }
            $prod="Computer";
            $quan = $quantity1;
            $price=20;
            $amnt = $price*$quan;
            break;
        case 2:if(empty($quantity2)){
            header ('Location: insert.php');
        }

            $prod="Phone";
            $quan=$quantity2;
            $price=10;
            $amnt = $price*$quan;
            break;
        case 3:if(empty($quantity3)){
            header ('Location: insert.php');
        }

            $prod="Ipad";
            $quan = $quantity3;
            $price=5;
            $amnt = $price*$quan;
            break;
    }
    #var for tax and amount computing
    $tax=0.0825*$amnt;
    $amnt=$amnt+$tax;
    $len=strlen($zip);
    /*if the existing accoutn field is empty that means user wants to create new customer record*/
    if(empty($curid) )
    { /*check for empty name field or zipcode numbers less than or greater than 5. if yes, send back to insert.php*/
        if(empty($name)||($len!=5)){
            header('Location: insert.php');
        }else{
            #sql query for insertion into customers table
           $sql = "Insert into customers values('$uid','$name','$zip')";
        if($conn->query($sql) == TRUE){
            echo " User registration successful! ";
            echo "<br><br>";
            #after user record insertion, insert values into order table.
            $sql1="Insert into orders values('$orderid','$uid','$amnt','$today')";
            if($conn->query($sql1) == TRUE){
                #Printing all the order information
                echo "Congratulations! Your order for &nbsp;";
                echo $quan;
                echo "&nbsp;";
                echo $prod;
                echo "(s)";
                echo "&nbsp; has been placed on &nbsp;";
                echo $dt->format('Y-m-d H:i:s');
                echo"<br><br>";
                echo "Your order no is&nbsp;";
                echo $orderid;
                echo "<br><br>";
                echo "Tax: $tax <br>";
                echo "Shipping and Handling: Free <br>";
                echo "Total: $amnt <br>";
                echo " Your current as well as previous order details are:";
                echo "<br><br>";
                #select query to obtain all the orders fo the customer using customerid
                $sql2 = "Select * from orders where customerid='$uid' ";
                $result = $conn->query($sql2);
                
                if ($result->num_rows > 0) {
                    #output data row wise
                    while($row = $result->fetch_assoc()) {
                        echo "OrderId: " . $row["orderid"]. " &nbsp;&nbsp; Your ID: " . $row["customerid"]. "&nbsp;&nbsp; Amount: $" . $row["amount(USD)"]. "&nbsp;&nbsp;Date:" . $row["date"] . "<br><br>";
                    }
                } else {
                    echo "No orders found";
                }
               
            } else{ # if insert into orders table fails
                echo "Failure";
            }
            
        } else{#if insert into customers fails
            echo "Please try again later!";
        }}}else{ /*if existing customerid textbox is not empty then using that id insert into orders table*/
           
            $sql1="Insert into orders values('$orderid','$curid','$amnt','$today')";
            if($conn->query($sql1) == TRUE){
                #Display all order info
                echo "Congratulations! Your order for &nbsp;";
                echo $quan;
                echo "&nbsp;";
                echo $prod;
                echo "(s)";
                echo "&nbsp; has been placed on ";
                echo $dt->format('Y-m-d H:i:s');
                echo"<br><br>";
                echo "Your order no is&nbsp;";
                echo $orderid;
                echo "<br><br>";
                echo "Tax: $tax <br>";
                echo "Shipping and Handling: Free <br>";
                echo "Total: $amnt <br>";
                echo " Your current as well as previous order details are:";
                echo "<br><br>";
                $sql2 = "Select * from orders where customerid='$curid' ";
                $result = $conn->query($sql2);
                
                if ($result->num_rows > 0) {
                    #output data row wise
                    while($row = $result->fetch_assoc()) {
                        echo "OrderId: " . $row["orderid"]. "&nbsp;&nbsp;Your ID: " . $row["customerid"]. " &nbsp;&nbsp;Amount: $" . $row["amount(USD)"]. "&nbsp;&nbsp;Date:" . $row["date"] . "<br><br>";
                    }
                } else {
                    echo "No orders found";
                }
                
            } else{
                echo "User not found. Please create a new ID";
            }
        }
    
    #closing connnection to database
    $conn->close();



?>

<body>
<br>
<a href="insert.php"><input type="submit" value="Back"></a>
</body>
</html>


