<?php
define('REQUIRED_FIELD_ERROR', 'This field is required');
$error = [];

$username = '';
$email = '';
$password = '';
$password_confirm = '';
$cv_url = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

$username = post_data('username');
$email = post_data('email');
$password = post_data('password');
$password_confirm = post_data('password_confirm');
$cv_url = post_data('cv_url');


if(!$username) {
    $error['username'] = REQUIRED_FIELD_ERROR;
} elseif (strlen($username) < 6 || strlen($username) > 16){
    $error['username'] = 'Username must be in between 6 and 16 characters';
}
if(!$email) {
    $error['email'] = REQUIRED_FIELD_ERROR;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error['email'] = 'This field must contain valid email addresses';
}
if(!$password) {
    $error['password'] = REQUIRED_FIELD_ERROR;
}
if(!$password_confirm) {
    $error['password_confirm'] = REQUIRED_FIELD_ERROR;
}
if($password && $password_confirm && strcmp($password, $password_confirm) !=0){
    $error['password_confirm'] = 'This must match the password field';
}
if(!$cv_url && !filter_var($cv_url, FILTER_VALIDATE_URL)) {
    $error['cv_url'] = 'Please provide a valid URL';
}

if(empty($errors)){
    echo 'The form is submited';
}
}

function post_data($field)
{
    $_POST[$field] ??= '';
return htmlspecialchars(stripslashes($_POST[$field]));
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Validation and registration form</title>
</head>

<body>
    <div class="body-part">
        <form action="" method="post" novalidate>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control <?php echo isset($error['username']) ? 'is-invalid' : ''?>"
                            name="username" value="<?php echo $username?>">
                        <small class="form-text text-muted">Min. 6 and max.16 characters</small>
                        <div class="invalid-feedback"><?php echo $error['username'] ?? ''?></div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control <?php echo isset($error['email']) ? 'is-invalid' : ''?>" type="email"
                            value="<?php echo $email?>" name="email">
                        <div class="invalid-feedback"><?php echo $error['email'] ?? ''?></div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control <?php echo isset($error['password']) ? 'is-invalid' : ''?>"
                            type="password" value="<?php echo $password?>" name="password">
                        <div class="invalid-feedback"><?php echo $error['password'] ?? ''?></div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Repeat Password</label>
                        <input class="form-control <?php echo isset($error['password_confirm']) ? 'is-invalid' : ''?>"
                            type="password" value="<?php echo $password_confirm?>" name="password_confirm">
                        <div class="invalid-feedback"><?php echo $error['password_confirm'] ?? ''?></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <lable>Your CV link</lable>
                    <input type="text" class="form-control <?php echo isset($error['cv_url']) ? 'is-invalid' : ''?>"
                        name="cv_url" value="<?php echo $cv_url?>" placeholder="https://...">
                    <div class="invalid-feedback"><?php echo $error['cv_url'] ?? ''?></div>
                </div>
            </div>
            <div class="form-control">
                <button class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>