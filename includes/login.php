<?php

    if(isset($_POST['formlogin']))
    {
        extract($_POST);

        if(!empty($idmail) && !empty($mdp))
        {
            $q = $db->prepare("SELECT * FROM users WHERE email = :email");
            $q->execute(['email' => $lemail]);
            $result = $q->fetch();

            if($result == true){
                // Le compte existe
                $hashpassword = $result['password'];
                if(password_verify($lpassword, $hashpassword)){
                    echo "Vous venez de vous connecter avec l'adresse mail : ".$lemail." !";
                    $_SESSION['email'] = $result['email'];
                    $_SESSION['pseudo'] = $result['pseudo'];
                    $_SESSION['name'] = $result['name'];
                    $_SESSION['date'] = $result['date'];
                    setcookie('pseudo', $lemail, time() + (30*24*3600));
                }else{
                    echo "Mot de passe incorrecte";
                }
            }else{
                echo "Aucun compte n'a été créé avec l'adresse mail : ".$lemail." ...";
            }
        }
    }

?>