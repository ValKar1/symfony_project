<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route("/temp", name="temp_")
 */
class TempController extends AbstractController
{

    /**
     * @Route("/", name="index", requirements={"page"="\d+"})
     */
    public function index(Request $request): Response
    {
        return $this->render('temp/index.html.twig', [
            'controller_name' => 'TempController',
        ]);
    }

    /**
     * @Route("/{id}", name="test", requirements={"page"="\d+"})
     */
    public function test(Request $request, LoggerInterface $logger, SessionInterface $session): Response
    {
        echo $request->getPreferredLanguage()."<br>";
        // GET ?page=rrr
        echo $request->query->get('page')."<br>";
        // POST
        // echo $request->request->get('page')."<br>";
        // retrieves an instance of UploadedFile identified by foo
        // echo $request->files->get('foo')."<br>";
        echo $request->headers->get('host')."<br>";
        echo $this->getParameter('kernel.project_dir').'/contents'.'<br>';
        echo $this->getParameter('app.admin_email').'<br>';

        // Sessions
        $session->set('foo', 'bar');
        echo $session->get('foo') ."<br>";

        // Get Attributes
        echo $request->attributes->get('id') . "<br>";

        // Generate URL
        echo $this->generateUrl('temp_test', [
            'id' => 5
        ]);

        // Log
        $logger->info('AAAAAA!');

        // Exceptions
        $product = false;
        if (!$product) {
            // throw $this->createNotFoundException('The product does not exist');
            // throw new NotFoundHttpException('The product does not exist');
        }

        $this->addFlash(
            'notice',
            'Flash massage!'
        );

        // Response set Header
        // $response = new Response('<style> ... </style>');
        // $response->headers->set('Content-Type', 'text/css');
        // return $response;

        // JSON Response
        // return $this->json(['username' => 'jane.doe']);

        // Download file
        // return $this->file('/path/to/some_file.pdf');

        // Reder contents
        // $contents = $this->renderView('temp/test.html.twig', [
        //    'controller_name' => 'TempController',
        //    'notifications' => ['...', '...']
        // ]);
        // return new Response($contents);

        return $this->render('temp/test.html.twig', [
            'controller_name' => 'TempController',
            'notifications' => ['..1', '..2']
        ]);
    }
}
