<?php 
    session_start();
    ob_start();
    include 'config/config.php';
    if (isset($_POST['signin'])) {
        $group = 'admin';
        $email = $_POST['userEmail'];
        $password = MD5($_POST['userPassword']);
        $sql_user = "SELECT * 
                    FROM tbl_user 
                    WHERE userEmail = '$email' AND userPassword = '$password' AND userGroup = '$group'";
        $query_user = mysqli_query($mysqli, $sql_user);
        $count = mysqli_num_rows($query_user);
        if ($count > 0) {
            $_SESSION['signin'] = $email;
            header('Location: index.php');
        } else {
            $err_message = "Email or password not match. Please try again!";
        }
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kneelife - Manager Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<!-- Modal -->
<div class="modal" style="display: flex;">
    <div class="modal__overlay"></div>
    <div class="modal__body">
        <!-- Sign in form -->
        <form class="auth-form" autocomplete="off" name="signinModal" action="" method="POST">
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Sign in</h3>
                </div>
                <div class="auth-form__form">
                    <div class="auth-form__group">
                        <input name="userEmail" type="email" class="auth-form__input-text" placeholder="Email" required>
                    </div>
                    <div class="auth-form__group">
                        <input name="userPassword" type="password" class="auth-form__input-text" placeholder="Password" required>
                    </div>
                    <?php 
                        if (isset($err_message)) {
                            echo "<p style='color: red; font-size: 1.2rem; margin-top: 1.2rem; font-weight: 700;' >".$err_message."</p>";
                        }
                    ?>
                    <div class="auth-form__controls">
                        <button class="btn btn--primary auth-form__button" name="signin">Sign in</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- End of Sign in form -->
    </div>  
</div>