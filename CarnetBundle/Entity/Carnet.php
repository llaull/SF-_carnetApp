<?php

namespace CarnetApp\CarnetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="carnet2voyage__carnets")
 * @ORM\Entity(repositoryClass="CarnetApp\CarnetBundle\Repository\CarnetRepository")
 */

class Carnet
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
     * @var datetime $depart
     *
     * @ORM\Column(type="datetime")
     */
    protected $depart;
    /**
     * @ORM\Column(type="string", length=19, nullable=false)
     */
    protected $title;
    /**
     * @ORM\Column(type="string", length=90,nullable=true)
     */
    protected $description;
    /**
     * @ORM\Column(type="string", length=90,nullable=true)
     */
    protected $destination;
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50, unique=true)
     * @Gedmo\Slug(fields={"title"}, unique=true)
     */
    protected $slug;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contenu;
    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default":"http://placehold.it/600x600"}))
     *
     */
    protected $imageAccueil;
    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default":"http://placehold.it/600x600"}))
     *
     */
    protected $imageHeader;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $actived;


    public function __construct()
    {
        $this->created = new \DateTime();
        $this->depart = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getImageAccueil()
    {
        return $this->imageAccueil;
    }

    /**
     * @param mixed $imageAccueil
     */
    public function setImageAccueil($imageAccueil)
    {
        $this->imageAccueil = $imageAccueil;
    }

    public function __toString()
    {
        return $this->title;
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
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
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
    public function getImageHeader()
    {
        return $this->imageHeader;
    }

    /**
     * @param mixed $imageHeader
     */
    public function setImageHeader($imageHeader)
    {
        $this->imageHeader = $imageHeader;
    }

    /**
     * @return datetime
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * @param datetime $depart
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;
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
