<?php
/**
 * Created by PhpStorm.
 * User: nikunjbansal
 * Date: 9/6/17
 * Time: 5:11 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog_likes")
 */
class BlogLikes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Blog", inversedBy="blogLikes")
     * @ORM\JoinColumn(name="blog_id", referencedColumnName="id")
     */
    private $blogId;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="likes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isLiked;


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
     * Set blogId
     *
     * @param \AppBundle\Entity\Blog $blogId
     * @return BlogLikes
     */
    public function setBlogId(\AppBundle\Entity\Blog $blogId = null)
    {
        $this->blogId = $blogId;

        return $this;
    }

    /**
     * Get blogId
     *
     * @return \AppBundle\Entity\Blog 
     */
    public function getBlogId()
    {
        return $this->blogId;
    }

    /**
     * Set userId
     *
     * @param \AppBundle\Entity\User $userId
     * @return BlogLikes
     */
    public function setUserId(\AppBundle\Entity\User $userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getIsLiked()
    {
        return $this->isLiked;
    }

    /**
     * @param mixed $isLiked
     */
    public function setIsLiked($isLiked)
    {
        $this->isLiked = $isLiked;
    }
}
