<?php
    namespace EasyGame\Controller;
    use EasyGame\model\FonctionsBD;
    use PDOException;

    class RegisterController
    {
        /**
         * Crée un nouveau Compte
         * @return void
         * @author Flavio Soares Rodrigues
         */
        public function nouveauCompte()
        {
            // Permet d'utilisé les fonctions contenu dans la classe FonctionsBD
            $fonctionsBD = new FonctionsBD();

            // Filtre les inputs
            $userName = filter_input(INPUT_POST,'userName',FILTER_SANITIZE_SPECIAL_CHARS);
            $lastName = filter_input(INPUT_POST,'lastName',FILTER_SANITIZE_SPECIAL_CHARS);
            $firstName = filter_input(INPUT_POST,'firstName',FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST,'password2',FILTER_SANITIZE_SPECIAL_CHARS);
            $submit = filter_input(INPUT_POST,'submit',FILTER_SANITIZE_SPECIAL_CHARS);

            $message = "";

            // Si le boutton "Valider" est pressé
            if ($submit == "Valider")
            {
                // Si tout les champs sont remplis
                if ($userName != "" && $lastName != "" && $firstName != "" && $email != "" && $password != "" && $password2 != "")
                {
                    // Si le mot de passe est identique à celui de confirmation
                    if ($password == $password2)
                    {
                        // Hash le mot de passe
                        $passwordHash = password_hash($password, PASSWORD_BCRYPT);;

                        // Ajoute un nouvel utilisateur dans la base de données
                        try
                        {
                            $fonctionsBD->newUser($userName, $lastName, $firstName, $email, $passwordHash);

                            header("location: /");
                            exit();
                        }
                        catch (PDOException $e)
                        {
                            if(strpos($e->getMessage(), 'email'))
                            {
                                $message = "email déjà existant";
                            }
                            else if (strpos($e->getMessage(), 'pseudo'))
                            {
                                $message = "nom d'utilisateur déjà existant";
                            }
                        }
                    }
                    else
                    {
                        $message = "Ces mots de passe ne correspondent pas. Veuillez réessayer.";
                    }
                }
                else
                {
                    $message = "Veuillez Remplir tout les champs";
                }
            }
            else if($submit == "Annuler")
            {
                header("location: /");
                exit();
            }
            require "../src/view/register.php";
        }
    }