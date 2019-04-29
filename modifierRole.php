<?php
include_once('headerAdmin.php');
include_once('../cores/RoleC.php');
$service = new RoleC();
    if(isset($_GET['id']))
    {
        $role= $service->getRoleById($_GET['id']);
        //var_dump($role);
    }

    else
      echo "<script>window.open('role.php','_self')</script>";
?>

<?php
$nom=null;
$description=null;
$salaire=null;
if(isset($_POST['submit']))
{
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $salaire = $_POST['salaire'];
    $id=$_GET['id'];

    $rol = new Role();
    $rol->setNom($nom);
    $rol->setDescription($description);
    $rol->setSalaire($salaire);

    $service = new RoleC();
   $service->updateRole($rol,$id);
    echo "<script>window.open('role.php','_self')</script>";
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
            <h3 class="text-center" style="font-weight: 600">Role</h3>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <label for="" style="font-weight: 600">
                        Nom
                        <input type="text" value="<?php echo $role['nom'] ?>"  name="nom" id="nom" placeholder="Nom" class="form-control">
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
                          <input type="text" name="description" value="<?php echo $role['description'] ?>" id="description"  placeholder="Description" class="form-control">
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
                        <input type="text" name="salaire" value="<?php echo $role['salaire'] ?>" id="salaire"  placeholder="Salaire" class="form-control">
                    </label>
                    <div class="alert alert-danger" id="alertPrenom" style="display: none; font-size: 14px">
                        Ce champ est obligatoire
                    </div>
                </div>
            </div>
            <script src="js/professeur.js"></script>
                <button type="submit" name="submit" id="modifierRole"  class="btn btn-success">Enregistrer</button>
        </form>
    </div>
</div>


<?php
include_once ('footerAdmin.php');
?>
