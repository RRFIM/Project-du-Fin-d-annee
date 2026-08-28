<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\User;
use App\Form\UploadGameType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;  
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Flex\Recipe;
final class UploadGameController extends AbstractController
{
    #[Route('/upload/game', name: 'app_upload_game')]
    public function index(Request $request,
    SluggerInterface $slugger,
    #[CurrentUser] user $user, 
    EntityManagerInterface $em): Response
    {

        $game = new Game();
        $form = $this->createForm(UploadGameType::class, $game);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            /** @var UploadedFile $Upload */
            // gets the uploaded file
            $Upload = $form->get('Upload')->getData();
            $Uploadbrowser = $form->get('browserversion')->getData();
            // gets the original name the file was saved as
            $Uploadname = $Upload->getClientOriginalName();
            $Uploadbrowsername = $Uploadbrowser->getClientOriginalName(); 
            // moves the file and creates a folder that will be used for the placament of the file
            $Upload->move($this->getParameter('kernel.project_dir') . '/public/upload/game', $Uploadname);
            $Uploadbrowser->move($this->getParameter('kernel.project_dir') . '/public/upload/game/browser', $Uploadbrowsername);
            $game->setSubmitter($user);
            $Uploads = $game->setUploads($user);
            $game->setIsApproved(true);
            $game->setOnlineGameUrl('/browser/x'); // WIP will do when coding online playing

            //saves the changes
            $em->persist($game);
            $em->flush();
            
            return $this->redirectToRoute(
                    'app_login',
                    [],
                    Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('upload_game/index.html.twig', [
            'uploadgameForm' => $form,
            'controller_name' => 'UploadGameController',
            'user'=>$user


        ]);
    }
}
