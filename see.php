<?php 
    require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    
    <?php
        if(isset($_GET['id']) && !empty(trim($_GET['id']))) {
            $nom = $prenom = $email = "";
            $query = "SELECT * FROM user WHERE id = ?";

            if($stmt = mysqli_prepare($link, $query)) {
                mysqli_stmt_bind_param($stmt, "i", $param_id);

                $param_id = trim($_GET['id']);
                
                if(mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);

                    if(mysqli_num_rows($result) == 1) {
                        $ligne = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        $nom = $ligne['name'];
                        $prenom = $ligne['firstName'];
                        $email = $ligne['email'];

                    } else {
                        header("Location: error.php");
                        exit();
                    }

                } else {
                    header("Location: error.php");
                    exit();
                }

            } else {
                header("Location: error.php");
                exit();
            }

        } else {
            header("Location: error.php");
            exit();
        }
    ?>

    <div class="wrapper bg-secondary border border-info">
        <div class="container-fluid">
            <div class="entete">
                <h1>Etudiant Selectioné</h1>
            </div>

            <div>
                <label for="nom">nom</label>
                <p><?= $nom; ?></p>
            </div>

            <div>
                <label for="prenom">prenom</label>
                <p><?= $prenom; ?></p>
            </div>

            <div>
                <label for="email">email</label>
                <p><?= $email; ?></p>
            </div>
            <div style="margin-bottom: 10px;">
                <a href="index.php" class="btn btn-dark">voir tout les Etudiants</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>