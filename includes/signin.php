<?php
        
if(isset($_POST['formsend'])){
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
            if ($verif_pseudo_result ==0){
                    if($query = $db->prepare("INSERT INTO clients(nom,prenom,adresse,mail,num,naissance,mdp) 
                    VALUES(:nom,:prenom,:adresse,:mail,:num,:naissance,:mdp)")){
                
                $query->execute([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'pseudo' => $pseudo,
                    'mail' => $mail,
                    'mdp' => $hashmdp,
                    'naissance'=>$date_naissance
                ]);
                    }
                    else echo("Statement failed: ". $query->error . "<br>");
            echo "Le compte a été créé </br>";
            
            echo "votre prénom : ". $prenom . "<br/>";
        echo "votre email : ".$mail. "<br/>";
            } else {
                echo "Le pseudo appartient déjà à un compte...";
            }
            
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

?>