<?php
include 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<button class="btn btn-primary my-5"><a href="user.php" class="text-light">Add user</a>
<button style="margin-left:10px;" class="btn btn-primary my-5; margin-left:30"><a href="createpdf.php" class="text-light">Make PDF</a>
</button>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Sl no</th>
      <th scope="col">Name</th>
      <th scope="col">Contact</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>

  <?php
    $sql = "SELECT * FROM `user_accounts`";
    $result = mysqli_query($con, $sql);
    
    if (!$result) {
        // Query failed
        die("Query failed: " . mysqli_error($con));
    }
    
    // Check if there are rows returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch and display data for each row
        while ($row = mysqli_fetch_assoc($result)) {
            $id=$row['ID'];
            $name=$row['Name'];
            $contact=$row['Contact'];
            $email=$row['Email'];
            $passsword=$row['Password'];

            echo'<tr>
            <th scope="row">'.$id.'</th>
            <td>'.$name.'</td>
            <td>'.$contact.'</td>
            <td>'.$email.'</td>
            <td>'.$passsword.'</td>
            <td>
            <button class="btn btn-primary"><a href="update.php?updateid='.$id.'"class="text-light">Update</a></button>
            <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'"class="text-light">Delete</a></button>
            </td>
          </tr>';
            
            // Output other columns as needed
        }
    } else {
        // No r
        echo "No rows found";
    }
  ?>
   
  </tbody>
</table>
</div>

</body>
</html>