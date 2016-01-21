<?php
/* run
*  php app/console doctrine:schema:update --force
*  php app/console doctrine:generate:entities AlertBundle/Entity/
*  php app/console generate:doctrine:crud
// $this->date = new \DateTime();
*/

namespace CarnetApp\CarnetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
* @ORM\Entity
* @ORM\Table(name="carnet2voyage__page")
* @ORM\Entity(repositoryClass="CarnetApp\CarnetBundle\Repository\PageRepository")
*/
class Page
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
     * @ORM\Column(type="string", length=90)
     */
    protected $titre;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contenu;
    /**
     * @ORM\Column(type="string",length=200, nullable=true)
     */
    protected $image;
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50, unique=false)
     * @Gedmo\Slug(fields={"titre"}, unique=false)
     */
    protected $slug;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $ordre;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $carnet;
    /**
     * @var LieuPage
     *
     * @ORM\ManyToOne(targetEntity="Lieu")
     * @ORM\JoinColumn(name="lieu_id", referencedColumnName="id", nullable=false)
     */
    private $lieu;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    public function __toString()
    {
        return $this->titre;
    }

    /**
     * @return mixed
     */
    public function getCarnet()
    {
        return $this->carnet;
    }

    /**
     * @param mixed $carnet
     */
    public function setCarnet($carnet)
    {
        $this->carnet = $carnet;
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Page
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Page
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Page
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return \CarnetApp\CarnetBundle\Entity\Lieu
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set lieu
     *
     * @param \CarnetApp\CarnetBundle\Entity\Lieu $lieu
     *
     * @return Page
     */
    public function setLieu(\CarnetApp\CarnetBundle\Entity\Lieu $lieu = null)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Page
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Page
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
