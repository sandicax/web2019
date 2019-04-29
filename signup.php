<?php
    include_once 'header.php';
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
            
<?php
    $username = null;
    $cin = null;
    $pwd = null;
    $email = null;
    $nom = null;
    $prenom = null;
    $date = null;
    $phone = null;
    $region = null;
    $ville = null;
    $code = null;
    $sexe = null;
    $role = "user";
    $numero = null;

    $cinExist = null;
    $emailExist = null;
    $usernameExist = null;
    $phoneExist = null;
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $cin = $_POST['cin'];
        $pwd = $_POST['pwd'];
        $email = $_POST['email'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date = $_POST['date'];
        $phone = $_POST['num'];
        $region = $_POST['region'];
        $ville = $_POST['ville'];
        $code = $_POST['code'];
        $sexe = $_POST['sexe'];
        $role = 17;
        $numero = $_POST['num'];

        $service = new UserC();
        $token = $service->generateToken();

        $user = new User();
        $user->setCin($cin);
        $user->setPassword($pwd);
        $user->setEmail($email);
        $user->setUsername($username);
        $user->setCodePostal($code);
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setVille($ville);
        $user->setRegion($region);
        $user->setRole($role);
        $user->setSexe($sexe);
        $user->setToken($token);
        $user->setDateNaissance($date);
        $user->setNumero($numero);


        //var_dump($user);

        $cinExist = $service->verifierUniqueCin($user);
        $emailExist = $service->verifierUniqueEmail($user);
        $usernameExist = $service->verifierUniqueUsername($user);
        $phoneExist = $service->verifierUniqueNumero($user);

        if($cinExist == null && $emailExist == null && $usernameExist == null && $phoneExist == null)
        {
            $service->creerUser($user);
            $url='http://localhost/pr/cores/verification.php?cin='.$cin.'&token='.$token;
            $send = 'Veuillez cliquez sur ce  <a href='.$url.'>lien</a> afin d\'activer votre compte';
            var_dump($send);
            $service->sendEmail($email,$send);

            echo "<script>window.open('confirmSignup.php','_self')</script>";
        }
    }
