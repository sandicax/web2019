<?php
include_once 'header.php';

$pwd = null;
$email = null;
$nom = null;
$prenom = null;
$date = null;
$region = null;
$ville = null;
$code = null;
$numero = null;

$oldPhone = $user["numero"];
$oldEmail = $user["email"];
$userId = $user["id"];
$userImg = $user["photo"];

$emailExist = "";
$phoneExist = "";

if(isset($_POST['submit']))
{
    $pwd = $_POST['pwd'];
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $region = $_POST['region'];
    $ville = $_POST['ville'];
    $code = $_POST['code'];
    $numero = $_POST['num'];

    $usr = new User();
    $usr->setPassword($pwd); //
    $usr->setEmail($email); //
    $usr->setCodePostal($code);
    $usr->setNom($nom); //
    $usr->setPrenom($prenom); //
    $usr->setVille($ville);
    $usr->setRegion($region); //
    $usr->setNumero($numero);

    $folder ="uploads/";
    $image = $_FILES['image']['name'];
    $path = $folder . $image ;

    $target_file=$folder.basename($_FILES["image"]["name"]);
    $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
    $allowed=array('jpeg','png' ,'jpg'); $filename=$_FILES['image']['name'];

    $ext=pathinfo($filename, PATHINFO_EXTENSION);

    if(!in_array($ext,$allowed) )
    {

        echo "<script>
                    alert('Les extensions acceptés sont : jpeg , png ou jpj');
                </script>";
        return;

    }
    else{
        move_uploaded_file( $_FILES['image'] ['tmp_name'], $path);
        $usr->setPhoto($image);
        $service = new UserC();


        if($oldEmail!= $usr->getEmail())
        {
            $emailExist = $service->verifierUniqueEmail($usr);
        }

        if($oldPhone != $usr->getNumero())
        {
            $phoneExist = $service->verifierUniqueNumero($usr);
        }

        if($emailExist == "" && $phoneExist == "")
        {
            $service->updateProfile($userId, $usr);
            echo "<script>window.open('profile.php','_self')</script>";
        }
    }

}
?>
<style>
    body{
        background-color: #74D0F1;
    }
</style>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10"><h1><?php echo $user["username"]; ?></h1></div>
    </div>
    <form class="form" action="" method="post" id="registrationForm" enctype="multipart/form-data">

        <div class="row">
            <div class="col-sm-3">
                <div class="text-center">
                    <?php
                    if($userImg)
                    {
                        echo '
                        <img src="uploads/'.$userImg.'" class="avatar img-circle img-thumbnail" />
                    ';
                    }
                    else{
                        echo '
                      <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                    ';
                    }
                    ?>

                    <h6>Télécharger une image...</h6>
                    <input type="file" name="image" id="image" class="text-center center-block file-upload" />
                </div></hr><br>


            </div><!--/col-3-->
            <div class="col-sm-9">

                <div class="tab-content">
                    <div class="tab-pane active" id="home">

                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="first_name"><h4>Prénom</h4></label>
                                <input type="text" class="form-control" onblur="validPrenom()"  value="<?php echo $user["prenom"]; ?>" name="prenom" id="prenom" placeholder="first name" title="enter your first name if any.">
                            </div>
                            <div class="alert alert-danger" id="alertPrenom" style="display: none; font-size: 14px">
                                Ce champ est obligatoire
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="last_name"><h4>Nom</h4></label>
                                <input type="text" class="form-control" onblur="validName()" value="<?php echo $user["nom"]; ?>" name="nom" id="nom" placeholder="last name" title="enter your last name if any.">
                            </div>
                            <div class="alert alert-danger" id="alertNom" style="display: none; font-size: 14px">
                                Ce champ est obligatoire
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="phone"><h4>Numéro de téléphone</h4></label>
                                <input type="text" class="form-control" onblur="validPhone()" name="num" value="<?php echo $user["numero"]; ?>" id="num" placeholder="enter phone" title="enter your phone number if any.">
                            </div>
                            <div class="alert alert-danger" id="alertPhone" style="display: none; ">
                                Ce champ est obligatoire
                            </div>
                            <div class="alert alert-danger" id="alertPhoneNotValid" style="display: none;">
                                Veuillez saisir un numéro valide
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email"><h4>Email</h4></label>
                                <input type="email" class="form-control" onblur="validEmail()" value="<?php echo $user["email"]; ?>" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                            </div>
                            <div class="alert alert-danger" id="alertEmail" style="display: none">
                                Ce champ est obligatoire
                            </div>
                            <div class="alert alert-danger" id="alertEmailNotValid" style="display: none">
                                Veuillez saisir un email valid!
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email"><h4>Région</h4></label>
                                <input type="text" class="form-control" onblur="validRegion()" value="<?php echo $user["region"]; ?>" name="region" id="region" placeholder="Région" title="enter a location">
                            </div>
                            <div class="alert alert-danger" id="alertRegion" style="display: none;">
                                Ce champ est obligatoire
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"><h4>Ville</h4></label>
                                    <input type="text" name="ville" onblur="validVille()" value="<?php echo $user["ville"]; ?>" value=""  id="ville" class="form-control" placeholder="Ville">
                                </div>
                                <div class="alert alert-danger" id="alertVille" style="display: none; font-size: 14px">
                                    Ce champ est obligatoire
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"><h4>Code Postal</h4></label>
                                    <input type="number" name="code" onblur="validCode()" value="<?php echo $user["codePostal"]; ?>" id="code" class="form-control" placeholder="Code Postal">
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
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" name="submit" onclick="verifier(event)" id="enregistrer" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                        </div>
                        <hr>
                    </div><!--/tab-pane-->
                </div><!--/tab-content-->
                <script src="js/profile.js"></script>
            </div><!--/col-9-->
        </div><!--/row-->
    </form>
    <?php
    include_once 'footer.php';
    ?>
