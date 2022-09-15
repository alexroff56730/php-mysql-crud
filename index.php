<?php 
    require_once 'config.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>details etudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        .wrapper {
            width: 740px;
            margin: 0 auto;
            border: 1px solid white;
            margin-top: 10%;
        }

        .entete {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

    </style>
  </head>
  <body class="bg-dark">
    <div class="wrapper bg-secondary">
        <div class="container-fluid">
            <div class=entete>
                <h1>Details Etudiant</h1>
                <form>
                    <a href='adduse.php' class="btn btn-dark text-uppercase">Ajouter Etudiant</a>
                </form>
            </div>

            <div>
                <?php 
                    $requete = "SELECT * FROM user";

                    if($result = mysqli_query($link, $requete)) {
                        if(mysqli_num_rows($result) > 0) {
                            echo "<table style='text-align: center; border: 1px solid whitesmoke; margin: 10px;'>";
                                echo "<thead style='border: 1px solid whitesmoke;'>";
                                    echo "<tr>";
                                        echo "<th style='border: 1px solid whitesmoke;'>ID</th>";
                                        echo "<th style='border: 1px solid whitesmoke;'>NAME</th>";
                                        echo "<th style='border: 1px solid whitesmoke;'>FIRST NAME</th>";
                                        echo "<th style='border: 1px solid whitesmoke;'>EMAIL</th>";
                                        echo "<th style='border: 1px solid whitesmoke;'>ACTION</th>";
                                    echo "</tr>";
                                echo "</thead>";

                                while($ligne = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                        echo "<td style='border: 1px solid whitesmoke;'>" . $ligne['id'] . "</td>";
                                        echo "<td style='border: 1px solid whitesmoke;'>" . $ligne['name'] . "</td>";
                                        echo "<td style='border: 1px solid whitesmoke;'>" . $ligne['firstName'] . "</td>";
                                        echo "<td style='border: 1px solid whitesmoke;'>" . $ligne['email'] . "</td>";
                                        echo "<td style='border: 1px solid whitesmoke;'>";
                                            echo '<a href="see.php?id=' . $ligne['id'] . '" class="btn btn-dark text-uppercase">voir</a>';
                                            echo '<a href="update.php?id=' . $ligne['id'] . '" class="btn btn-dark text-uppercase">modifier</a>';
                                            echo '<a href="delete.php?id=' . $ligne['id'] . '" class="btn btn-dark text-uppercase">supprimer</a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</table>";
                        } else {
                            die("<div class='bg-danger' style='text-align: center; margin-bottom: 10px;'>ERREUR: votre base de donnée est vide." . "</div>");
                        } 
                        
                        mysqli_free_result($result);
                    } else {
                        die("ERREUR: impossible d'établir une connexion ." . mysqli_connect_error());
                    }

                    
                ?>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>
