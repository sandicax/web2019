<?php
include_once('headerAdmin.php');
require_once('../phpmailer/src/PHPMailer.php');
$service = new UserC();

?>

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
    $pwd = $_POST['pwd'];

    $usr = new User();
    $usr->setEmail($email);
    $usr->setCodePostal($code);
    $usr->setNom($nom);
    $usr->setPrenom($prenom);
    $usr->setVille($ville);
    $usr->setRegion($region);
    $usr->setSexe($sexe);
    $usr->setDateNaissance($date);
    {
        $degree = $_POST['diplome'];
        $usr->setDateDebutContrat($user["dateDebutContrat"]);
        $usr->setDateFinContrat($user["dateFinContrat"]);
        $usr->setDegree($degree);
    }
    $usr->setPassword($pwd);

    $service = new UserC();


    if($user["email"]!= $usr->getEmail())
    {
        $emailExist = $service->verifierUniqueEmail($usr);
    }

    if($emailExist == null)
    {
        $service->updateEmploye($user["id"] , $usr);
        echo "<script>window.open('adminHome.php','_self')</script>";
    }
    else{
        var_dump("error");
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
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <label for="" style="font-weight: 600">
                        Nom
                        <input type="text" value="<?php echo $user['nom'] ?>" autofocus onblur="validName()" name="nom" id="nom" placeholder="Nom" class="form-control">
                    </label>
                    <div class="alert alert-danger" id="alertNom" style="display: none; font-size: 14px">
                        Ce champ est obligatoire
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="" style="font-weight: 600">
                        Prénom
                        <input type="text" name="prenom" value="<?php echo $user['prenom'] ?>" id="prenom" onblur="validPrenom()" placeholder="Prénom" class="form-control">
                    </label>
                    <div class="alert alert-danger" id="alertPrenom" style="display: none; font-size: 14px">
                        Ce champ est obligatoire
                    </div>
                </div>
            </div>

            <label for="" style="font-weight: 600">
                Email
                <input type="email" onblur="validEmail()" value="<?php echo $user['email'] ?>" placeholder="Email" name="email" id="email" class="form-control">
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
                        <input onblur="validateDate()" type="date" value="<?php echo $user['date_nais'] ?>" name="date" id="date" class="form-control">
                    </label>
                    <div class="alert alert-danger" id="alertDate" style="display: none; font-size: 14px">
                        Veuillez saisir une date de naissance valide
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="" style="font-weight: 600">
                        Région
                        <input type="text" placeholder="Région" onblur="validRegion()" value="<?php echo $user['region'] ?>"  name="region" id="region" class="form-control">
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
                        <input type="text" name="ville" onblur="validVille()" value="<?php echo $user['ville'] ?>" id="ville" class="form-control">
                    </label>
                    <div class="alert alert-danger" id="alertVille" style="display: none; font-size: 14px">
                        Ce champ est obligatoire
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="" style="font-weight: 600">
                        Code Postal
                        <input type="number" onblur="validCode()" placeholder="Code Postal" value="<?php echo $user['codePostal'] ?>" name="code" id="code" class="form-control">
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
                            <option <?php if ($user['sexe'] == "Homme") echo "selected" ; ?> value="Homme">Homme</option>
                            <option <?php if ($user['sexe'] == "Femme") echo "selected" ; ?> value="Femme">Femme</option>
                        </select>
                    </label>
                </div>
                <?php
                    if($role == 13 || $role == 14)
                        echo '
                        
                        <div class="col-md-6">
                            <label for="" style="font-weight: 600">
                                Diplôme
                                <input type="text" placeholder="Diplôme" value="'.$user["degree"].'" onblur="validDiplome()" name="diplome" id="diplome" class="form-control">
                            </label>
                            <div class="alert alert-danger" id="alertDiplome" style="display: none; font-size: 14px">
                                Ce champ est obligatoire
                            </div>
                        </div>
                        ';
                ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="" style="font-weight: 600">
                        Mots de passe
                        <input class="form-control" type="password" name="pwd" required>
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
