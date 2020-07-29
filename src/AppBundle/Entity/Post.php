<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 * 
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="title", type="text")
     */
    private $title;

    /**
     * @var string
     * @Assert\NotNull
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    /**
     * 
     * @var string
     * @ORM\Column(name="plik1", type="text",nullable= TRUE)
     */
    private $plik1;
    /**
     * @var string
     * 
     * @ORM\Column(name="plik2", type="text",nullable= TRUE)
     */
    private $plik2;

    /**
     * @var string
     * 
     * @ORM\Column(name="plik3", type="text",nullable=TRUE)
     */
    private $plik3;


    /**
     * @var int
     * @ORM\Column(name="vision", type="integer")
     */
    private $vision;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    public function setVision($vision)
    {
        $this->vision = $vision;

        return $this;
    }

    /**
     * Get vision
     *
     * @return string
     */
    public function getVision()
    {
        return $this->vision;
    }

    /**
     * Set plik1
     *
     * @param string $plik1
     *
     * @return Post
     */
    public function setPlik1($plik1)
    {
        $this->plik1 = $plik1;

        return $this;
    }
    /**
     * Get plik1
     *
     * @return string
     */
    public function getPlik1()
    {
        return $this->plik1;
    }

    /**
     * Set plik2
     *
     * @param string $plik2
     *
     * @return Post
     */
    public function setPlik2($plik2)
    {
        $this->plik2 = $plik2;

        return $this;
    }
    /**
     * Get plik2
     *
     * @return string
     */
    public function getPlik2()
    {
        return $this->plik2;
    } 

    /**
    * Set plik3
    *
    * @param string $plik3
    *
    * @return Post
    */
   public function setPlik3($plik3)
   {
       $this->plik3 = $plik3;

       return $this;
   }

   /**
    * Get plik3
    *
    * @return string
    */
   public function getPlik3()
   {
       return $this->plik3;
   }
}
