<?php

require_once('config/database.php');
include_once('header.php');
// INSERT INTO `personal_details` (`id`, `name`, `email`, `phone`, `gender`, `date_of_birth`, `date_of_join`, `date_of_leave`, `created_on`, `updated_on`) 
// VALUES (NULL, 'Ashish KS', 'ashish@localhost.com', '987654561', 'male', '1995-01-15', '2020-05-09', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

function insert(){
    global $conn;
    $query = "INSERT INTO `personal_details` (`id`, `name`, `email`, `phone`, `gender`, `date_of_birth`, `date_of_join`, `date_of_leave`, `created_on`, `updated_on`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
    // NULL, '{$_POST['name']}', '{$_POST["email"]}', '{$_POST["phone"]}', '{$_POST["gender"]}', '{$_POST["date_of_birth"]}', '{$_POST["date_of_join"]}', NULL,
    // CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
    // echo $query;
    // die;
    

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'isssssssss', $emp_id, $name, $email, $phone, $gender,
    $date_of_birth, $date_of_join, $date_of_leave, $created_on, $updated_on);
    $emp_id = NULL;
    $name = $_POST['name'];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $date_of_birth = $_POST["date_of_birth"];
    $date_of_join = $_POST["date_of_join"];
    $date_of_leave = NULL;
    $created_on = date('Y-m-d H:i:s', time());
    $updated_on = date('Y-m-d H:i:s', time());
    mysqli_stmt_execute($stmt);
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    if($affected_rows > 0){
        return $affected_rows;
        mysqli_stmt_close($stmt);
    }else{
        return 0;
    }
    
    
}
function read($employee_id){
    // echo $employee_id;
    global $conn;
    $query = "SELECT * FROM `personal_details` WHERE `id` = ?";
    // prepatre statement
    $stmt = mysqli_prepare($conn, $query);
    // bind parameters to statement
    mysqli_stmt_bind_param($stmt, "i", $emp_id);
    $emp_id = $employee_id;
    // echo $emp_id;
    // bind result variables to statement result
    mysqli_stmt_bind_result($stmt,$id, $name, $email, $phone, $gender, $date_of_birth, $date_of_join,
    $date_of_leave, $created_on, $updated_on);
    // statement execute
    mysqli_stmt_execute($stmt);
    // store result
    mysqli_stmt_store_result($stmt);
    // number of rows
    $num_rows = mysqli_stmt_num_rows($stmt);
    // fetch statements single row
    
    
    if($num_rows > 0){
        mysqli_stmt_fetch($stmt);
        $_POST['name'] = $name;
        $_POST['email'] = $email;
        $_POST['phone'] = $phone;
        $_POST['gender'] = $gender;
        $_POST['date_of_birth'] = $date_of_birth;
        $_POST['date_of_join'] = $date_of_join;
        isset($_POST['date_of_leave']) ? $_POST['date_of_leave'] = $date_of_leave : $_POST['date_of_leave'] = NULL;
   
    }else{
        global $error_message;

        $error_message = "Could not fetch values due to " . mysqli_error($conn);
    }
    // free memory aquired by result store
    mysqli_stmt_free_result($stmt); 
    // close $stmt statement
    mysqli_stmt_close($stmt);
}

function fetch_values($employee_id){
    
    $row = read($employee_id);
    
    if($row){
        $_POST['name'] = $row['name'];
        $_POST['email'] = $row['email'];
        $_POST['phone'] = $row['phone'];
        $_POST['gender'] = $row['gender'];
        $_POST['date_of_birth'] = $row['date_of_birth'];
        $_POST['date_of_join'] = $row['date_of_join'];
        isset($_POST['date_of_leave']) ? $_POST['date_of_leave'] = $row['date_of_leave'] : $_POST['date_of_leave'] = NULL;
    }

}

