<?php 
    require_once "config.php";

    if(isset($_GET['id']) && !empty(trim($_GET['id']))) {
        $nom = $prenom = $email = "";
        $query = "DELETE FROM user WHERE id = ?";

        if($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = trim($_GET['id']);

            mysqli_stmt_execute($stmt);
            header("Location: index.php");
        }
    }
?>