?>

              <h3 class="text-center"><i class="fa fa-lock"></i> Créer un compte</h3>
              <form class="signup" action="" method="post">
                <div class="form-group">
                  <input type="text" autofocus onblur="validUsername()" name="username" value="<?php if($username) echo $username; ?>" id="username" class="form-control" placeholder="Nom d'utilisateur">
                </div>
                  <?php
                  /*
                   *  $cinExist
                      $emailExist
                      $usernameExist
                      $phoneExist
                   */

                  if($usernameExist)
                  {
                      echo '
                            <div class="alert alert-danger" style="display: block">
                                  Ce nom d\'utilisateur est déjà utilisé
                              </div>
                        ';
                  }
                  ?>
                  <div class="alert alert-danger" id="alertUsername" style="display: none">
                      Ce champ est obligatoire
                  </div>

                <div class="form-group">
                  <input type="email" name="email" onblur="validEmail()" value="<?php if($email) echo $email; ?>" id="email" class="form-control" placeholder="Address Email">
                </div>
                  <?php
                    /*
                     *  $cinExist
                        $emailExist
                        $usernameExist
                        $phoneExist
                     */

                    if($emailExist)
                    {
                        echo '
                            <div class="alert alert-danger" style="display: block">
                                  Cet email est déjà utilisé
                              </div>
                        ';
                    }
                  ?>
                  <div class="alert alert-danger" id="alertEmail" style="display: none">
                      Ce champ est obligatoire
                  </div>
                  <div class="alert alert-danger" id="alertEmailNotValid" style="display: none">
                      Veuillez saisir un email valid!
                  </div>
         
                <div class="form-group">
                  <input type="cin" name="cin" onblur="validCin()" value="<?php if($cin) echo $cin; ?>" id="cin" class="form-control" placeholder="CIN">
                </div>
                  <?php
                  /*
                   *  $cinExist
                      $emailExist
                      $usernameExist
                      $phoneExist
                   */

                  if($cinExist)
                  {
                      echo '
                            <div class="alert alert-danger" style="display: block">
                                  Ce CIN est déjà utilisé
                              </div>
                        ';
                  }
                  ?>
                  <div class="alert alert-danger" id="alertCin" style="display: none">
                      Veuillez saisir un numéro Cin valide
                  </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="nom" value="<?php if($nom) echo $nom; ?>" onblur="validName()"  id="nom" class="form-control" placeholder="Nom">
                        </div>
                        <div class="alert alert-danger" id="alertNom" style="display: none; font-size: 14px">
                            Ce champ est obligatoire
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="prenom" onblur="validPrenom()"  value="<?php if($prenom) echo $prenom; ?>" id="prenom" class="form-control" placeholder="Prénom">
                        </div>
                        <div class="alert alert-danger" id="alertPrenom" style="display: none; font-size: 14px">
                            Ce champ est obligatoire
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="date" name="date" onblur="validateDate()" value="<?php if($date) echo $date; ?>" id="date" class="form-control">
                </div>
                  <div class="alert alert-danger" id="alertDate" style="display: none;">
                      Veuillez saisir une date de naissance valide
                  </div>
                
                <div class="form-group">
                    <input type="text" name="num" value="<?php if($numero) echo $numero; ?>" id="num" onblur="validPhone()" class="form-control" placeholder="Numéro de téléphone">
                    <?php
                    /*
                     *  $cinExist
                        $emailExist
                        $usernameExist
                        $phoneExist
                     */

                    if($phoneExist)
                    {
                        echo '
                            <div class="alert alert-danger" style="display: block">
                                  Ce numéro de téléphone est déjà utilisé
                              </div>
                        ';
                    }
                    ?>
                    <div class="alert alert-danger" id="alertPhone" style="display: none; ">
                        Ce champ est obligatoire
                    </div>
                    <div class="alert alert-danger" id="alertPhoneNotValid" style="display: none;">
                        Veuillez saisir un numéro valide
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" name="region" onblur="validRegion()" value="<?php if($region) echo $region; ?>" id="region" class="form-control" placeholder="Région">
                </div>
                  <div class="alert alert-danger" id="alertRegion" style="display: none;">
                      Ce champ est obligatoire
                  </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="ville" onblur="validVille()" value="<?php if($ville) echo $ville; ?>"  id="ville" class="form-control" placeholder="Ville">
                        </div>
                        <div class="alert alert-danger" id="alertVille" style="display: none; font-size: 14px">
                            Ce champ est obligatoire
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="number" name="code" onblur="validCode()" value="<?php if($code) echo $code; ?>"  id="code" class="form-control" placeholder="Code Postal">
                        </div>
                        <div class="alert alert-danger" id="alertCode" style="display: none; font-size: 14px">
                            Ce champ est obligatoire
                        </div>
                        <div class="alert alert-danger" id="alertCodeNotValid" style="display: none; font-size: 14px">
                            Veuillez saisir un code postal valide
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <select name="sexe" id="sexe" class="custom-select">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                    </select>
                </div>

                  <div class="form-group">
                      <div class="input-group">
                          <input type="password" name="pwd" id="pwd" onblur="validPassword()" onkeyup="passwordStength()" class="form-control"  placeholder="Mots de passe">
                          <span class="input-group-btn">
                            <button onclick="showPassword()"  class="btn btn-default reveal" type="button" style="background-color: #ccc">
                                <i id="icon" style="padding-bottom: 3.5px;padding-top: 3.5px" class="fa fa-eye"></i>
                            </button>
                          </span>
                      </div>
                      <div class="alert alert-danger" id="alertPwd" style="display: none;">
                          Ce champ est obligatoire
                      </div>
                      <div class="alert alert-danger" id="alertPwdStrength" style="display: none;">
                      </div>
                  </div>


                <div class="form-group">
                  <button id="signup" onclick="verifier(event)" type="submit" class="btn btn-success btn-block" name="submit" >
                      SUBMIT
                  </button>
                </div>
              </form>
            </article>
          </div>
          <div class="col-sm-3" style="margin-top: 250px">
              <div class="aro-pswd_info" >
                  <div id="pswd_info">
                      <h4>Password must be requirements</h4>
                      <ul>
                          <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                          <li id="number" class="invalid">At least <strong>one number</strong></li>
                          <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
                          <li id="space" class="invalid">be<strong> use [~,!,@,#,$,%,^,&,*,-,=,.,;,']</strong></li>
                      </ul>
                  </div>
              </div>
          </div>
        </div>
        </div>
    <script src="signup.js"></script>

<?php
    include_once 'footer.php';
?>