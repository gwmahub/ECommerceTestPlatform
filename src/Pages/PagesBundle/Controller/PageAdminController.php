<?php

namespace Pages\PagesBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Pages\PagesBundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * PageAdmin controller.
 *
 */
class PageAdminController extends Controller
{
    /**
     * Lists page entities wich are not in trash ( deletedAt = null)
     * Get the number of page in trash to help user in navigation
     */
    public function indexAction()
    {
        $em     = $this->getDoctrine()->getManager();
        $em->getFilters()->disable('softdeleteable'); // must disable the Doctrine filter to catch and count the "deleted" pages
	    $nbPagesInTrash = count($em->getRepository('PagesBundle:Page')->getTrashedPages());
	    $pages  = $em->getRepository('PagesBundle:Page')->findBy( ['deletedAt' => null] ); // only "active" Pages

        return $this->render('PagesBundle:Admin:index.html.twig', array(
            'pages'          => $pages,
	        'nbPagesInTrash' =>$nbPagesInTrash
        ));
    }

	/**
	 * Lists pages in trash (soft deleted)
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function trashAction(){
	    $em = $this->getDoctrine()->getManager();
	    $em->getFilters()->disable('softdeleteable');

	    $pages = $em->getRepository(Page::class)->getTrashedPages();

	    return $this->render('PagesBundle:Admin:trash.html.twig', array(
		    'pages' => $pages
	    ));
    }

	/**
	 * Restore the pages in trash
	 * @param $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
    public function restoreAction($id){
	    $em     = $this->getDoctrine()->getManager();
	    $em->getFilters()->disable('softdeleteable');
    	$page   = $em->getRepository(Page::class)->find($id);

	    $page->setDeletedAt(null);
	    $em->persist($page);
	    $em->flush();

	    return $this->redirect($this->generateUrl('pageAdmin_trash'));

    }

    /**
     * Creates a new page entity.
     *
     */
    public function newAction(Request $request)
    {
        $page = new Page();
        $form = $this->createForm('Pages\PagesBundle\Form\PageType', $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('pageAdmin_show', array('id' => $page->getId()));
        }

        return $this->render('PagesBundle:Admin:new.html.twig', array(
            'page' => $page,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a page entity.
     *
     */
    public function showAction(Page $page)
    {
	    $em = $this->getDoctrine()->getManager();
	    $em->getFilters()->disable('softdeleteable');

	    $deleteForm = $this->createDeleteForm($page);

        return $this->render('PagesBundle:Admin:show.html.twig', array(
            'page' => $page,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing page entity.
     */
    public function editAction(Request $request, Page $page)
    {
    	$em     = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('PagesBundle:Page')->find($page);
		$repo   = $em->getRepository('Gedmo\Loggable\Entity\LogEntry');

        $deleteForm = $this->createDeleteForm($page);
        $editForm = $this->createForm('Pages\PagesBundle\Form\PageEditType', $page);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
	        $em->flush();

	        $request->getSession()->getFlashBag()->add('success', 'The page has been updated with success.');

            return $this->redirectToRoute('pageAdmin_edit', array('id' => $page->getId()));
        }

        return $this->render('PagesBundle:Admin:edit.html.twig', array(
            'page'          => $page,
            'edit_form'     => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
        ));
    }

	/**
	 * Get all versions availables for a Page
	 * @param Page $page
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function getVersionedPagesAction(Page $page){
	    $em     = $this->getDoctrine()->getManager();
	    $entity = $em->getRepository('PagesBundle:Page')->find($page);
	    $repo   = $em->getRepository('Gedmo\Loggable\Entity\LogEntry');
	    $vPages = $repo->getLogEntries($entity);

	    return $this->render('PagesBundle:Admin:VersionedPages/pageVersionsLinks.html.twig', array(
	    	'page' => $page,
	    	'vPages' => $vPages
	    ));
    }

	/**
	 * Get the targeted Page version and the current Page version to compare them on the the pageVersionShow view
	 * @param Page $page : the current version
	 * @param $idv : the targeted version
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function showPageVersionAction(Page $page, $idv){
	    $em     = $this->getDoctrine()->getManager();
	    $vPage  = $em->getRepository('Gedmo\Loggable\Entity\LogEntry')->findOneBy(['objectId'=>$page, 'version'=>$idv]);

	    return $this->render('PagesBundle:Admin:VersionedPages/pageVersionShow.html.twig', array(
		    'page' => $page,
		    'vPage' => $vPage
	    ));
    }

	/**
	 * Revert the current version to the targeted version
	 * @param Page $page : the current version
	 * @param $idv : the targeted version
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
    public function revertToThisVersionAction( Page $page, $idv ){
	    $em     = $this->getDoctrine()->getManager();
	    $repo   = $em->getRepository('Gedmo\Loggable\Entity\LogEntry');
	    $entity = $em->getRepository('PagesBundle:Page')->find($page);
	    $repo->revert($entity, $idv);
	    $em->persist($entity);
	    $em->flush();

	    return $this->redirect($this->generateUrl('pageAdmin_show', array('id' => $page->getId())));
    }

    /**
     * Deletes a page entity.
     *
     */
    public function deleteAction(Request $request, Page $page)
    {
        $form = $this->createDeleteForm($page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush();
        }

        return $this->redirectToRoute('pageAdmin_index');
    }

    /**
     * Creates a form to delete a page entity.
     *
     * @param Page $page The page entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Page $page)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pageAdmin_delete', array('id' => $page->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
