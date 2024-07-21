<?php
session_start();
require_once('model/connexion.php');
global $connect;

$login = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['identifiant']) && isset($_POST["mot_de_passe"])) {
        $login = $_POST['identifiant'];
        $password = $_POST['mot_de_passe'];

        try {
            $sqlAdmin = "SELECT *, 'admin' as role FROM administrateur WHERE login_admin = :login AND password_admin = :password";
            $query = $connect->prepare($sqlAdmin);
            $query->execute(['login' => $login, 'password' => $password]);
            $user = $query->fetch();

            if (!$user) {
                $sqlClient = "SELECT *, 'client' as role FROM client WHERE login_client = :login AND password_client = :password";
                $query = $connect->prepare($sqlClient);
                $query->execute(['login' => $login, 'password' => $password]);
                $user = $query->fetch();
            }
				
            if ($user) {
                $_SESSION['login'] = $login; 
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === "client") {
                    header("Location: error.php");
                    exit();
                } elseif ($user['role'] === "admin") {
                    header("Location: view/accueil_view.php");
                    exit();
                }
            } else {
                $error = "Cet utilisateur n'existe pas ou le mot de passe est incorrect.";
            }
        } catch (PDOException $e) {
            $error = "Erreur de connexion à la base de données: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Page de Connexion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="public/images/icons/favicon.ico"/>

    <link rel="stylesheet" type="text/css" href="public/assets/vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="public/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="public/assets/vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css" href="public/assets/vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="public/assetsvendor/select2/select2.min.css">

    <link rel="stylesheet" type="text/css" href="public/assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/mainconnect.css">

</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="public/images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="" method="post" id="myform">
                    <span class="login100-form-title">
                        Employé
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="identifiant" placeholder="Identifiant" value="<?= $login ?>" required id="login">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="mot_de_passe" placeholder="Mot de passe" required id="passwd">
                        <div class="error-message" id="error-message"><?= isset($error) ? $error : "" ?></div>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Se connecter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="public/assets/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="public/assets/vendor/bootstrap/js/popper.js"></script>
    <script src="public/assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="public/assets/vendor/select2/select2.min.js"></script>

    <script src="public/assets/vendor/tilt/tilt.jquery.min.js"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script src="public/assets/js/main.js"></script>

</body>
</html>