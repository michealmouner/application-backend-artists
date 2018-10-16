<?php

namespace App\Controller;

use App\Api\ApiProblem;
use App\Api\ApiProblemException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Api\ResponseFactory;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

abstract class BaseController extends AbstractController
{

    protected function createSuccessfulApiResponse($data, $fields, $message = null)
    {
        $json = [
            'code'    => 200,
            'message' => $message,
            'status'  => 'OK',
            'data'    => $data
        ];


        return new Response($this->serialize($json, $fields), 200, array(
            'Content-Type' => 'application/json'
        ));
    }

    protected function serialize($data, $fields)
    {

        $serializer = new Serializer(array(new ObjectNormalizer()));

        $data = $serializer->normalize($data, null, array('attributes' => $fields));

        return json_encode($data);
    }

    /**
     *
     * @param type $message
     * @return type
     */
    public function failedResponse($message = "Failed", $code = 400)
    {
        $json = [
            'code'    => $code,
            'message' => $message,
            'status'  => 'Error',
        ];


        return new Response(json_encode($json), 400, array(
            'Content-Type' => 'application/json'
        ));
    }

}
