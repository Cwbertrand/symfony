<?php

/**
 * STARTER-KIT-SYMFONY
 * PHP version 7.
 *
 * @category App\Controller
 *
 * @author   FERRERO Franck <ferrerofranck@plateformweb.com>
 * @license  http://opensource.org/licenses/gpl-license.php MIT License
 *
 * @see     https://github.com/madbrain67/STARTER-KIT-SYMFONY
 */

namespace App\Controller;

/*
 * STARTER-KIT-SYMFONY
 * PHP version 7.
 *
 * @category App\Controller
 *
 * @author   FERRERO Franck <ferrerofranck@plateformweb.com>
 * @license  http://opensource.org/licenses/gpl-license.php MIT License
 *
 * @see     https://github.com/madbrain67/STARTER-KIT-SYMFONY
 */

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * STARTER-KIT-SYMFONY
 * PHP version 7.
 *
 * @category App\Controller
 *
 * @author   FERRERO Franck <ferrerofranck@plateformweb.com>
 * @license  http://opensource.org/licenses/gpl-license.php MIT License
 *
 * @see     https://github.com/madbrain67/STARTER-KIT-SYMFONY
 */
class MultiLanguesController extends AbstractController
{
    private $requestStack;

    /**
     * Void __construct().
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->RequestStack = $requestStack;
    }

    /**
     * Public function index().
     *
     * @param Request $request comment
     *
     * @Route("/multilangues", name="multi_langues", methods={"POST"})
     */
    public function index(Request $request): Response
    {
        $return = false;

        /*if ($request->request->get('code')) {
            $this->requestStack->getCurrentRequest()->getSession()->set('_locale', $request->request->get('code'));
            $return = true;
        } */
        $return = $request->request->get('code');

        $response = new Response($return);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
