<?php
include_once ('header.php');
if($user['role'] == 'user')
    echo "<script>window.open('index.php','_self')</script>";
elseif ($user['role'] == 16 || $user['role'] == 15 || $user['role'] == 14 || $user['role'] == 13)
{
    echo "<script>window.open('adminHome.php','_self')</script>";
}

$utilisateur = null;
if(isset($_GET['mail']))
{
    $email = $_GET['mail'];
    $token = $_GET['token'];
    $service = new UserC();
    $utilisateur = $service->verifyUrl($token,$email);
    if(!$utilisateur)
        echo "<script>window.open('index.php','_self')</script>";
}

$email = $_GET['mail'];

if(isset($_POST['submit']))
{
    $pwd = $_POST['password'];
    $service->resetPassword($pwd,$email);
    echo "<script>window.open('login.php','_self')</script>";
}

?>


<style>
    body{
        background-color: #74D0F1;
    }
</style>

<div class="container" style="margin-top : 40px">
    <div class="row" >
        <div class="col-sm-3"></div>
        <div class="col-sm-6 mobile-pull">

                <article role="login">
                    <h3 class="text-center"><i class="fa fa-lock"></i>Réinitialiser votre mots de passe</h3>
                    <form  action="" method="post">
                        <div class="form-group">
                            <label for="">Veuillez saisir votre nouveau mots de passe</label>
                            <input type="password" autofocus required name="password" class="form-control" placeholder="Nouveau mots de passe">
                        </div>

                        <div class="form-group">
                            <button id="submit" onclick="verifier(event)"  class="btn btn-success btn-block" name="submit" >
                                CONFIRMER
                            </button>
                        </div>
                    </form>
                </article>


        </div>
        <script src="signup.js"></script>

        <?php
        include_once ('footer.php');
        ?>
