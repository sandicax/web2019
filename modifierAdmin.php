<?php
include_once('headerAdmin.php');
require_once('../phpmailer/src/PHPMailer.php');
$service = new UserC();
    if(isset($_GET['id']))
    {
        $employer = $service->getEmployer($_GET['id']);
        //var_dump($employer);
        if(!$employer)
            echo "<script>window.open('adminHome.php','_self')</script>";
        elseif ($employer["role"] == 14 || $employer["role"] == 13)
            echo "<script>window.open('adminHome.php','_self')</script>";
    }

else
    echo "<script>window.open('adminHome.php','_self')</script>";
?>

<?php
$username = null;
$cin = null;
$pwd = $employer['password'];
$email = null;
$nom = null;
$prenom = null;
$date = null;
$phone = null;
$region = null;
$ville = null;
$code = null;
$sexe = null;
$numero = null;

$cinExist = null;
$emailExist = null;
$usernameExist = null;
$phoneExist = null;
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date = $_POST['date'];
    $region = $_POST['region'];
    $ville = $_POST['ville'];
    $code = $_POST['code'];
    $sexe = $_POST['sexe'];
    $date = $_POST['date'];

        var_dump($nom);

    $usr = new User();
    $usr->setEmail($email);
    $usr->setCodePostal($code);
    $usr->setNom($nom);
    $usr->setPrenom($prenom);
    $usr->setVille($ville);
    $usr->setRegion($region);
    $usr->setSexe($sexe);
    $usr->setDateNaissance($date);
    $usr->setPassword($pwd);
    $service = new UserC();
    $id=$employer["id"];

    if($employer["email"]!= $usr->getEmail())
    {
        $emailExist = $service->verifierUniqueEmail($usr);

    }

    if($emailExist == null || $employer["email"]== $usr->getEmail())
    {
        $service->updateEmploye($id , $usr);

        echo "<script>window.open('administrateur.php','_self')</script>";
    }
    else{
        var_dump("error ".$id);
    }
}
?>

<style>
    html {
        margin: 40px auto;
    }
    .btn-search {
        background: #424242;
        border-radius: 0;
        color: #fff;
        border-width: 1px;
        border-style: solid;
        border-color: #1c1c1c;
    }
    .btn-search:link, .btn-search:visited {
        color: #fff;
    }
    .btn-search:active, .btn-search:hover {
        background: #1c1c1c;
        color: #fff;
    }
</style>
<div class="content">
    <div class="container">
        <div class="jumbotron" style="padding: 1rem 2rem">
            <h3 class="text-center" style="font-weight: 600">Admins</h3>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <label for="" style="font-weight: 600">
                        Nom
                        <input type="text" value="<?php echo $employer['nom'] ?>" autofocus onblur="validName()" name="nom" id="nom" placeholder="Nom" class="form-control">
                    </label>
                    <div class="alert alert-danger" id="alertNom" style="display: none; font-size: 14px">
                        Ce champ est obligatoire
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="" style="font-weight: 600">
                        Prénom
                        <input type="text" name="prenom" value="<?php echo $employer['prenom'] ?>" id="prenom" onblur="validPrenom()" placeholder="Prénom" class="form-control">
                    </label>
                    <div class="alert alert-danger" id="alertPrenom" style="display: none; font-size: 14px">
                        Ce champ est obligatoire
                    </div>
                </div>
            </div>

           <label for="" style="font-weight: 600">
               Email
               <input type="email" onblur="validEmail()" value="<?php echo $employer['email'] ?>" placeholder="Email" name="email" id="email" class="form-control">
           </label>
           <div class="alert alert-danger" id="alertEmail" style="display: none; font-size: 14px">
               Ce champ est obligatoire
           </div>
           <div class="alert alert-danger" id="alertEmailNotValid" style="display: none; font-size: 14px">
               Veuillez saisir un email valid!
           </div>

           <div class="row">
               <div class="col-md-6">
                   <label for="" style="font-weight: 600">
                       Date de naissance
                       <input onblur="validateDate()" type="date" value="<?php echo $employer['date_nais'] ?>" name="date" id="date" class="form-control">
                   </label>
                   <div class="alert alert-danger" id="alertDate" style="display: none; font-size: 14px">
                       Veuillez saisir une date de naissance valide
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" style="font-weight: 600">
                       Région
                       <input type="text" placeholder="Région" onblur="validRegion()" value="<?php echo $employer['region'] ?>"  name="region" id="region" class="form-control">
                   </label>
                   <div class="alert alert-danger" id="alertRegion" style="display: none; font-size: 14px">
                       Ce champ est obligatoire
                   </div>
               </div>
           </div>
           <div class="row">
               <div class="col-md-6">
                   <label for="" style="font-weight: 600">
                       Ville
                       <input type="text" name="ville" onblur="validVille()" value="<?php echo $employer['ville'] ?>" id="ville" class="form-control">
                   </label>
                   <div class="alert alert-danger" id="alertVille" style="display: none; font-size: 14px">
                       Ce champ est obligatoire
                   </div>
               </div>
               <div class="col-md-6">
                   <label for="" style="font-weight: 600">
                       Code Postal
                       <input type="number" onblur="validCode()" placeholder="Code Postal" value="<?php echo $employer['codePostal'] ?>" name="code" id="code" class="form-control">
                   </label>
                   <div class="alert alert-danger" id="alertCode" style="display: none; font-size: 14px">
                       Ce champ est obligatoire
                   </div>
                   <div class="alert alert-danger" id="alertCodeNotValid" style="display: none; font-size: 14px">
                       Veuillez saisir un code postal valide
                   </div>
               </div>
           </div>

           <div class="row">
               <div class="col-md-6">
                   <label for="" style="font-weight: 600">
                       Sexe
                       <select name="sexe" id="" class="custom-select">
                           <option <?php if ($employer['sexe'] == "Homme") echo "selected" ; ?> value="Homme">Homme</option>
                           <option <?php if ($employer['sexe'] == "Femme") echo "selected" ; ?> value="Femme">Femme</option>
                       </select>
                   </label>
               </div>

           </div>

                <script src="js/professeur.js"></script>

                <button type="submit" name="submit" id="ajoutLivreur" onclick="verifierLivreur(event)" class="btn btn-success">Enregistrer</button>
        </form>
    </div>
</div>


<?php
include_once ('footerAdmin.php');
?>
