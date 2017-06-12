<?php
/**
 * Created by PhpStorm.
 * User: nikunjbansal
 * Date: 9/6/17
 * Time: 12:34 PM
 */

namespace AppBundle\Services;


use AppBundle\Entity\Blog;
use AppBundle\Entity\BlogLikes;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

class UserBlogService implements UserBlogServiceInterface
{

    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param User $user
     * @return Blog
     */
    public function createNewBlog($user)
    {
        /** @var Blog $blog */
        $blog = new Blog();

        $blog
            ->setTitle('First Blog')
            ->setContent('My First hardcoded Blog')
            ->setUserId($user);

        $this->em->persist($blog);
        $this->em->flush();

        return $blog;
    }

    /**
     * @param User $user
     * @return array
     */
    public function getAllBlogs($user)
    {

        $blogs = $this->em->getRepository('AppBundle:Blog')
            ->findBy(['userId'=>$user], ['id'=>'DESC']);

        return $blogs;
    }

    /**
     * @param integer $blogId
     * @param User $user
     * @return int
     */
    public function toggleLikeBlog($blogId, $user)
    {

        /** @var Blog $blog */
        $blog = $this->em->getRepository('AppBundle:Blog')->find($blogId);

        $blogLikes = $this->em->getRepository('AppBundle:BlogLikes')
            ->findOneBy(array(
                'userId' => $user,
                'blogId' => $blog
            ));

        if($blogLikes) {

            $blogLikes->setIsLiked(!!!$blogLikes->getIsLiked());

        } else {

            $blogLikes = new BlogLikes();

            $blogLikes
                ->setUserId($user)
                ->setBlogId($blog)
                ->setIsLiked(true)
            ;

        }

        $this->em->persist($blogLikes);
        $this->em->flush();

        return count($blog->getBlogLikes());

    }
}