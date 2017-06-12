<?php
/**
 * Created by PhpStorm.
 * User: nikunjbansal
 * Date: 8/6/17
 * Time: 3:14 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{

    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {

        if($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('read_blog');
        }

        /** @var AuthenticationUtils $authUtils */
        $authUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("login_check", name="login_check")
     * @param Request $request
     * @return Boolean
     */
    public function login_check(Request $request)
    {
        return true;
    }

}