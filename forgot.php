<?php
    include_once ('header.php');
    if($user['role'] == 'user')
        echo "<script>window.open('index.php','_self')</script>";
    elseif ($user['role'] == 16 || $user['role'] == 15 || $user['role'] == 14 || $user['role'] == 13)
    {
        echo "<script>window.open('adminHome.php','_self')</script>";
    }


    $utilisateur = null;
    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $service = new UserC();
        $utilisateur = $service->passwordForgot($email);
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

            <?php
                if($utilisateur)
                {
             ?>
                    <article role="login">
                        <h3 class="text-center"><i class="fa fa-lock"></i>Réinitialiser votre mots de passe</h3>
                        <form  action="" method="post">
                            <h4>
                                Un email vous a été envoyer merci de consulter votre boite mail
                            </h4>
                        </form>
                    </article>
            <?php
                }
                else{
                 ?>
            <article role="login">
                <h3 class="text-center"><i class="fa fa-lock"></i>Réinitialiser votre mots de passe</h3>
                <form  action="" method="post">
                    <div class="form-group">
                        <label for="">Veuillez saisir votre email</label>
                        <input type="text" autofocus onblur="validUsername()" name="email" id="username" class="form-control" placeholder="Nom d'utilisateur">
                    </div>

                    <div class="form-group">
                        <button id="login" onclick="verifier(event)"  class="btn btn-success btn-block" name="submit" >
                            CONNEXION
                        </button>
                    </div>
                </form>
            </article>
            <?php
                }
            ?>



        </div>
        <script src="signup.js"></script>

<?php
    include_once ('footer.php');
?>
