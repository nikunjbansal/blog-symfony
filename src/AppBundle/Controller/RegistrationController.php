<?php
/**
 * Created by PhpStorm.
 * User: nikunjbansal
 * Date: 8/6/17
 * Time: 5:45 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Forms\UserType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        // Create a new blank user and process the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $error = null;

        if ($form->isSubmitted() && $form->isValid()) {

            try {
                $user = $form->getData();

                $encoder = $this->get('security.password_encoder');
                $password = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);

                $user->setRole('ROLE_USER');

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('login');
            } catch(UniqueConstraintViolationException $e) {
                $error = 'UserName/Email already exists. Please Try again';
            }
        }

        return $this->render('auth/register.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }
}