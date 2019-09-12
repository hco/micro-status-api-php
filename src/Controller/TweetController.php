<?php

namespace App\Controller;

use App\Entity\Tweet;
use App\Entity\User;
use App\Repository\TweetRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class TweetController extends AbstractController
{
    /**
     * @Route("/tweets")
     */
    public function allTweets(TweetRepository $repository)
    {
        return new JsonResponse($repository->findAll());
    }

    /**
     * @Route("/users/{userName}/tweets")
     */
    public function tweetsForUser(string $userName, TweetRepository $tweetRepository, UserRepository $userRepository)
    {
        $user = $userRepository->findOneByUsername($userName);
        if (!$user instanceof User) {
            return new JsonResponse(
                [
                    'error' => 'Unknown user'
                ],
                404
            );
        }

        return new JsonResponse($tweetRepository->findByUser($user));
    }

    /**
     * @Route("/me/tweets")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function tweetsForCurrentUser(UserInterface $user, TweetRepository $repository)
    {
        return new JsonResponse($repository->findByUser($user));
    }

    /**
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @Route("/tweets/add", methods={"POST"})
     */
    public function addTweet(Request $request, UserInterface $user, EntityManagerInterface $entityManager)
    {
        if ($request->getContentType() !== 'json') {
            throw new BadRequestHttpException('Only JSON body is support');
        }

        $data = json_decode($request->getContent());

        $tweet = new Tweet($data->text, new \DateTimeImmutable(), $user);
        $entityManager->persist($tweet);
        $entityManager->flush();

        return new JsonResponse($tweet, Response::HTTP_CREATED);
    }
}