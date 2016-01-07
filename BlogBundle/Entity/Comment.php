<?php
/**
 * Created by PhpStorm.
 * User: moi
 * Date: 03/01/2016
 * Time: 19:39
 */
namespace CarnetApp\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="carnet2voyage__blogComment")
 */
class Comment
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
     * @ORM\Column(type="string", length=190)
     */
    protected $authorName;
    /**
     * @ORM\Column(type="string", length=190,nullable=true)
     */
    protected $authorMail;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contenu;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $publied;
    /**
     * @var arcticle
     *
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="arcticle_id", referencedColumnName="id", nullable=false)
     */
    protected $arcticle;
    /**
     * @var $reply
     *
     * @ORM\ManyToOne(targetEntity="Comment")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    protected $reply;

    public function __construct()
    {
        $this->created = new \DateTime();
    }
    public function __toString()
    {
        return $this->authorName;
    }

    /**
     * @return arcticle
     */
    public function getArcticle()
    {
        return $this->arcticle;
    }

    /**
     * @param arcticle $arcticle
     */
    public function setArcticle($arcticle)
    {
        $this->arcticle = $arcticle;
    }

    /**
     * @return mixed
     */
    public function getReply()
    {
        return $this->reply;
    }

    /**
     * @param mixed $reply
     */
    public function setReply($reply)
    {
        $this->reply = $reply;
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
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param mixed $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * @return mixed
     */
    public function getAuthorMail()
    {
        return $this->authorMail;
    }

    /**
     * @param mixed $authorMail
     */
    public function setAuthorMail($authorMail)
    {
        $this->authorMail = $authorMail;
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
    public function getPublied()
    {
        return $this->publied;
    }

    /**
     * @param mixed $publied
     */
    public function setPublied($publied)
    {
        $this->publied = $publied;
    }

}
