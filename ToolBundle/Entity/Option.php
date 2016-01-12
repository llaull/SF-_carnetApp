<?php
/**
 * Created by PhpStorm.
 * User: moi
 * Date: 03/01/2016
 * Time: 19:39
 */
namespace CarnetApp\ToolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="carnet2voyage__generalOption")
 */
class Option
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     * @var datetime $modified
     *
     * @ORM\Column(type="datetime")
     */
    protected $modified;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $blogActived;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $blogCommentActived;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $siteActived;

    public function __construct()
    {
        $this->modified = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getSiteActived()
    {
        return $this->siteActived;
    }

    /**
     * @param mixed $siteActived
     */
    public function setSiteActived($siteActived)
    {
        $this->siteActived = $siteActived;
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
    public function getBlogActived()
    {
        return $this->blogActived;
    }

    /**
     * @param mixed $blogActived
     */
    public function setBlogActived($blogActived)
    {
        $this->blogActived = $blogActived;
    }

    /**
     * @return mixed
     */
    public function getBlogCommentActived()
    {
        return $this->blogCommentActived;
    }

    /**
     * @param mixed $blogCommentActived
     */
    public function setBlogCommentActived($blogCommentActived)
    {
        $this->blogCommentActived = $blogCommentActived;
    }
}
