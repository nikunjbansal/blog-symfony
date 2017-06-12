<?php
/**
 * Created by PhpStorm.
 * User: nikunjbansal
 * Date: 8/6/17
 * Time: 6:40 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Blog;
use AppBundle\Entity\User;
use AppBundle\Forms\BlogType;
use AppBundle\Services\UserBlogService;
use AppBundle\Services\UserBlogServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{

    /**
     * @Route("/blog/new", name="new_blog")
     * @METHOD({"POST", "GET"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createBlogAction(Request $request)
    {

        /** @var UserBlogService $blogService */
        $blogService = $this->container->get('user_blog_service');

        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Blog $blog */
            $blog = $form->getData();
            $blog->setUserId($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();

            return $this->redirectToRoute('read_blog');
        }

        return $this->render('blog/blog_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/blog/{blogId}", name="read_blog")
     * @Method("GET")
     *
     * @param Request $request
     * @param $blogId
     * @return Response
     */
    public function getBlogsAction(Request $request, $blogId=0)
    {

        /** @var UserBlogService $blogService */
        $blogService = $this->container->get('user_blog_service');

        return $this->render('blog/blog_main.html.twig', array(
            'blogs' => $blogService->getAllBlogs($this->getUser())
        ));
    }

    /**
     * @Route("blog/like", name="like_blog")
     */
    public function toggleLikeBlog(Request $request)
    {
        $blogId = $request->request->get('blogId');

        /** @var UserBlogService $blogService */
        $blogService = $this->container->get('user_blog_service');

        $likeCount = $blogService->toggleLikeBlog($blogId, $this->getUser());

        return JsonResponse::create(['likes'=>$likeCount], 200);

    }
}