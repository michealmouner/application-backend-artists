<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

class ArtistController extends BaseController
{

    /**
     * List of artists with album info
     *
     * @Route("/artists", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns all artists",
     *     @SWG\Schema(
     *             @SWG\Property(property="data", type="array", @SWG\Items(
     *                  @SWG\Property(property="token", type="string"),
     *                  @SWG\Property(property="name", type="string"),
     *                  @SWG\Property(property="albums", type="array", @SWG\Items(
     *                      @SWG\Property(property="token", type="string"),
     *                      @SWG\Property(property="title", type="string"),
     *                      @SWG\Property(property="description", type="string"),
     *                      @SWG\Property(property="cover", type="string"),
     *              ))))
     *     )
     * )
     * @SWG\Tag(name="Artists")
     */
    public function artists()
    {
        $artists = $this->getDoctrine()->getManager()->getRepository("App:Artist")->findAll();
        return $this->createSuccessfulApiResponse($artists, array('name', 'token', 'albums' => ['title', 'cover', 'description']));
    }

    /**
     * List one artist with album info
     *
     * @Route("/artists/{token}", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns all songs inside album",
     *     @SWG\Schema(
     *             @SWG\Property(property="token", type="string"),
     *             @SWG\Property(property="name", type="string"),
     *             @SWG\Property(property="albums", type="array", @SWG\Items(
     *                  @SWG\Property(property="token", type="string"),
     *                  @SWG\Property(property="title", type="string"),
     *                  @SWG\Property(property="description", type="string"),
     *                  @SWG\Property(property="cover", type="string"),
     *              )),
     *     )
     * )
     * @SWG\Tag(name="Artists")
     */
    public function artist($token)
    {
        $artist = $this->getDoctrine()->getManager()->getRepository("App:Artist")->findOneBy(['token' => $token]);
        if(!$artist)
        {
            return $this->failedResponse("Artist not found", 400);
        }
        return $this->createSuccessfulApiResponse($artist, array('name', 'token', 'albums' => ['title', 'cover', 'description']));
    }

}
