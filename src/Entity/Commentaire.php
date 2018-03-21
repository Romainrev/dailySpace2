<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $contenu;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserArticle",mappedBy="commentaire")
     */
    private $usersArticle;
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id=$id;
    }
    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }
    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
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
}