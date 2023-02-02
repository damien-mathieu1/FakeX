<?php
namespace App\Fakex\model\DataObject;
/**
 * Cette classe simule un object Utilisateur
 *
 *
 */
class Utilisateur
{
    public int $createur;
    public string $nom;
    public string $prenom;
    public string $login;
    public string $password;
    public string $email;
    private string $nonce;
    private string $emailToValidate;
    public int $idUtilisateur;

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return int
     */
    public function getCreator(): int
    {
        return $this->createur;
    }

    /**
     * @return int
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string{
        return $this->password;
    }

    public function getEmail(): string  {
        return $this->email;
    }

    public function getIdUtilisateur(): int{
        return $this->idUtilisateur;
    }

    /**
     * @return string
     */
    public function getNonce(): string
    {
        return $this->nonce;
    }

    /**
     * @param string $nonce
     */
    public function setNonce(string $nonce): void
    {
        $this->nonce = $nonce;
    }

    /**
     * @return string
     */
    public function getEmailToValidate(): string
    {
        return $this->emailToValidate;
    }

    /**
     * @param string $emailToValidate
     */
    public function setEmailToValidate(string $emailToValidate): void
    {
        $this->emailToValidate = $emailToValidate;
    }

    /**
     * @param int $createur
     */
    public function setCreateur(int $createur): void
    {
        $this->createur = $createur;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param int $idUtilisateur
     */
    public function setIdUtilisateur(int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }




    public function __construct($createur,$nom,$prenom,$login,$password,$email,$mailToValidate,$nonce){
        $this->createur = $createur;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->emailToValidate = $mailToValidate;
        $this->nonce = $nonce;
    }
}
?>