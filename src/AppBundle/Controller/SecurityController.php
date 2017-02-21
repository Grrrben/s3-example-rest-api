<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller {

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        print_r($_POST);

        if ($request->isMethod("post")) {
            var_dump($request->request->all());
            $roles = array("ROLE_ADMIN");
            echo serialize($roles);
            die;
        }
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'security/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function checkAction(Request $request)
    {
        if ($request->isMethod("post")) {
            var_dump($request->request->all());
            $roles = array("ROLE_ADMIN");
            echo serialize($roles);
            die;
        }
        // The security layer will intercept this request, else redirect to login page
        $this->addFlash('warning', $this->get('translator')->trans('login_expired'));
        return $this->redirect($this->generateUrl('login'));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request, else redirect to login page
        $this->addFlash('warning', $this->get('translator')->trans('login_expired'));
        return $this->redirect($this->generateUrl('login'));
    }
}
