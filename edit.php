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
$or_no = $_SESSION["or_no"];
$family_name = $_SESSION["family_name"];
$first_name = $_SESSION["first_name"];
$middle_name = $_SESSION["middle_name"];
$husband_surname = $_SESSION["husband_surname"];
$address = $_SESSION["address"];
$date_of_birth = $_SESSION["date_of_birth"];
$place_of_birth = $_SESSION["place_of_birth"];
$civil_status = $_SESSION["civil_status"];
$purpose = $_SESSION["purpose"];
$gender = $_SESSION["gender"];
$dst_paid = $_SESSION["dst_paid"];
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate Receipt

    $input_family_name = trim($_POST["family_name"]);
    if(empty($input_family_name)){
        $family_name = $family_name;
    } elseif(!filter_var($input_family_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $family_name_err = "Please enter a valid Family Name.";
    } else{
        $family_name = $input_family_name;
    }

    $input_first_name = trim($_POST["first_name"]);
    if(empty($input_first_name)){
        $first_name = $first_name;
    } elseif(!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $first_name_err = "Please enter a valid First Name.";
    } else{
        $first_name = $input_first_name;
    }

    $input_middle_name = trim($_POST["middle_name"]);
    if(empty($input_middle_name)){
        $middle_name = $middle_name;
    } elseif(!filter_var($input_middle_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $middle_name_err = "Please enter a valid Middle Name.";
    } else{
        $middle_name = $input_middle_name;
    }

    $input_husband_surname = trim($_POST["husband_surname"]);
    if(empty($input_husband_surname)){
        $husband_surname = $husband_surname;
    } else{
        $husband_surname = $input_husband_surname;
    }

    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address = $address;
    } else{
        $address = $input_address;
    }

    $input_date_of_birth = trim($_POST["date_of_birth"]);
    if(empty($input_date_of_birth)){
        $date_of_birth = $date_of_birth;
    } else{
        $date_of_birth = $input_date_of_birth;
    }

    $input_place_of_birth = trim($_POST["place_of_birth"]);
    if(empty($place_date_of_birth)){
        $place_of_birth = $place_of_birth;
    } else{
        $place_of_birth = $input_place_of_birth;
    }

    $input_civil_status = trim($_POST["civil_status"]);
    if(empty($civil_status)){
        $civil_status = $civil_status;
    } else{
        $civil_status = $input_civil_status;
    }

    $input_purpose = trim($_POST["purpose"]);
    if(empty($purpose)){
        $purpose = $purpose;
    } else{
        $purpose = $input_purpose;
    }

    $input_gender = trim($_POST["gender"]);
    if(empty($gender)){
        $gender = $gender;
    } else{
        $gender = $input_gender;
    }

    $input_dst_paid = trim($_POST["dst_paid"]);
    if(empty($dst_paid)){
        $dst_paid = $dst_paid;
    } else{
        $dst_paid = $input_dst_paid;
    }

    // Check input errors before inserting in database

    if(empty($family_name_err)){
        // Prepare an insert statement
        $sql = "update receipt set family_name = ? where id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // Attempt to execute the prepared statement
        mysqli_stmt_bind_param($stmt, "si", $param_family_name, $param_id);
            
            // Set parameters
            $param_family_name = $family_name;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                end;
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    if(empty($first_name_err)){
        // Prepare an insert statement
        $sql = "update receipt set first_name = ? where id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // Attempt to execute the prepared statement
        mysqli_stmt_bind_param($stmt, "si", $param_first_name, $param_id);
            
            // Set parameters
            $param_first_name = $first_name;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                end;
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    if(empty($middle_name_err)){
        // Prepare an insert statement
        $sql = "update receipt set middle_name = ? where id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // Attempt to execute the prepared statement
        mysqli_stmt_bind_param($stmt, "si", $param_middle_name, $param_id);
            
            // Set parameters
            $param_middle_name = $middle_name;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                end;
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    if(empty($husband_surname_err)){
        // Prepare an insert statement
        $sql = "update receipt set husband_surname = ? where id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // Attempt to execute the prepared statement
        mysqli_stmt_bind_param($stmt, "si", $param_husband_surname, $param_id);
            
            // Set parameters
            $param_husband_surname = $husband_surname;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                end;
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    if(empty($address_err)){
        // Prepare an insert statement
        $sql = "update receipt set address = ? where id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // Attempt to execute the prepared statement
        mysqli_stmt_bind_param($stmt, "si", $param_address, $param_id);
            
            // Set parameters
            $param_address = $address;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                end;
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    if(empty($date_of_birth_err)){
        // Prepare an insert statement
        $sql = "update receipt set date_of_birth = ? where id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // Attempt to execute the prepared statement
        mysqli_stmt_bind_param($stmt, "si", $param_date_of_birth, $param_id);
            
            // Set parameters
            $param_date_of_birth = $date_of_birth;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                end;
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    if(empty($place_of_birth_err)){
        // Prepare an insert statement
        $sql = "update receipt set place_of_birth = ? where id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // Attempt to execute the prepared statement
        mysqli_stmt_bind_param($stmt, "si", $param_place_of_birth, $param_id);
            
            // Set parameters
            $param_place_of_birth = $place_of_birth;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                end;
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    if(empty($civil_status_err)){
        // Prepare an insert statement
        $sql = "update receipt set civil_status = ? where id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // Attempt to execute the prepared statement
        mysqli_stmt_bind_param($stmt, "si", $param_civil_status, $param_id);
            
            // Set parameters
            $param_civil_status = $civil_status;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                end;
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    if(empty($purpose_err)){
        // Prepare an insert statement
        $sql = "update receipt set purpose = ? where id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // Attempt to execute the prepared statement
        mysqli_stmt_bind_param($stmt, "si", $param_purpose, $param_id);
            
            // Set parameters
            $param_purpose = $purpose;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                end;
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    if(empty($gender_err)){
        // Prepare an insert statement
        $sql = "update receipt set gender = ? where id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // Attempt to execute the prepared statement
        mysqli_stmt_bind_param($stmt, "si", $param_gender, $param_id);
            
            // Set parameters
            $param_gender = $gender;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                end;
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    if(empty($dst_paid_err)){
        // Prepare an insert statement
        $sql = "update receipt set dst_paid = ? where id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            // Attempt to execute the prepared statement
        mysqli_stmt_bind_param($stmt, "si", $param_dst_paid, $param_id);
            
            // Set parameters
            $param_dst_paid = $dst_paid;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: details.php");
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
                        <h2>Edit Record</h2>
                    </div>
                    <p>Please fill this form to update your personal details.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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