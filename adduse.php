<?php 
    require_once "config.php";

    if(isset($_POST['send'])) {
        $nom = trim(stripslashes(htmlspecialchars($_POST['nom'])));
        $prenom = trim(stripslashes(htmlspecialchars($_POST['prenom'])));
        $email = trim(stripslashes(htmlspecialchars($_POST['email'])));

        if(!empty($nom) && !empty($prenom) && !empty(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            $sql = "INSERT INTO user (name, firstName, email) VALUES (?, ?, ?)";

            if($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "sss", $nomInsert, $prenomInsert, $emailInsert);
                
                $nomInsert = $nom;
                $prenomInsert = $prenom;
                $emailInsert = $email;

                mysqli_stmt_execute($stmt);

                echo 'donnée inserer avec succes.' . "<br>";
            } else {
                echo "ERREUR Impossible d'executer la requete $sql . " . mysqli_error($link);
            }
        } 
        
        header('Location: https://127.0.0.1/bootstrap-php-project/index.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">7
    <style>
        form {
            width: 693px;
            margin: auto;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            margin-top: 10%;
            padding: 30px;
        }
    </style>
</head>
<body class="bg-dark">
    <form method="post" class="bg-secondary">
        <h1>Ajouter un étudiant</h1>
        <div class="d-flex flex-column">
            <label for="nom">nom</label>
            <input type="text" name="nom" id="">
        </div>
        <div class="d-flex flex-column">
            <label for="prenom">prenom</label>
            <input type="text" name="prenom" id="">
        </div>
        <div class="d-flex flex-column">
            <label for="email">email</label>
            <input type="email" name="email" id="">
        </div>
        <input class="btn btn-dark" type="submit" name="send" value="ajouter un étudiant">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>