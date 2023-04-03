<?php

namespace App\ApiBundle\Controller;

use App\SkyBundle\Entity\Element;
use App\SkyBundle\Entity\Galaxy;
use App\SkyBundle\Entity\Star;
use App\SkyBundle\Repository\ElementRepository;
use App\SkyBundle\Repository\GalaxyRepository;
use App\SkyBundle\Repository\StarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Sky controller.
 *
 * @Route("/sky")
 */
class SkyController extends AbstractController
{
    private $starRepository;
    private $galaxyRepository;

    private $elementRepository;

    private $em;

    private $serializer;

    /**
     *
     */
    public function __construct(
        StarRepository         $starRepository,
        GalaxyRepository       $galaxyRepository,
        ElementRepository      $elementRepository,
        EntityManagerInterface $em,
        SerializerInterface    $serializer)
    {
        $this->starRepository = $starRepository;
        $this->galaxyRepository = $galaxyRepository;
        $this->elementRepository = $elementRepository;
        $this->em = $em;
        $this->serializer = $serializer;
    }

    /**
     * Creates a new star.
     *
     * @Route("/stars", name="new_star", methods={"POST"})
     */
    public function createStar(Request $request)
    {
        $body = $request->getContent();

        $star = $this->serializer->deserialize($body, Star::class, 'json');
        $this->em->persist($star);
        $this->em->flush();

        return new Response($this->serializer->serialize($star, 'json'));

    }

    /**
     * Gets a star by id.
     *
     * @Route("/stars/{id}", name="get_star", methods={"GET"})
     */
    public function getStar(Star $star)
    {
        return new Response($this->serializer->serialize($star, 'json'));
    }

    /**
     * Gets unique stars.
     *
     * @Route("/galaxy/{id}/stars", name="get_unique_stars", methods={"GET"})
     */
    public function getUniqueStars(Galaxy $galaxy, Request $request)
    {
        $viewType = $request->query->get('viewType');
        if ($viewType === null) {
            $viewType = 'basic';
        }

        $sortBy = $request->query->get('sortBy');
        if ($request->query->has('elements')) {
            $elementIds = explode(',', $request->query->get('elements'));
            $elements = $this->elementRepository->findBy(['id' => $elementIds]);
        } else {
            throw new BadRequestHttpException('Elements list missing');
        }
        $elementsNotInGalaxy = (int)$request->query->get('elementsNotInGalaxy');
        $notInGalaxy = $this->galaxyRepository->find($elementsNotInGalaxy);

        $notInGalaxyElements = [];
        if ($notInGalaxy instanceof Galaxy) {
            $notInGalaxyElements = $this->elementRepository->getGalaxyElements($notInGalaxy);
        }
        $inElements = array_udiff($elements, $notInGalaxyElements, function (Element $el, Element $nel) {
            return $el->getId() <=> $nel->getId();
        });

        $uniqueStars = $this->starRepository->getUniqueStars($galaxy, $inElements, $sortBy);

        return new Response($this->serializer->serialize($uniqueStars, 'json',
            [
                'groups' => $viewType
            ]
        ));
    }

    /**
     * Gets all stars
     *
     * @Route("/stars", name="get_stars", methods={"GET"})
     */
    public function getStars()
    {
        return new Response($this->serializer->serialize($this->starRepository->findAll(), 'json'));
    }

    /**
     * Update a star by id
     *
     * @Route("/stars/{id}", name="update_star", methods={"PUT"})
     */
    public function updateStar(Star $star, Request $request)
    {
        $body = $request->getContent();
        $updatedStar = $this->serializer->deserialize($body, Star::class, 'json');

        $star->setName($updatedStar->getName());
        $star->setRadius($updatedStar->getRadius());
        $star->setTemperature($updatedStar->getTemperature());
        $star->setRotationFrequency($updatedStar->getRotationFrequency());

        $this->em->persist($star);
        $this->em->flush();

        return new Response($this->serializer->serialize($star, 'json'));
    }

    /**
     * Delete a star by id
     *
     * @Route("/stars/{id}", name="delete_star", methods={"DELETE"})
     */
    public function deleteStar(Star $star)
    {
        $this->em->remove($star);
        $this->em->flush();

        return new Response();
    }
}
