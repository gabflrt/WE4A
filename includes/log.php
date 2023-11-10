<?php

    if(isset($_POST['formlogin']))
    {
        extract($_POST);

        if(!empty($mail) && !empty($mdp))
        {
            $q = $db->prepare("SELECT * FROM clients WHERE mail = :mail");
            $q->execute(['mail' => $mail]);
            $result = $q->fetch();


            if($result !=0){
                // Le compte existe
                $hashmdp = $result['mdp'];
                if(password_verify($mdp, $hashmdp)){
                    $_SESSION['mail'] = $result['mail'];
                    $_SESSION['prenom'] = $result['prenom'];
                    $_SESSION['nom'] = $result['nom'];
                    $_SESSION['admin'] = $result['admin'];
                    setcookie('mail', $mail, time() + (30*24*3600));
                    header("refresh:0");
                }else{
                    echo "<script type='text/javascript'>alert('Mot de passe incorrecte');</script>";
                }
            }else{
                echo "<script type='text/javascript'>alert('Pas de compte créé avec cette adresse mail')</script>";
            }
        }
    }

?>