function update($employee_id){
    global $conn;
    // $row = read($employee_id);
// UPDATE `personal_details` SET `name` = 'Ashish Kumar S' WHERE `personal_details`.`id` = 1;
    $query = "UPDATE personal_details SET name = ?, email = ?, phone = ?, gender = ?, date_of_birth = ?, date_of_join = ?, date_of_leave = ?, updated_on = ? WHERE id = ?";
    
   
    $stmt = mysqli_prepare($conn, $query);
    if($stmt) {
    mysqli_stmt_bind_param($stmt,'ssssssssi', $name, $email, $phone, $gender, $date_of_birth, $date_of_join, $date_of_leave, $updated_on, $emp_id);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $date_of_join = $_POST['date_of_join'];
    $date_of_leave = isset($_POST['date_of_leave']) ? $_POST['date_of_leave'] : NULL;
    $updated_on = date('Y-m-d H:i:s', time());
    $emp_id = $_POST['employee_id'];
    mysqli_stmt_execute($stmt);
    echo mysqli_error($conn);
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    // print_r(myqli_stmt_($stmt));
    // echo $affected_rows;
    // die;
    if($affected_rows > 0) {
        return $affected_rows;
    }else{
        return 0;
    }
}
    mysqli_stmt_close($stmt);


}

function execute_query($query){
    global $conn;
    $result = $conn->query($query);
    return $result;
}
$success_message = "";
$error_message = "";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(!isset($_POST['action']) || $_POST['action'] == ""){
        // insert();
        // print_r($result);
        $affected_rows = insert();
        if($affected_rows > 0){
        $success_message = $affected_rows . "Employee Record Inserted Successfully!";
        // $conn->close();   
        header("Location: index.php");
        }else{
            echo "there is an error. ".mysqli_error($conn);
        }
    }else if(isset($_POST['action']) || $_POST['action'] == "edit"){
        $affected_rows = update($_POST['employee_id']);
        if($affected_rows){
            $success_message = $affected_rows . "Employee Record updated successfully!";
            
            header("Location: index.php");
        }
    }
    else{
        $error_message = "Employee not inserted due to ".$conn->error;
    }
}else if(isset($_GET['action']) && $_GET['action'] == "edit") {
    read($_GET['id']);
}

?>
    <div class="container">
    <hr>
    <div class="row">
    <div class="col d-flex justify-content-start"><h3>Create Employees</h3></div>
    <div class="col d-flex justify-content-end"><a href="index.php"><span class="oi oi-x"></a></span></div>
    </div>
    
    <hr>
    <form method="POST" action="employees.php">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" placeholder="Full Name" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : "" ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : "" ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPhone">Phone</label>
                <input type="text" class="form-control" id="inputPhone" placeholder="10 digit mobile number" name="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : "" ?>">
            </div>
        </div>
        
        <div class="form-row">
            
            <div class="form-group col-md-4">
            <label for="inputGender">Gender</label>
            <select id="inputState" class="form-control" name="gender">
                <option selected>Choose...</option>
                <option value="male" <?= isset($_POST['gender']) && $_POST['gender'] == "male" ? "selected" : "" ?>>Male</option>
                <option value="female" <?= isset($_POST['gender']) && $_POST['gender'] == "female" ? "selected" : "" ?>>Female</option>
            </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputDateOfBirth">Date of Birth</label>
                <div class="input-group shadow-sm">
                    <input type="text" class="form-control" id="inputDateOfBirth" placeholder="Date of Birth" name="date_of_birth" value="<?= isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : "" ?>">
                    <div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-clock-o"></i></span></div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputDateOfJoin">Date of Join</label>
                <div class="input-group shadow-sm">
                    <input type="text" class="form-control" id="inputDateOfJoin" placeholder="Date of Join" name="date_of_join" value="<?= isset($_POST['date_of_join']) ? $_POST['date_of_join'] : "" ?>">
                    <div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-clock-o"></i></span></div>
                </div>
            </div>
        </div>
        
            <div class="form-group">
            
            
            <input type="text" name="employee_id" value="<?=isset($_GET['id']) ? $_GET['id'] : ''?>" hidden>
            <input type="text" name="action" value="<?=isset($_GET['action']) ? $_GET['action'] : ''?>">
            
        <div class="row form-group">
        <button type="submit" class="btn btn-primary m-3">Submit</button>
        <?= !empty($success_message) ? "<div class='alert alert-success'>$success_message</div>" : "" ?>
        <?= !empty($error_message) ? "<div class='alert alert-danger'>$error_message</div>" : "" ?>
        </div>
        
        </form>
    </div>
<?php
include("footer.php");
?>