<?php
/**
 * Created by PhpStorm.
 * User: nikunjbansal
 * Date: 9/6/17
 * Time: 12:39 PM
 */

namespace AppBundle\Services;


use AppBundle\Entity\Blog;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

interface UserBlogServiceInterface
{

    /**
     * @param User $user
     * @return Blog
     */
    public function createNewBlog($user);

//    /**
//     * @param User $user
//     * @return ArrayCollection
//     */
//    public function getAllBlogsByUser($user);

    /**
     * @return ArrayCollection
     */
    public function getAllBlogs();

    /**
     * @param integer $blogId
     * @param User $user
     * @return int
     */
    public function toggleLikeBlog($blogId, $user);
}