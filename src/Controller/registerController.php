<?php

    namespace EasyGame\Controller;
    use EasyGame\model\FonctionsBd;

    class registerController
    {
        public function nouveauCompte()
        {
            $userName = filter_input(INPUT_POST,'userName',FILTER_SANITIZE_SPECIAL_CHARS);
            $lastName = filter_input(INPUT_POST,'lastName',FILTER_SANITIZE_SPECIAL_CHARS);
            $firstName = filter_input(INPUT_POST,'firstName',FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST,'password2',FILTER_SANITIZE_SPECIAL_CHARS);
            $submit = filter_input(INPUT_POST,'submit',FILTER_SANITIZE_SPECIAL_CHARS);

            if ($submit == "Valider")
            {
                if ($userName != "")
                {

                }
            }
            else if($submit == "Annuler")
            {
                header("location: http://easygame/");
                exit();
            }

            require "../src/view/register.php";
        }
    }
?>