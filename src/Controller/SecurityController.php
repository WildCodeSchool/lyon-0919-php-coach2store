<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function registration(Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(RegistrationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // verif si email deja en base, si oui add formError sinon traitement en desous
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'email' => $data['email']
                ]);

            if ($user){
                $form->addError(new FormError("L'émail est déja utilisé"));
            }else{
                $user = new User();
                $user->setUsername($data['username']);
                $user->setEmail($data['email']);
                $password = password_hash($data['password'], PASSWORD_DEFAULT);
                $user->setPassword($password);
                $manager->persist($user);
                $manager->flush();
            }
        }

        return $this->render('security/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
