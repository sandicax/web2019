<?php
include_once('headerAdmin.php');
include_once('../cores/CoursC.php');
$service = new CoursC();
    if(isset($_GET['id']))
    {
        $cours= $service->getcoursById($_GET['id']);
        //var_dump($cours);
    }

    else
      echo "<script>window.open('cours.php','_self')</script>";
?>

<?php
$titre=null;
$description=null;
$file=null;
if(isset($_POST['submit']))
{
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $file = $_POST['file'];
    $id=$_GET['id'];

    $rol = new cours();
    $rol->settitre($titre);
    $rol->setDescription($description);
    $rol->setfile($file);

    $service = new coursC();
   $service->updatecours($rol,$id);
    echo "<script>window.open('cours.php','_self')</script>";
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
            <h3 class="text-center" style="font-weight: 600">cours</h3>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <label for="" style="font-weight: 600">
                        titre
                        <input type="text" value="<?php echo $cours['titre'] ?>"  name="titre" id="titre" placeholder="titre" class="form-control">
                    </label>
                    <div class="alert alert-danger" id="alerttitre" style="display: none; font-size: 14px">
                        Ce champ est obligatoire
                    </div>
                </div>

            </div>
              <div class="row">
                  <div class="col-md-6">
                      <label for="" style="font-weight: 600">
                          Description
                          <input type="text" name="description" value="<?php echo $cours['description'] ?>" id="description"  placeholder="Description" class="form-control">
                      </label>
                      <div class="alert alert-danger" id="alertPretitre" style="display: none; font-size: 14px">
                          Ce champ est obligatoire
                      </div>
                  </div>
              </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="" style="font-weight: 600">
                        file
                        <input type="text" name="file" value="<?php echo $cours['file'] ?>" id="file"  placeholder="file" class="form-control">
                    </label>
                    <div class="alert alert-danger" id="alertPretitre" style="display: none; font-size: 14px">
                        Ce champ est obligatoire
                    </div>
                </div>
            </div>
            <script src="js/professeur.js"></script>
                <button type="submit" name="submit" id="modifiercours"  class="btn btn-success">Enregistrer</button>
        </form>
    </div>
</div>


<?php
include_once ('footerAdmin.php');
?>
