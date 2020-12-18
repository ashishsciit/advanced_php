<?php
require_once("config/database.php");
include_once("header.php");

// INSERT INTO `personal_details` (`id`, `name`, `email`, `phone`, `gender`, `date_of_birth`, `date_of_join`, `date_of_leave`, `created_on`, `updated_on`) 
// VALUES (NULL, 'Ashish KS', 'ashish@localhost.com', '987654561', 'male', '1995-01-15', '2020-05-09', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

// SELECT * FROM `personal_details`

// UPDATE `personal_details` SET `name` = 'Ashish Kumar S' WHERE `personal_details`.`id` = 1;
function read(){
    global $conn;
    $query = "SELECT id, name, phone, email FROM `personal_details`";
    // prepare statement
    $stmt = $conn->prepare($query);
    // bind result variables
    $stmt->bind_result($id, $name, $phone, $email);
    $stmt->execute();
    $row = array();
    $i = 0;
    while($stmt->fetch()){
      
      $row[$i]['id'] = $id;
      $row[$i]['name'] = $name;
      $row[$i]['email'] = $email;
      $row[$i]['phone'] = $phone;
      $i++;
    }
    // exit;
    // print_r($row);
    // die;
    
    return $row;
    
    // execute query
    
    // $stmt->store_result();
    // $result = $stmt->fetch();
    // $stmt->fetch();
    // echo $name;
    // die;

    
    
}



function delete($employeed_id){
  global $conn;
  $query = "DELETE FROM `personal_details` WHERE id = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'i', $employeed_id);
  mysqli_stmt_execute($stmt);
  $affected_rows = mysqli_stmt_affected_rows($stmt);
  if($affected_rows > 0){
    $success_message = $affected_rows . " Record Deleted Successfully!";
    header("Location: index.php");
  }else{
    $error_message = "Record not deleted due to ".$conn->error;
  }
}
$result = read();
// print_r($result);
if(isset($_GET['action']) && $_GET['action'] == "delete"){
  delete($_GET['id']);
}
$conn->close();

?>

<div class="container">
  <hr>
  <div class="row">
    <div class="col d-flex justify-content-start">
        <h3>Employees</h3>
    </div> 
    <div class="col d-flex justify-content-end">
        <a href="employees.php" class="btn btn-primary">Insert</a>
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
    // $result->store_result();
    
    if(count($result) > 0){
        $i=1;
        
        
        foreach($result  as $val) {
    ?>
    <tr>
      <th scope="row"><?=$i?></th>
      <td><?=$val['name']?></td>
      <td><?=$val['email']?></td>
      <td><?=$val['phone']?></td>
      
      <td>
      <a href="employees.php?action=edit&id=<?=$val['id']?>"><span class="oi oi-pencil btn btn-warning"></span></a>
      <a href="index.php?action=delete&id=<?=$val['id']?>"><span class="oi oi-trash btn btn-danger rounded" id="<?=$row['id']?>"></span></a>
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
  include_once("footer.php");
  ?>