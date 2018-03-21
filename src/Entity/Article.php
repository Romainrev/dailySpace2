<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     *
     * @ORM\Column(type="string",length=255)
     */
    private $titre;
    /**
     *
     * @ORM\Column(type="text")
     */
    private $contenu;
    /**
     *
     * @ORM\Column(type="boolean")
     */
    private $spotlight;
    /**
     *
     * @ORM\Column(type="string",length=45)
     */
    private $image;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserArticle",inversedBy="article")
     */
    private $users;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserArticle",mappedBy="article2")
     */
    private $usersArticle;
    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }
    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
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
    public function getSpotlight()
    {
        return $this->spotlight;
    }
    /**
     * @param mixed $spotlight
     */
    public function setSpotlight($spotlight)
    {
        $this->spotlight = $spotlight;
    }
    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }
    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }
    /**
     * @return mixed
     */
    public function getUsersArticle()
    {
        return $this->usersArticle;
    }
    /**
     * @param mixed $usersArticle
     */
    public function setUsersArticle($usersArticle)
    {
        $this->usersArticle = $usersArticle;
    }
}