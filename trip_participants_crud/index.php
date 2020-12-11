<?php
require_once("database.php");
$query = "SELECT * FROM participants";
$result = mysqli_query($conn, $query);  // run sql query
?>
<?php require_once("header.php"); ?>
<div class="container">
  <hr>
  <div class="row">
    <div class="col d-flex justify-content-start">
        <h3>Trip participants</h3>
    </div> 
    <div class="col d-flex justify-content-end">
        <a href="create_participants.php" class="btn btn-primary">Insert</a>
    </div>                         
  </div>
  <hr>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(mysqli_num_rows($result) > 0) {
        // echo "Query run successfully!";
        // print_r($result);
        // echo mysqli_num_rows($result); // return number of rows from query result
        // $row = mysqli_fetch_assoc($result); // return rows in associtive array form of query result
        $i=1;
        while($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
      <th scope="row"><?=$i?></th>
      <td><?=$row['name']?></td>
      <td><?=$row['email']?></td>
      <td><?=$row['phone']?></td>
      
      <td>
      <a href="create_participants.php?action=edit&id=<?=$row['id']?>"><span class="oi oi-pencil btn btn-warning"></span></a>
      <a href="create_participants.php?action=delete&id=<?=$row['id']?>"><span class="oi oi-trash btn btn-danger rounded" id="<?=$row['id']?>"></span></a>
      </td>
    </tr>
    <?php
    $i++;
        }
    }else{
    ?>
    <td colspan="4">No records found!</td>
    <?php } ?>
  </tbody>
</table>

  </div>
<?php
require_once("footer.php");
?>