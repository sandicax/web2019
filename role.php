<?php
include_once('headerAdmin.php');
include_once('../cores/RoleC.php');
if($role != 15 && $role !=14)
    echo "<script>window.open('adminHome.php','_self')</script>";
$service = new RoleC();
$clients = $service->getRole();
?>

<?php
$nomserch=null;
$salaire=0;
$description=null;
$nom=null;
$service = new RoleC();
if(isset($_POST['submit']))
{

    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $salaire = $_POST['salaire'];

    $role = new Role();
     $role->setDescription($description);
     $role->setNom($nom);
     $role->setSalaire($salaire);





        $service->creerRole($role);

}
$row=$service->getRole();
$tabSearch = null;

if(isset($_GET['chercher']))
{
    $nomserch = $_GET['keyword'];
    $tabSearch = $service->chercherRole($nomserch);
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
            <h3 class="text-center" style="font-weight: 600">Roles</h3>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Chercher...">
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
                <a href="role.php" class="btn"><i class="fa fa-refresh"></i></a>
            </div>
            <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" method="post">
                            <div class="modal-header">
                                <h4 class="modal-title" style="font-weight: 600; text-align: center" id="exampleModalLabel">Ajouter un nouveau role</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            Nom
                                            <input type="text"  name="nom" id="nom" placeholder="Nom" class="form-control">
                                        </label>
                                        <div class="alert alert-danger" id="alertNom" style="display: none; font-size: 14px">
                                            Ce champ est obligatoire
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            Description
                                            <input type="text" style="height: 200px" name="description" id="description" placeholder="Description" class="form-control">
                                        </label>
                                        <div class="alert alert-danger" id="alertPrenom" style="display: none; font-size: 14px">
                                            Ce champ est obligatoire
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: 600">
                                            Salaire
                                            <input type="text"  placeholder="Salaire" name="salaire" id="salaire" class="form-control">
                                        </label>
                                        <div class="alert alert-danger" id="alertEmail" style="display: none; font-size: 14px">
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




        </div>

        <div class="row" style="margin-top: 40px">
            <table class="table">
                <thead>
                <th>Nom</th>
                <th>Description</th>
                <th>Salaire</th>


                </thead>
                <tbody>
                <?php

                if($tabSearch)
                {
                    foreach ($tabSearch as $row)
                    {
                        echo'
                            <tr>
                                <td>'.$row['nom'].'</td>
                                <td>'.$row['description'].'</td>
                                <td>'.$row['salaire'].'</td>
                                <td><a href="role.php?delete=true&id='.$row['id'].'" class="btn btn-danger"> <i class="fa fa-trash"></i></a>
                                     <a class="btn btn-warning" href="role.php?id='.$row['id'].'">
                                        <i class="fa fa-edit"></i>
                                    </a>';

                        if($row['enabled'] == "1")
                            echo'
                                    <a class="btn btn-danger" href="administrateur.php?block=true&id='.$row['id'].'">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </a>
                                </td>
                            </tr>
                                ';
                        else
                            echo'
                                    <a class="btn btn-success" href="administrateur.php?unblock=true&id='.$row['id'].'">
                                        <i class="fa fa-exclamation-circle"></i>
                                    </a>
                                </td>
                            </tr>
                                ';


                    }
                }
                else{
                    foreach ($clients as $row)
                    {
                        echo'
                            <tr>
                                <td>'.$row["nom"].'</td>
                                <td>'.$row["description"].'</td>
                                <td>'.$row["salaire"].'</td>
                                
                                
                                <td>
                                    <a class="btn btn-warning" href="modifierRole.php?id='.$row['id'].'">
                                        <i class="fa fa-edit"></i>
                                    </a>';


                            echo'
                                </td>
                            </tr>
                                ';

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
