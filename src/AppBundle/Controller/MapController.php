<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Map;
use AppBundle\Entity\Tile;
use AppBundle\Form\MapType;
use Symfony\Component\Form\Form;
use AppBundle\Manager\MapManager;
use AppBundle\Repository\MapTileRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Map controller.
 *
 * @Route("/map")
 */
class MapController extends Controller
{
    /**
     * Lists all Map entities.
     *
     * @Route("/", name="map")
     * @Template()
     *
     * @return Response
     */
    public function indexAction()
    {
        /** @var MapManager $manager */
        $manager = $this->get('app.map_manager');

        return ['maps' => $manager->getRepository()->findAll()];
    }

    /**
     * Finds and displays a Map entity.
     *
     * @Route("/{id}", name="map_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        return [
            'entity' => $this->get('app.map_manager')->getById($id),
        ];
    }

    /**
     * Creates a new Map entity.
     *
     * @Route("/", name="map_create")
     * @Method("POST")
     * @Template("AppBundle:Map:new.html.twig")
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $entity = new Map();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('map_show', ['id' => $entity->getId()]));
        }

        return [
            'entity' => $entity,
            'form'   => $form->createView(),
        ];
    }

    /**
     * Displays a form to create a new Map entity.
     *
     * @Route("/new", name="map_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Map();
        $form = $this->createCreateForm($entity);

        return [
            'entity' => $entity,
            'form'   => $form->createView(),
        ];
    }

    /**
     * Displays a form to edit an existing Map entity.
     *
     * @Route("/{id}/edit", name="map_edit")
     * @Method("GET")
     * @Template()
     *
     * @param int $id
     *
     * @return array
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Map')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Map entity.');
        }

        $editForm = $this->createEditForm($entity);

        return [
            'entity' => $entity,
            'form'   => $editForm->createView(),
        ];
    }

    /**
     * Edits an existing Map entity.
     *
     * @Route("/{id}", name="map_update")
     * @Method("PUT")
     * @Template("AppBundle:Map:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        /** @var Map $entity */
        $entity = $this->get('app.map_manager')->getById($id);

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('map_edit', ['id' => $id]));
        }

        return [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ];
    }

    /**
     * Deletes a Map entity.
     *
     * @Route("/delete/{id}", name="map_delete")
     */
    public function deleteAction($id)
    {
        /** @var MapManager $manager */
        $manager = $this->get('app.map_manager');

        $em = $this->getDoctrine()->getManager();
        $entity = $manager->getRepository()->find($id);

        if ($entity instanceof Map) {
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('map'));
    }

    /**
     * Construct the map tile by tile
     *
     * @Route("/construct/{id}", name="map_construct")
     * @Template()
     *
     * @param int $id
     *
     * @return Response
     */
    public function constructAction($id)
    {
        /** @var MapManager $manager */
        $manager = $this->get('app.map_manager');
        /** @var Map $map */
        $map = $manager->getById($id);

        return [
            'map'      => $map,
            'mapTiles' => $manager->createView($map),
            'tiles'    => $manager->getTiles(),
        ];
    }

    /**
     * @Route("/tile-by-tile", name="map_tile_by_tile")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function tileByTileAction(Request $request)
    {
        /** @var MapManager $manager */
        $manager = $this->get('app.map_manager');

        $id = $request->get('id');
        $x = $request->get('x');
        $y = $request->get('y');

        /** @var Tile $tile */
        foreach ($manager->getTiles() as $tile) {
            if ($tile->getId() == $request->get('tileId')) {
                break;
            }
        }

        /** @var Map $map */
        $map = $manager->getById($id);

        /** @var MapTileRepository $mapTileRepo */
        $mapTileRepo = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:MapTile');
        $mapTileRepo->insertPosition($x, $y, $map, $tile);

        // Create a JSON-response with a 200 status code
        $response = new Response(
            json_encode(['status' => true])
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

// ---------------------------- PRIVATE METHODS ----------------------------

    /**
     * Creates a form to create a Map entity.
     *
     * @param Map $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(Map $entity)
    {
        $form = $this->createForm(new MapType(), $entity, [
            'action' => $this->generateUrl('map_create'),
            'method' => 'POST',
        ]);

        return $this->addButtonsToForm($form);
    }

    /**
     * Creates a form to edit a Map entity.
     *
     * @param Map $entity The entity
     *
     * @return Form The form
     */
    private function createEditForm(Map $entity)
    {
        $form = $this->createForm(new MapType(), $entity, [
            'action' => $this->generateUrl('map_update', ['id' => $entity->getId()]),
            'method' => 'PUT',
        ]);

        return $this->addButtonsToForm($form);
    }

    /**
     * Adds buttons to the forms in CRUD admin
     *
     * @param Form $form
     *
     * @return Form
     */
    private function addButtonsToForm(Form $form)
    {
        $form->add('submit', 'submit', ['label' => 'action.update']);
        $form->add('back', 'button', ['label' => 'action.back_to_list']);
        $form->add('delete', 'button', ['label' => 'action.delete']);

        return $form;
    }
}
