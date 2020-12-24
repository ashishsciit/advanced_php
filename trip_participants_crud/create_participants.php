<?php
    require_once("database.php");

    class ParticipantsAction extends Database{

        public function __construct(){
            parent::__construct();
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(!empty($_POST['name']) && !empty($_POST['email']) &&
                !empty($_POST['phone']) && !empty($_POST['gender']) 
                && !empty($_POST['age']) &&!empty($_POST['suggestion'])){
                $this->action($_POST['action']);
                }else{
                    $error_message = "All fields required";
                }
            }else if(isset($_GET['action'])){
                if($_GET['action'] == "edit"){
                $row = $this->read($_GET['id']);
                $this->fetch_values($row);
                }else if($_GET['action'] == "delete"){
                    $this->action($_GET['action']);
                }
            }
        
            // echo $this->test;
        }

        function action($action){
            if($action == "create"){
                $query = $this->insert();
                
            }else if($action == "edit"){
                
                $row = $this->read($_POST['participant_id']);
                $query = $this->update($_POST['participant_id'],$row);
            
            }else if($action == "delete") {
                $query = $this->delete($_GET['id']);
            }
            if($this->execute_query($query)){
                header("Location: index.php");
            }
            
        }

        function insert(){
            $query = "INSERT INTO `participants`(`id`, `name`, `email`, `phone`, `gender`, `age`,
            `suggestion`,`created_on`) VALUES(NULL, '".$_POST['name']."','".$_POST['email']."','"
            .$_POST['phone']."  ','".$_POST['gender']."','".$_POST['age']."','".$_POST['suggestion']."'
            ,CURRENT_TIMESTAMP)";
            return $query;
        }

        function update($participant_id, $row){
            $query = "UPDATE `participants` SET `id` = $participant_id";
            echo strcmp($row['name'], $_POST['name']);
                if(strcmp($row['name'], $_POST['name']) != 0){
                    $query .= ",`name` = '".$_POST['name']."'";
                }
                if(strcmp($row['email'], $_POST['email']) != 0){
                    $query .= ",`email` = '".$_POST['email']."'";
                }
                if(strcmp($row['phone'], $_POST['phone']) != 0){
                    $query .= ",`phone` = '".$_POST['phone']."'";
                }
                if(strcmp($row['gender'], $_POST['gender']) != 0){
                    $query .= ",`gender` = '".$_POST['gender']."'";
                }
                if(strcmp($row['age'], $_POST['age']) != 0){
                    $query .= ",`age` = '".$_POST['age']."'";
                }
                if(strcmp($row['suggestion'], $_POST['suggestion']) != 0){
                    $query .= ",`suggestion` = '".$_POST['suggestion']."'";
                }
                $query .= " WHERE id = " . $participant_id;
                
                return $query;
        }

        function read($participant_id){
            $row = array();
            $query = "SELECT * FROM `participants` WHERE id=" . $participant_id;
            $result = mysqli_query($this->conn, $query);
            if(mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
            }
            
            return $row;
    
        }
        function fetch_values($row){
            $_POST['name'] = $row['name'];
            $_POST['email'] = $row['email'];
            $_POST['phone'] = $row['phone'];
            $_POST['gender'] = $row['gender'];
            $_POST['age'] = $row['age'];
            $_POST['suggestion'] = $row['suggestion'];
        }
        function delete($participant_id) {
            $query = "DELETE FROM `participants` WHERE `id` = " . $participant_id;
            return $query;
        }

        function execute_query($query){
        
            $error_message = "";
            if(mysqli_query($this->conn, $query)){
                $success_message = "Participant ";
                if(isset($update_query)){
                    $success_message .= "Modified";
                }else{
                    $success_message .= "Created";
                }
                $success_message .= " Successfully!";
                $_POST = array();
            }else{ 
                $error_message = "Something went wrong. Please try again! due to ".mysqli_error($this->conn);
            }  
            if($error_message == ""){
                return 1;
                
            }else{
                return 0;
            }
        }
    

    }

    $participantsAction = new ParticipantsAction();
 
    
    
    
    
    
    


?>

<?php
require_once("header.php");
?>
    <div class="container">
    <hr>
    <div class="row">
    <div class="col d-flex justify-content-start"><h3>Create Participant</h3></div>
    <div class="col d-flex justify-content-end"><a href="index.php"><span class="oi oi-x"></a></span></div>
    </div>
    
    <hr>
    <form method="POST" action="create_participants.php">
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
            
            <div class="form-group col-md-6">
            <label for="inputGender">Gender</label>
            <select id="inputState" class="form-control" name="gender">
                <option selected>Choose...</option>
                <option value="male" <?= isset($_POST['gender']) && $_POST['gender'] == "male" ? "selected" : "" ?>>Male</option>
                <option value="female" <?= isset($_POST['gender']) && $_POST['gender'] == "female" ? "selected" : "" ?>>Female</option>
            </select>
            </div>
            <div class="form-group col-md-6">
                <label for="age">Age</label>
                <input type="text" class="form-control" id="age" placeholder="Age" name="age" value="<?= isset($_POST['age']) ? $_POST['age'] : "" ?>">
            </div>
        </div>
        
            <div class="form-group">
            <label for="inputSuggestion">Suggestion</label>
            <input type="text" class="form-control" id="inputSuggestion" name="suggestion" value="<?= isset($_POST['suggestion']) ? $_POST['suggestion'] : "" ?>">
            <input type="text" name="participant_id" value="<?=isset($_GET['id']) ? $_GET['id'] : ''?>" hidden>
            <input type="text" name="action" value="<?=isset($_GET['action']) ? $_GET['action'] : 'create'?>" hidden>
            </div>
        <div class="row">
        <button type="submit" class="btn btn-primary">Submit</button>
        <?= !empty($success_message) ? "<div class='alert alert-success'>$success_message</div>" : "" ?>
        <?= isset($error_message) ? "<div class='alert alert-danger'>$error_message</div>" : "" ?>
        </div>
        
        </form>
    </div>

<?php
require_once("footer.php");
?>