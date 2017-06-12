<?php
/**
 * Created by PhpStorm.
 * User: nikunjbansal
 * Date: 9/6/17
 * Time: 12:19 PM
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="blog")
 */
class Blog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="blogs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @ORM\OneToMany(targetEntity="BlogLikes", mappedBy="blogId")
     */
    private $blogLikes;

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
     * Set title
     *
     * @param string $title
     * @return Blog
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
     * @return Blog
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

    /**
     * Set userId
     *
     * @param \AppBundle\Entity\User $userId
     * @return Blog
     */
    public function setUserId(User $userId = null)
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
     * Constructor
     */
    public function __construct()
    {
        $this->blogLikes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add blogLikes
     *
     * @param \AppBundle\Entity\BlogLikes $blogLikes
     * @return Blog
     */
    public function addBlogLike(\AppBundle\Entity\BlogLikes $blogLikes)
    {
        $this->blogLikes[] = $blogLikes;

        return $this;
    }

    /**
     * Remove blogLikes
     *
     * @param \AppBundle\Entity\BlogLikes $blogLikes
     */
    public function removeBlogLike(\AppBundle\Entity\BlogLikes $blogLikes)
    {
        $this->blogLikes->removeElement($blogLikes);
    }

    /**
     * Get blogLikes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBlogLikes()
    {
        return $this->blogLikes->matching(
            Criteria::create()->where(
                Criteria::expr()->eq('isLiked', true)
            )
        );
    }
}
