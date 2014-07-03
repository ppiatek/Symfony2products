<?php
// src/Ppiatek/OrderBundle/Controller/ReportController.php
namespace Ppiatek\OrderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Ppiatek\OrderBundle\Entity\Klient;
use Ppiatek\OrderBundle\Entity\Zamowienie;
use Ppiatek\OrderBundle\Entity\Produkt;

class ReportController extends Controller
{
    /**
     * @Route("/{page}/{sort}/{direction}/{messages}", name="_report")
     * @Template()                          
     */
    public function indexAction(Request $request, $page = 1, $sort = 'id_klient', $direction = 'asc', $messages = 'Nazwisko')
    {
        // http://localhost:8000/app_dev.php/report?sort=k.imie&direction=asc
        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        
        $qb->select('k')
           ->from('PpiatekOrderBundle:Klient', 'k')
           ->orderBy('k.'.$sort, $direction);
        $query = $qb->getQuery();
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page /*page number*/,
            10/*limit per page*/
        );
        
        return array(
            'pagination' => $pagination,
            'name' => "Przemek",
            'count' => 4
        );
        
        /*
        //$repository = $this->getDoctrine()->getRepository('PpiatekOrderBundle:Klient');
        $em = $this->getDoctrine()->getEntityManager();
        $qb = $em->createQueryBuilder();
        $expr = $qb->expr();
        
        $limit = 10;
        $offset = ( $page < 1 ) ? 0 : (($page - 1) * $limit);
        
        $qb->select('k')
           ->from('PpiatekOrderBundle:Klient', 'k')
           ->orderBy('k.imie', 'ASC')
           ->setFirstResult($offset)
           ->setMaxResults($limit);
        $clients = $qb->getQuery()->getResult();
        
        
        $qb->resetDQLParts();
        $qb->select($expr->count('k'))
           ->from('PpiatekOrderBundle:Klient', 'k');
        $total = $qb->getQuery()->getSingleScalarResult();
        
        $countPages = ceil($total / $limit);
        
        
        
        return array(
            'clients' => $clients, 
            'countPages' => $countPages,
            'total' => $total
        );
        */
    }

    
    /**
     * @Route(
     *      "/list/{page}", 
     *      defaults={"_format"="json"},
     *      name="_report_list"
     * )
     * @Template()
     */
    public function listAction(Request $request, $page = 1)
    {
        
        $clients = array();
        
        $client = new stdClass();
        $client->firstname = 'Jan';
        $client->lastname = 'Kowalski';
        $clients[] = $client;
        
        $client2 = new stdClass();
        $client2->firstname = 'Marcin';
        $client2->lastname = 'Zab';
        $clients[] = $client2;
        
        return array('page' => $page, 'clients' => $clients);
    }

}
