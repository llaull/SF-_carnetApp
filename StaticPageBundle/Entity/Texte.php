<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 20/12/2015
 * Time: 21:31
 */

namespace CarnetApp\StaticPageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="carnet2voyage__generalTexte")
 */
class Texte
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
    protected $useInMenu;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $ordre;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->modified = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * @param mixed $ordre
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
    }

    /**
     * @return mixed
     */
    public function getUseInMenu()
    {
        return $this->useInMenu;
    }

    /**
     * @param mixed $useInMenu
     */
    public function setUseInMenu($useInMenu)
    {
        $this->useInMenu = $useInMenu;
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
     * @return datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param datetime $created
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


}
