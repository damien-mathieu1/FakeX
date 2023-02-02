<?php

namespace App\Fakex\lib;

use App\Fakex\config\Conf;
use App\Fakex\model\DataObject\Utilisateur;
use App\Fakex\model\Repository\UtilisateurRepository;

class VerificationEmail
{
    /**
     * Envoie un email de confirmation à l'utilisateur
     * @param Utilisateur $user
     * @return void
     */
    public static function envoiEmailValidation(Utilisateur $user):void{
        $loginURL = rawurlencode($user->getLogin());
        $nonce = rawurlencode($user->getNonce());
        $absoluteURL = Conf::getAbsoluteURL();
        var_dump($absoluteURL);
        $url = "$absoluteURL?action=validerEmail&controller=utilisateur&login=$loginURL&nonce=$nonce";
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        $msg = "Bonjour, veuillez cliquer sur le lien suivant pour valider votre adresse email : <a href=\"$url\">le lien en question</a>";
        echo $msg;
        mail("doisacaumeiha-9108@yopmail.com","Validation de votre adresse email",$msg,implode("\r\n", $headers));
        (new UtilisateurRepository())->addUtilisateur($user);

        header("Location: https://yopmail.com/?login=doisacaumeiha-9108");
    }

    /**
     * Vérifie si l'utilisateur a bien cliqué sur le lien de validation
     * @param string $login
     * @param string $nonce
     * @return void
     */
    public static function traiterEmailValidation(){
        $login =$_GET['login'];
        $nonce = $_GET['nonce'];
        $user = (new UtilisateurRepository())->getUser($login);
        if($user->getNonce() == $nonce){
            $user->setEmail($user->getEmailToValidate());
            return true;
        }
        return false;
    }
}