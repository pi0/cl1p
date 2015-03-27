<?php

namespace pi0\Cl1pBundle\Controller;

use pi0\Cl1pBundle\Entity\Clip;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{


    /**
     * @Route("/")
     * @Template
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/help")
     * @Template
     */
    public function helpAction()
    {
        return array();
    }


    /**
     * Create or update Clip entity.
     *
     * @Route("/{slug}")
     * @Method("POST")
     * @param Request $r
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $r,$slug)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Clip $clip */
        $clip = $em->getRepository('Cl1pBundle:Clip')->getBySlug($slug);

        $clip->setTitle($r->get('title'));
        $clip->setData($r->get('data'));
        $clip->setUpdatedAt(new \DateTime());

        $em->persist($clip);
        $em->flush();

        return $this->redirectToRoute('pi0_cl1p_default_view',array('slug'=>$slug));

    }

    /**
     * @Route("/{slug}")
     * @Template("Cl1pBundle:Default:view.html.twig")
     */
    public function viewAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $clip = $em->getRepository('Cl1pBundle:Clip')->getBySlug($slug);

        return array(
            'clip' => $clip
        );
    }



}
