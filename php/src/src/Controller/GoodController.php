<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 11/11/18
 * Time: 17:10
 */

namespace App\Controller;


use App\Entity\Good;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;

class GoodController extends FOSRestController
{
    /**
     * @Rest\Get(
     *     path = "/goods/{id}",
     *     name = "app_good_show",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(
     *     statusCode = 200
     * )
     */
    public function showAction(Good $good)
    {
        return $good;
    }

    /**
     * @Rest\Get("/goods", name="app_good_list")
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     * @Rest\QueryParam(
     *     name="search",
     *     requirements="[a-zA-Z0-9]",
     *     default=null,
     *     nullable=true,
     *     description="Search query to look for $good"
     * )
     */
    public function listAction($order, $search)
    {
        return $order;
    }

    /**
     * @Rest\Post("/goods")
     * @Rest\View
     * @ParamConverter("good", converter="fos_rest.request_body",
     *      options={
     *         "validator"={ "groups"="Create" }
     *     })
     */
    public function createAction(Good $good, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }


        $em = $this->getDoctrine()->getManager();
        $em->persist($good);
        $em->flush();

        return $this->view(
            $good,
            Response::HTTP_CREATED,
            [ 'Location' => $this->generateUrl(
                    'app_good_show',
                    ['id' => $good->getId(), UrlGeneratorInterface::ABSOLUTE_URL]
               )
            ]
        );
    }
}