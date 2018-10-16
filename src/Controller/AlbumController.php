<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

class AlbumController extends BaseController
{

    /**
     * List all songs inside album by token
     *
     * @Route("/albums/{token}", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns all songs inside album",
     *     @SWG\Schema(
     *             @SWG\Property(property="token", type="string"),
     *             @SWG\Property(property="title", type="string"),
     *             @SWG\Property(property="cover", type="string"),
     *             @SWG\Property(property="description", type="string"),
     *             @SWG\Property(property="artist", type="object",
     *                  @SWG\Property(property="name", type="string"),
     *                  @SWG\Property(property="token", type="string"),
     *              ),
     *             @SWG\Property(property="songs", type="array", @SWG\Items(
     *                  @SWG\Property(property="title", type="string"),
     *                  @SWG\Property(property="length", type="string"),
     *              )),
     *     )
     * )
     * @SWG\Tag(name="Albums")
     */
    public function album($token)
    {
        $artist = $this->getDoctrine()->getManager()->getRepository("App:Album")->findOneBy(['token' => $token]);
        if(!$artist)
        {
            return $this->failedResponse("Album not found", 400);
        }
        return $this->createSuccessfulApiResponse($artist, array('token', 'title', 'cover', 'description', 'artist' => ['token', 'name'],'songs'=>['title','lengthInMin']));
    }

}
