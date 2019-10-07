<?php #ARPAN SHARMA
#UNT ID: 11252527
#CSCE 5350 ASSIGNMENT 1

#The form
    ?>
 <html>
<body><form action="purchase.php" method="post">
<h1> Product Catalog</h1>
<?php #table consisting of products and its attributes ?>
<table>
<tr><td>Product</td>
<td>Description</td>
<td>Quantity</td>
<td>Price</td>
<td>Make a selection</td>
</tr>
<tr><td>Product 1</td>
<td>This product is for computers</td>
<td><input type="number" min="0" name="quantity1"></td>
<td>$20</td>
<td><input type="radio" name="select" value="1"></td>
</tr>
<tr><td>Product 2</td>
<td>This product is for phones</td>
<td><input type="number" min="0" name="quantity2"></td>
<td>$10</td>
<td><input type="radio" name="select" value="2"></td>
</tr>
<tr><td>Product 3</td>
<td>This product is for ipads</td>
<td><input type="number" min="0" name="quantity3"></td>
<td>$5</td>
<td><input type="radio" name="select" value="3"></td>
</tr>

</table><br><br>
<?php #Textbox to enter id if user record is already present in the database ?>
<h4>Enter one of the following details:</h4><br>
Enter userid for existing customer:<input type="text" name="curid">
<?php # Details to enter in order to create a new customer by populating the customers table ?>
<h3>Enter information for new customer:</h3>
UserId:<input type="text" name="userid"><br><br>
Name:<input type="name" name = "name">
<br><br>
Zipcode:<input type="text" name="zip"><Br><br>
<input type="submit" value="Purchase">
</form>
</body></html>

