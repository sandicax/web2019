<?php
include_once('headerAdmin.php');
require_once('../phpmailer/src/PHPMailer.php');
$service = new UserC();
$clients = $service->getTechnicien();

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

        $cin = $_POST['cin'];
        $pwd = $_POST['cin'];
        $email = $_POST['email'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date = $_POST['date'];
        $region = $_POST['region'];
        $ville = $_POST['ville'];
        $code = $_POST['code'];
        $sexe = $_POST['sexe'];
        $roles = 13;
        $degree = $_POST['diplome'];
        $dateDeb = $_POST['debut'];
        $dateFin = $_POST['fin'];

        $user = new User();
        $user->setCin($cin);
        $user->setPassword($pwd);
        $user->setUsername($email);
        $user->setEmail($email);
        $user->setCodePostal($code);
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setVille($ville);
        $user->setRegion($region);
        $user->setRole($roles);
        $user->setSexe($sexe);
        $user->setDateNaissance($date);
        $user->setDateDebutContrat($dateDeb);
        $user->setDateFinContrat($dateFin);
        $user->setDegree($degree);
        $user->setEnabled(1);
        $user->setDisponibilite(1);

        $service = new UserC();


        $cinExist = $service->verifierUniqueCin($user);
        $emailExist = $service->verifierUniqueEmail($user);
        $usernameExist = $service->verifierUniqueUsername($user);
        $phoneExist = $service->verifierUniqueNumero($user);

        if($cinExist == null && $emailExist == null && $usernameExist == null && $phoneExist == null)
        {
            $service->creerTechnicien($user);

            $clients = $service->getTechnicien();
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = '465';
            $mail->isHTML();
            $mail->Username = 'ahmed.bannour@esprit.tn';
            $mail->Password = 'rcop1g1337';
            $mail->setFrom("no-reply@esprit.tn");
            $mail->Subject = "Activation de compte";
            $mail->Body = 'Votre compte a été bien crée vous pouvez désormais vous connectez avec votre addresse email et votre mots de passe 
                a été initiliser à votre CIN';
            $mail->AddAddress($email);
            $mail->send();
        }
        else{
            var_dump("error");
        }
    }

    $tabSearch = null;

    if(isset($_GET['chercher']))
    {
        $email = $_GET['keyword'];
        $tabSearch = $service->chercherLivreur($email);
    }

    if(isset($_GET['delete']))
    {
        if($_GET['delete'] == "true" && ($role == 16))
        {
            $id = $_GET["id"];
            $service->deleteUser($id);
            $clients = $service->getTechnicien();
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
            <h3 class="text-center" style="font-weight: 600">Chercheurs</h3>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" required placeholder="Chercher...">
                        <span class="input-group-btn">
                            <button class="btn btn-search" style="border-radius: 5px" name="chercher" type="submit"><i class="fa fa-search fa-fw"></i></button>
                          </span>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new">
                    <i class="fa fa-plus"></i> Ajouter
                </button>
            </div>
            <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" method="post">
                            <div class="modal-header">
                                <h4 class="modal-title" style="font-weight: 600; text-align: center" id="exampleModalLabel">Ajouter un nouveau livreur</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            Nom
                                            <input type="text" autofocus onblur="validName()" name="nom" id="nom" placeholder="Nom" class="form-control">
                                        </label>
                                        <div class="alert alert-danger" id="alertNom" style="display: none; font-size: 14px">
                                            Ce champ est obligatoire
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            Prénom
                                            <input type="text" name="prenom" id="prenom" onblur="validPrenom()" placeholder="Prénom" class="form-control">
                                        </label>
                                        <div class="alert alert-danger" id="alertPrenom" style="display: none; font-size: 14px">
                                            Ce champ est obligatoire
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            Date Début Contrat
                                            <input type="date" onblur="validateDateDeb()" name="debut" id="debut" class="form-control">
                                        </label>
                                        <div class="alert alert-danger"  id="alertDateDeb" style="display: none;">
                                            Veuillez saisir une date de début valide
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            Date Fin Contrat
                                            <input type="date" name="fin" onblur="validateDateFin()" id="fin" class="form-control">
                                        </label>
                                        <div class="alert alert-danger" id="alertDateFin" style="display: none; font-size: 14px">
                                            Veuillez saisir une date de fin valide
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            Email
                                            <input type="email" onblur="validEmail()" placeholder="Email" name="email" id="email" class="form-control">
                                        </label>
                                        <div class="alert alert-danger" id="alertEmail" style="display: none; font-size: 14px">
                                            Ce champ est obligatoire
                                        </div>
                                        <div class="alert alert-danger" id="alertEmailNotValid" style="display: none; font-size: 14px">
                                            Veuillez saisir un email valid!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            CIN
                                            <input type="number" onblur="validCin()" placeholder="Cin" name="cin" id="cin" class="form-control">
                                        </label>
                                        <div class="alert alert-danger" id="alertCin" style="display: none; font-size: 14px">
                                            Veuillez saisir un numéro Cin valide
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            Date de naissance
                                            <input onblur="validateDate()" type="date" name="date" id="date" class="form-control">
                                        </label>
                                        <div class="alert alert-danger" id="alertDate" style="display: none; font-size: 14px">
                                            Veuillez saisir une date de naissance valide
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            Région
                                            <input type="text" placeholder="Région" onblur="validRegion()" name="region" id="region" class="form-control">
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
                                            <input type="text" name="ville" onblur="validVille()" id="ville" class="form-control">
                                        </label>
                                        <div class="alert alert-danger" id="alertVille" style="display: none; font-size: 14px">
                                            Ce champ est obligatoire
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            Code Postal
                                            <input type="number" onblur="validCode()" placeholder="Code Postal" name="code" id="code" class="form-control">
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
                                                <option value="Homme">Homme</option>
                                                <option value="Femme">Femme</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            Diplôme
                                            <input type="text" placeholder="Diplôme" onblur="validDiplome()" name="diplome" id="diplome" class="form-control">
                                        </label>
                                        <div class="alert alert-danger" id="alertDiplome" style="display: none; font-size: 14px">
                                            Ce champ est obligatoire
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <script src="js/livreur.js"></script>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                <button type="submit" name="submit" id="ajoutLivreur" onclick="verifierLivreur(event)" class="btn btn-success">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            if($emailExist)
            {
                echo ' <div class="alert alert-danger">Email déjà utilisé</div>';
            }
            if($cinExist)
            {
                echo '<div class="alert alert-danger">Cin déjà utilisé</div>';
            }
            ?>



        </div>

        <div class="row" style="margin-top: 40px">
            <table class="table">
                <thead>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Date naissance</th>
                <th>Date Début contrat</th>
                <th>Date fin Contrat</th>
                <?php
                if($role == 16)
                    echo '
                         <th>Supprimer</th>
                    ';
                ?>

                </thead>
                <tbody>
                <?php
                if($tabSearch)
                    {
                        foreach ($tabSearch as $row)
                        {
                            echo'
                            <tr>
                                <td>'.$row["nom"].'</td>
                                <td>'.$row["prenom"].'</td>
                                <td>'.$row["email"].'</td>
                                <td>'.$row["date_nais"].'</td>
                                <td>'.$row["dateDebutContrat"].'</td>
                                <td>'.$row["dateFinContrat"].'</td>
                                ';
                            if($role == 16)
                            {
                                echo'
                                        <td>
                                            <a href="Technicien.php?delete=true&id='.$row['id'].'" class="btn btn-danger"> <i class="fa fa-trash"></i></a>
                                            <a class="btn btn-warning" href="modifierEmployer.php?id='.$row['id'].'">
                                                    <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                ';
                            }
                            else{
                                echo '
                                        </tr>
                                    ';
                            }

                        }
                    }
                    else{
                        foreach ($clients as $row)
                        {
                            echo'
                            <tr>
                                <td>'.$row["nom"].'</td>
                                <td>'.$row["prenom"].'</td>
                                <td>'.$row["email"].'</td>
                                <td>'.$row["date_nais"].'</td>
                                <td>'.$row["dateDebutContrat"].'</td>
                                <td>'.$row["dateFinContrat"].'</td>
                                ';
                            if($role == 16)
                            {
                                echo'
                                        <td>
                                            <a href="Technicien.php?delete=true&id='.$row['id'].'" class="btn btn-danger"> <i class="fa fa-trash"></i></a>
                                            <a class="btn btn-warning" href="modifierEmployer.php?id='.$row['id'].'">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                ';
                            }
                            else{
                                echo '
                                        </tr>
                                    ';
                            }

                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include_once ('footerAdmin.php');
?>
