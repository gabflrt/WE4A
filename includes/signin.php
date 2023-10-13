<?php







        /*
        $q = $db->query("SELECT * FROM users ORDER BY id ASC /*WHERE pseudo = 'AZIZ54'  LIMIT 3");
        while ($user = $q->fetch()) {
                    // méthode PHP 
           // echo "id : " . $user['id'] . " pseudo : " . $user['pseudo'] . "</br>";
            ?>
            <li>
                <a href="profil.php?q= <?= $user['id']; ?>"><?= $user['email']; ?></a>
            </li>

        <?php } */

        if(isset($_POST['formsend'])){

            extract($_POST);

            if(!empty($pseudo) && !empty($email) && !empty($password) && !empty($name)){
                

                if($password == $cpassword){
                    $options = [
                        'cost' => 12,
                    ];
                    $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);
                
                $c = $db->prepare("SELECT email FROM users WHERE email = :email");
                $c->execute(['email' => $email]);
                $cresult = $c->rowCount();
                $d = $db->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
                $d->execute(['pseudo' => $pseudo]);
                $dresult = $d->rowCount();
                $n = $db->prepare("SELECT name FROM users WHERE name = :name");
                $n->execute(['name' => $name]);
                $nresult = $n->rowCount();

                if ($cresult == 0){
                    if ($dresult ==0){
                        $q = $db->prepare("INSERT INTO users(pseudo, name, email,password) VALUES(:pseudo,:name,:email,:password)");
                    $q->execute([
                        'pseudo'=>$pseudo,
                        'name'=>$name,
                        'email'=>$email,
                        'password'=>$hashpass
                    ]);
                    echo "Le compte a été créé </br>";
                    // setcookie('email', $email, time() + (30*24*3600));
                    
                    echo "votre nom : ". $name . "<br/>";
                echo "votre pseudo : ". $pseudo . "<br/>";
                // echo "votre age : ".$age . "<br/>";
                echo "votre email : ".$email. "<br/>";
                    } else {
                        echo "Le pseudo appartient déjà à un compte...";
                    }
                    
                } else {
                    echo "L'email appartient déjà à un compte...";
                }

                } else {
                    echo "Les deux mots de passe ne sont pas identiques";
                }

                // if (password_verify($password, $hashpass)){
                //     echo "le mot de passe est le même";
                // } else { 
                //     echo "le mot de passe n'est pas correcte";
                // }

                
            } else {
                echo "Les champs ne sont pas tous remplis";
            }
            
        }
    ?>