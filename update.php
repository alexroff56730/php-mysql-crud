<?php 
    require_once "config.php";

    if(isset($_GET['id']) && !empty(trim($_GET['id']))) {
        $nom = $prenom = $email = "";
        $query = "SELECT * FROM user WHERE id=?";

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

        if(isset($_POST['update'])) {
            if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])) {
                $sql = "UPDATE user SET name = ?, firstName = ?, email = ? WHERE id = ?";
                
                if($data = mysqli_prepare($link, $sql)) {
                    mysqli_stmt_bind_param($data, "sssi", $newName, $newFname, $newEmail, $idChange);

                    $newName = trim(htmlspecialchars($_POST['nom']));
                    $newFname = trim(htmlspecialchars($_POST['prenom']));
                    $newEmail = trim(htmlspecialchars($_POST['email']));
                    $idChange = trim($_GET['id']);

                    mysqli_stmt_execute($data);
                    header("Location: index.php");
                }
            }
        }
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification donnée etudiant</title>
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
            <div class="entete">
                <h1>Modification donnée etudiant</h1>
            </div>

            <div>
                <form method="post">
                    <div class="d-flex flex-column">
                        <label for="nom">nom</label>
                        <input type="text" value=<?php if(!empty($nom)){ echo $nom; } ?> name="nom" id="">
                    </div>
                    <div class="d-flex flex-column">
                        <label for="prenom">prenom</label>
                        <input type="text" value=<?php if(!empty($prenom)){ echo $prenom; } ?> name="prenom" id="">
                    </div>
                    <div class="d-flex flex-column">
                        <label for="email">email</label>
                        <input type="email" value=<?php if(!empty($email)){ echo $email; } ?> name="email" id="">
                    </div>
                    <input type="submit" class="btn btn-dark" name="update" value="modifier">
                </form>
            </div>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>