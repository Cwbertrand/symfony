<?php

namespace App\Controller;

use App\Repository\UrlRepository;
use App\services\UrlService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class UrlController extends AbstractController
{
    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    /**
     * @Route("/url", name="url")
     */
    public function index(): Response
    {
        return $this->render('url/index.html.twig', [
            'controller_name' => 'UrlController',
        ]);
    }

    /**
     * @Route("/ajax/shorten", name="url_add", methods={"POST"})
     */
    public function add(Request $request, TranslatorInterface $translator): Response
    {
        $longurl = $request->request->get('url');

        if (!$longurl) {
            return $this->json([
                    'statusCode' => 400,
                    'statusText' => $translator->trans('MISSING_ARG_URL'),
                ]);
        }

        $domain = $this->urlService->parseUrl($longurl);

        if (!$domain) {
            return $this->json([
                    'statusCode' => 500,
                    'statusText' => $translator->trans('INVALID_ARG_URL'),
                ]);
        }

        $Url = $this->urlService->addUrl($longurl, $domain);

        return $this->json([
                    'statusCode' => 200,
                    'link' => $Url->getLink(),
                    'long_url' => $Url->getLongUrl(),
                ]);
    }

    /**
     * @Route("/{hash}", name="url_view")
     */
    public function view(string $hash, UrlRepository $urlRepo): Response
    {
        $url = $urlRepo->findOneBy(['hash' => $hash]);

        if (!$url) {
            return $this->redirectToRoute('app_homepage');
        }

        return $this->redirect($url->getLongUrl());
    }
}
