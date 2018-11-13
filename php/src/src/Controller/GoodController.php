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
use FOS\RestBundle\Request\ParamFetcherInterface;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
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
     *     name="filter",
     *     requirements="[a-zA-Z0-9]+",
     *     nullable=true,
     *     description="The keyword to search for."
     * )
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="20",
     *     description="Max number of goods per page."
     * )
     * @Rest\QueryParam(
     *     name="offset",
     *     requirements="\d+",
     *     default="1",
     *     description="The pagination offset"
     * )
     * @Rest\View()
     */
    public function listAction(ParamFetcherInterface $paramFetcher)
    {
        /** @var Pagerfanta $pager */
        $pager = $this->getDoctrine()->getRepository('App:Good')->search(
            $paramFetcher->get('filter'),
            $paramFetcher->get('order'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('offset')
        );

        return $pager->getCurrentPageResults();
    }

    /**
     * @Rest\Post("/goods/test")
     * @Rest\View
     */
    public function testAction(Request $request)
    {
        $data = $request->getContent();
        $object = $this->get('serializer')->deserialize($data, Good::class, 'json');
                return $object->getCategory()->getId(); // 'foo'

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


    /**
     * @Rest\Patch("/goods/{id}")
     * @Rest\View
     * @ParamConverter("toMerge", converter="fos_rest.request_body",
     *      options={
     *         "validator"={ "groups"="Create" }
     *     })
     */
    public function updateAction(int $id, Good $toMerge, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }
        $good = $this->getDoctrine()->getRepository('App:Good')->find($id);
        if (!$good) {
            throw new NotFoundHttpException();
        }

        $toMerge->setId($id);
        $em = $this->getDoctrine()->getManager();
        $em->merge($toMerge);
        $em->flush();

        return $this->view(
            $toMerge,
            Response::HTTP_OK,
            [ 'Location' => $this->generateUrl(
                'app_good_show',
                ['id' => $toMerge->getId(), UrlGeneratorInterface::ABSOLUTE_URL]
            )
            ]
        );
    }

    /**
     * @Rest\Delete("/goods/{id}")
     * @Rest\View
     */
    public function deleteAction(int $id)
    {
        $good = $this->getDoctrine()->getRepository('App:Good')->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($good);
        $em->flush();

        return $this->view(
            $good,
            Response::HTTP_OK
        );
    }
}