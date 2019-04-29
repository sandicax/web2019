<?php
    include_once('headerAdmin.php');
    $service = new UserC();
    $clients = $service->getClients();

    if(isset($_GET["delete"]))
    {
        if($_GET["delete"] == "true" && ($role == 16))
        {
            $id = $_GET["id"];
            $service->deleteUser($id);
            echo "<script>window.open('clients.php','_self')</script>";
        }
    }

    if(isset($_GET["block"]))
    {
        if($_GET["block"] == "true" && ($role == 16))
        {
            $id = $_GET["id"];
            $service->blockUser($id);
            echo "<script>window.open('clients.php','_self')</script>";
        }
    }

    if(isset($_GET["unblock"]))
    {
        if($_GET["unblock"] == "true" && ($role == 16))
        {
            $id = $_GET["id"];
            $service->unBlockUser($id);
            echo "<script>window.open('clients.php','_self')</script>";
        }
    }
?>
<div class="content">
    <div class="jumbotron" style="padding: 1rem 2rem">
        <h3 class="text-center" style="font-weight: 600">Clients</h3>
    </div>
    <table class="table">
        <thead>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Nom d'utilisateur</th>
            <th>Cin</th>
            <th>Région</th>
            <th>Ville</th>
            <th>Numéro</th>

            <?php
                if($role == 16)
                    echo '<th>Action</th>';
            ?>

        </thead>
        <tbody>
<?php
    foreach ($clients as $row)
    {
        echo'
            <tr>
                <td>'.$row["nom"].'</td>
                <td>'.$row["prenom"].'</td>
                <td>'.$row["username"].'</td>
                <td>'.$row["cin"].'</td>
                <td>'.$row["region"].'</td>
                <td>'.$row["ville"].'</td>
                <td>'.$row["numero"].'</td>';

            if($role ==16)
            {

        echo'
                <td>
                    <a href="clients.php?delete=true&id='.$row["id"].'" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    ';
                    if($row['enabled'] == "1")
                        echo'<a href="clients.php?block=true&id='.$row["id"].'" class="btn btn-warning"><i class="fa fa-exclamation-triangle"></i></a>';
                    else
                        echo '<a href="clients.php?unblock=true&id='.$row["id"].'" class="btn btn-success"><i class="fa fa-exclamation-circle"></i></a>';

                    echo '</td>
            </tr>
        ';

    }
    }
?>


        </tbody>
    </table>
</div>
<?php
    include_once('footerAdmin.php');
?>
