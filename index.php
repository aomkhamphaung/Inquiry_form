<?php
ob_start();
include_once 'controller/inquiry_controller.php';

$inquiry = new InquiryController();

if (isset($_POST['submit'])) {
    if (!empty($_POST['company_name'])) {
        $company_name = $_POST['company_name'];
    } else {
        $company_name_err = 'Enter company name!';
    }
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $name_err = 'Enter your name!';
    }
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $email_err = 'Enter email address!';
    }
    if (!empty($_POST['classification'])) {
        $classification = $_POST['classification'];
    } else {
        $classification_err = 'Choose inquiry classification!';
    }
    if (!empty($_POST['contract'])) {
        $contract = ($classification === "Bluebean maintenace information") ? $_POST["contract_number"] : NULL;
    } else {
        $contract_err = 'Enter 4-digit contract number!';
    }
    if (!empty($_POST['requirement'])) {
        $requirement = $_POST['requirement'];
    } else {
        $requirement_err = 'Enter inquiry requirement!';
    }

    if (!$error) {
        $result = $inquiry->addData($company_name, $name, $email, $classification, $contract, $requirement);
        echo $result;
        if ($result) {
            echo " 
                <script>
                alert('success!');
            </script>";
            header('location:index.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry From</title>
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6 mt-3">
                <form action="" method="post">
                    <h3 class="text-center mt-3">Customer inquiry form</h3>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" name="company_name" class="form-control" id="company_name" maxlength="64"
                            value="<?php
                            if (isset($company_name)) {
                                echo $company_name;
                            }
                            ?>">
                        <span class="text-danger">
                            <?php
                            if (isset($company_name_err)) {
                                echo $company_name_err;
                            }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Person In Charge's name</label>
                        <input type="text" name="name" class="form-control" id="name" maxlength="64" value="<?php
                        if (isset($name)) {
                            echo $name;
                        }
                        ?>">
                        <span class="text-danger">
                            <?php
                            if (isset($name_err)) {
                                echo $name_err;
                            }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?php
                        if (isset($email)) {
                            echo $email;
                        }
                        ?>">
                        <span class="text-danger">
                            <?php
                            if (isset($email_err)) {
                                echo $email_err;
                            }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="classification" class="form-label">Inquiry Classification</label>
                        <select class="form-select" aria-label="Default select example" id="classification"
                            name="classification" onchange="toggle()">
                            <option selected hidden>Choose Classification</option>
                            <option value="BlueBean specifications" <?php echo (isset($classification) && $classification == 'BlueBean specifications') ? 'selected' : ''; ?>>
                                BlueBean
                                specifications
                            </option>
                            <option value="BlueBean contract" <?php echo (isset($classification) && $classification == 'BlueBean contract') ? 'selected' : ''; ?>>
                                BlueBean contract</option>
                            <option value="BlueBean maintence information" <?php echo (isset($classification) && $classification == 'BlueBean maintence information') ? 'selected' : ''; ?>>
                                BlueBean maintence information</option>
                        </select>
                    </div>
                    <div class="mb-3" style="display: none" id="contract_div">
                        <label for="contract" class="form-label">Contrat Number</label>
                        <input type="number" name="contract" id="contract" min="1000" max="9999" class="form-control"
                            value="<?php
                            if (isset($contract)) {
                                echo $contract;
                            }
                            ?>">
                        <span class="text-danger">
                            <?php
                            if (isset($contract_err)) {
                                echo $contract_err;
                            }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="requirement" class="form-label">Inquiry Requirement</label>
                        <textarea name="requirement" id="" cols="72" rows="5" maxlength="255" required value="<?php
                        if (isset($requirement)) {
                            echo $requirement;
                        }
                        ?>">
                        </textarea>
                        <span class="text-danger">
                            <?php
                            if (isset($requirement_err)) {
                                echo $requirement_err;
                            }
                            ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function toggle() {
                var classification = document.getElementById('classification').value;
                var contract_div = document.getElementById('contract_div');

                if (classification === 'BlueBean maintence information') {
                    contract_div.style.display = "block";
                } else {
                    contract_div.style.display = "none";
                }
            }
        </script>
</body>

</html>