<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string",length=45)
     */
    private $nom;
    /**
     * @ORM\Column(type="string",length=45)
     */
    private $prenom;
    /**
     * @ORM\Column(type="string",length=255,unique=true)
     */
    private $mail;
    /**
     * @ORM\Column(type="string",length=40)
     */
    private $password;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Roles",inversedBy="users")
     */
    private $roles;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserArticle",mappedBy="users")
     */
    private $usersArticle;
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }
    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }
    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }
    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }
    public function setId($id)
    {
        $this->id=$id;
    }
    /**
     * @return mixed
     */
    public function getUsersArticle()
    {
        return $this->usersArticle;
    }
    /**
     * @param mixed $userArticle
     */
    public function setUsersArticle($usersArticle)
    {
        $this->usersArticle = $usersArticle;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
