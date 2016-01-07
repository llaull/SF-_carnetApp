<?php
/**
 * Created by PhpStorm.
 * User: moi
 * Date: 03/01/2016
 * Time: 19:39
 */
namespace CarnetApp\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="carnet2voyage__blogArticle")
 * @ORM\Entity(repositoryClass="CarnetsBundle\Repository\BlogRepository")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     * @var datetime $created
     *
     * @ORM\Column(type="datetime")
     */
    protected $created;
    /**
     * @var datetime $modified
     *
     * @ORM\Column(type="datetime")
     */
    protected $modified;
    /**
     * @var datetime $publied
     *
     * @ORM\Column(type="datetime")
     */
    protected $publied;
    /**
     * @ORM\Column(type="string", length=90)
     */
    protected $title;
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=90, unique=true)
     * @Gedmo\Slug(fields={"title"}, unique=true)
     */
    protected $slug;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contenu;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $actived;
    /**
     * @var category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    protected $category;

    /**
     * @var \Commun\UserBundle\Entity\user
     *
     * @ORM\ManyToOne(targetEntity="Commun\UserBundle\Entity\user")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="autor_id", referencedColumnName="id")
     * })
     */
    protected $autor;
    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default":"http://placehold.it/600x600"}))
     *
     */
    protected $image;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->created = new \DateTime();
        $this->modified = new \DateTime();
        $this->publied = new \DateTime();
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
     * @return \Commun\UserBundle\Entity\user
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param \Commun\UserBundle\Entity\user $autor
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function __toString()
    {
        return $this->title;
    }
    /**
     * @return category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return datetime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param datetime $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    /**
     * @return datetime
     */
    public function getPublied()
    {
        return $this->publied;
    }

    /**
     * @param datetime $publied
     */
    public function setPublied($publied)
    {
        $this->publied = $publied;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
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
    public function getActived()
    {
        return $this->actived;
    }

    /**
     * @param mixed $actived
     */
    public function setActived($actived)
    {
        $this->actived = $actived;
    }

}
