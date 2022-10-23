<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
// Include config file
require_once "config.php";

$or_no = $family_name = $first_name = $middle_name = $husband_surname =
$address = $date_of_birth = $place_of_birth = $civil_status = $purpose =
$gender = $dst_paid = ""; 
$or_no_err = $family_name_err = $first_name_err = $middle_name_err = $husband_surname_err = $address_err = $date_of_birth_err = $place_of_birth_err =  $civil_status_err = $purpose_err = $gender_err = $dst_paid_err = "";

session_start();
$id = $_SESSION["id"];
$username = $_SESSION["username"];
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate Receipt
    $input_or_no = trim($_POST["or_no"]);
    if(empty($input_or_no)){
        $or_no_err = "Required.";
    } elseif(strlen($input_or_no)!=10){
        $or_no_err = "OR number must be 10 characters";
    } else{
        $or_no = $input_or_no;
    }

    $input_family_name = trim($_POST["family_name"]);
    if(empty($input_family_name)){
        $family_name_err = "Required.";
    } elseif(!filter_var($input_family_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $family_name_err = "Please enter a valid Family Name.";
    } else{
        $family_name = $input_family_name;
    }

    $input_first_name = trim($_POST["first_name"]);
    if(empty($input_first_name)){
        $first_name_err = "Required.";
    } elseif(!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $first_name_err = "Please enter a valid First Name.";
    } else{
        $first_name = $input_first_name;
    }

    $input_middle_name = trim($_POST["middle_name"]);
    if(empty($input_middle_name)){
        $middle_name_err = "Required.";
    } elseif(!filter_var($input_middle_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $middle_name_err = "Please enter a valid Middle Name.";
    } else{
        $middle_name = $input_middle_name;
    }

    $input_husband_surname = trim($_POST["husband_surname"]);
    if(empty($input_husband_surname)){
        $husband_surname_err = $input_husband_surname;
    } else{
        $husband_surname = $input_husband_surname;
    }

    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Required.";
    } else{
        $address = $input_address;
    }

    $input_date_of_birth = trim($_POST["date_of_birth"]);
    if(empty($input_date_of_birth)){
        $date_of_birth_err = "Required.";
    } else{
        $date_of_birth = $input_date_of_birth;
    }

    $input_place_of_birth = trim($_POST["place_of_birth"]);
    if(empty($input_place_of_birth)){
        $place_of_birth_err = "Required.";
    } else{
        $place_of_birth = $input_place_of_birth;
    }

    $input_civil_status = trim($_POST["civil_status"]);
    if(empty($input_civil_status)){
        $civil_status_err = "Statuses are: Single, Widowed, Married, Divorced.";
    } else{
        $civil_status = $input_civil_status;
    }

    $input_purpose = trim($_POST["purpose"]);
    if(empty($input_purpose)){
        $purpose_err = "Purposes are: Renewal, Multi-purpose.";
    } else{
        $purpose = $input_purpose;
    }

    $input_gender = trim($_POST["gender"]);
    if(empty($input_gender)){
        $gender_err = "Genders are: Male, Female.";
    } else{
        $gender = $input_gender;
    }

    $input_dst_paid = trim($_POST["dst_paid"]);
    if(empty($input_dst_paid)){
        $dst_paid_err = "Paid or Not Paid";
    } else{
        $dst_paid = $input_dst_paid;
    }

    if(empty($or_no_err) && empty($family_name_err) && empty($first_name_err) && empty($middle_name_err) || empty($husband_surname_err) && empty($address_err) && empty($date_of_birth_err) && empty($place_of_birth_err) && empty($civil_status_err) && empty($purpose_err) && empty($$gender_err) && empty($dst_paid_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO receipt(id,username,or_no,family_name,first_name,middle_name,husband_surname,address,date_of_birth,place_of_birth,civil_status,purpose,gender,dst_paid) VALUES (?, ?,?, ?,?,?,?,?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isssssssssssss", $param_id, $param_username, $param_or_no, $param_family_name, $param_first_name, $param_middle_name, $param_husband_surname, $param_address, $param_date_of_birth,$param_place_of_birth,$param_civil_status,$param_purpose,$param_gender,$param_dst_paid);
            
            // Set parameters
            $param_id = $id; 
            $param_username = $username;
            $param_or_no = $or_no;
            $param_family_name = $family_name;
            $param_first_name = $first_name;
            $param_middle_name = $middle_name;
            $param_husband_surname = $husband_surname;
            $param_address = $address;
            $param_date_of_birth = $date_of_birth;
            $param_place_of_birth = $place_of_birth;
            $param_civil_status = $civil_status;
            $param_purpose = $purpose;
            $param_gender = $gender;
            $param_dst_paid = $dst_paid;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: welcome.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add new application</h2>
                    </div>
                    <p>Please fill this form to update your personal details.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($or_no_err)) ? 'has-error' : ''; ?>">
                            <label>OR Number</label>
                            <input type="text" name="or_no" class="form-control" value="<?php echo $or_no; ?>">
                            <span class="help-block"><?php echo $or_no_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($family_name_err)) ? 'has-error' : ''; ?>">
                            <label>Family Name</label>
                            <input type="text" name="family_name" class="form-control" value="<?php echo $family_name; ?>">
                            <span class="help-block"><?php echo $family_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
                            <span class="help-block"><?php echo $first_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($middle_name_err)) ? 'has-error' : ''; ?>">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" value="<?php echo $middle_name; ?>">
                            <span class="help-block"><?php echo $middle_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($husband_surname_err)) ? 'has-error' : ''; ?>">
                            <label>Husband Surname</label>
                            <input type="text" name="husband_surname" class="form-control" value="<?php echo $husband_surname; ?>">
                            <span class="help-block"><?php echo $husband_surname_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($date_of_birth_err)) ? 'has-error' : ''; ?>">
                            <label>Birthdate</label>
                            <input type="text" name="date_of_birth" class="form-control" value="<?php echo $date_of_birth; ?>">
                            <span class="help-block"><?php echo $date_of_birth_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($place_of_birth_err)) ? 'has-error' : ''; ?>">
                            <label>Birthplace</label>
                            <input type="text" name="place_of_birth" class="form-control" value="<?php echo $place_of_birth; ?>">
                            <span class="help-block"><?php echo $place_of_birth_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($civil_status_err)) ? 'has-error' : ''; ?>">
                            <label>Civil Status</label>
                            <input type="text" name="civil_status" class="form-control" value="<?php echo $civil_status; ?>">
                            <span class="help-block"><?php echo $civil_status_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($purpose_err)) ? 'has-error' : ''; ?>">
                            <label>Purpose</label>
                            <input type="text" name="purpose" class="form-control" value="<?php echo $purpose; ?>">
                            <span class="help-block"><?php echo $purpose_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
                            <label>Gender</label>
                            <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
                            <span class="help-block"><?php echo $gender_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($dst_paid_err)) ? 'has-error' : ''; ?>">
                            <label>DST Paid</label>
                            <input type="text" name="dst_paid" class="form-control" value="<?php echo $dst_paid; ?>">
                            <span class="help-block"><?php echo $dst_paid_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="welcome.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>