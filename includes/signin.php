<?php
        
if(isset($_POST['signin'])){
    extract($_POST);

    if(!empty($prenom) && !empty($nom)  && !empty($date_naissance) && !empty($adresse)  && !empty($num) && !empty($mail) && !empty($mdp) && !empty($mdp2)){

        if($mdp == $mdp2){
            $options = [
                'cost' => 12,
            ];
            $hashmdp = password_hash($mdp, PASSWORD_BCRYPT, $options);
        
            $verif_mail = $db->prepare("SELECT mail FROM clients WHERE mail = :mail");
            $verif_mail->execute(['mail' => $mail]);
            $verif_mail_result = $verif_mail->rowCount();
        

        
        if ($verif_mail_result == 0){
            
                    if($query = $db->prepare("INSERT INTO clients(nom,prenom,adresse,mail,num,naissance,mdp) 
                    VALUES(:nom,:prenom,:adresse,:mail,:num,:naissance,:mdp)")){
                
                $query->execute([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'adresse' => $adresse,
                    'mail' => $mail,
                    'num' => $num,
                    'naissance'=>$date_naissance,
                    'mdp' => $hashmdp
                
                ]);
                    }
                    else echo("Statement failed: ". $query->error . "<br>");
            echo "Le compte a été créé </br>";
            
            echo "votre prénom : ". $prenom . "<br/>";
        echo "votre email : ".$mail. "<br/>";
            
            
        } else {
            echo "L'email appartient déjà à un compte...";
        }

        } else {
            echo "Les deux mots de passe ne sont pas identiques";
        }                
    } else {
        echo "Les champs ne sont pas tous remplis";
    }
}

if(isset($_POST['modify'])){
    extract($_POST);

    if(!empty($prenom) && !empty($nom)  && !empty($date_naissance) && !empty($adresse)  && !empty($num) && !empty($mdp) && !empty($mdp2)){
        $verif_password = $db->prepare("SELECT mdp FROM clients WHERE mail = :mail");
        $verif_password->execute(['mail' => $mail]);
        if(password_verify($mdp2, $verif_password['mdp'])){
       

                if($query = $db->prepare("UPDATE clients SET nom=:nom, prenom=:prenom, adresse=:adresse, num=:num, naissance=:naissance, mdp=:mdp WHERE mail=:mail")){
                    $query->execute([
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'adresse' => $adresse,
                        'num' => $num,
                        'naissance'=>$date_naissance,
                        'mdp' => $hashmdp
                    ]);
                }
                else echo("Statement failed: ". $query->error . "<br>");
                echo "Les informations du compte ont été mises à jour </br>";
                echo "votre prénom : ". $prenom . "<br/>";
                echo "votre email : ".$mail. "<br/>";


        } else {
            echo "Le mot de passe actuel est incorect";
        }                
    } else {
        echo "Les champs ne sont pas tous remplis";
    }
}
