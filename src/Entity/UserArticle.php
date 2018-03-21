<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserArticleRepository")
 */
class UserArticle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users",inversedBy="usersArticle")
     */
    private $users;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article",mappedBy="users")
     */
    private $article;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article",inversedBy="usersArticle")
     */
    private $article2;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commentaire",inversedBy="usersArticle")
     */
    private $commentaire;
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
    public function getArticle()
    {
        return $this->article;
    }
    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }
    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }
    /**
     * @return mixed
     */
    public function getArticle2()
    {
        return $this->article2;
    }
    /**
     * @param mixed $article2
     */
    public function setArticle2($article2)
    {
        $this->article2 = $article2;
    }
}