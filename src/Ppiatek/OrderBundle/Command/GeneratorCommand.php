<?php

namespace Ppiatek\OrderBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Ppiatek\OrderBundle\Entity\Klient;
use Ppiatek\OrderBundle\Entity\Zamowienie;
use Ppiatek\OrderBundle\Entity\Produkt;

use Ppiatek\OrderBundle\Helper\Generator;

class GeneratorCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('order:generator')
            ->setDescription('Generator danych')
            ->addArgument('clients', InputArgument::OPTIONAL, 'Podaj liczbe klientow.')
         //   ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Liczba wygenerowanych klientow      
        $clientsNumber = $input->getArgument('clients');
        if (!$clientsNumber) {
            $clientsNumber = 100;
        }
        
        // Maksymalna liczba zamowieni             
        $ordersNumber = 5;
        
        // Maksymalna liczba produktow w zamowieniu                 
        $productsNumber = 10;
        
        
        $db = $this->getContainer()->get('doctrine');
        $em = $db->getManager();
        $em->getConnection()->getConfiguration()->setSQLLogger(null);
        
        for($i = 0; $i < $clientsNumber; $i++) {
            
            $klient = new Klient();
            $klient->setImie(Generator::getRandomFirstname());
            $klient->setNazwisko(Generator::getRandomLastname());
            
            
            $randNumberOrders = mt_rand(1, $ordersNumber);
            
            for($j = 0; $j < $randNumberOrders; $j++) {
                $zamowienie = new Zamowienie();
                $zamowienie->setIdKlient($klient);
                
                
                $randNumberProducts = mt_rand(1, $productsNumber);
            
                for($k = 0; $k < $randNumberProducts; $k++) {
                    $produkt = new Produkt();
                    $produkt->setIdZamowienie($zamowienie);
                    $produkt->setNazwa(Generator::getRandomProductName());
                    $produkt->setCena(Generator::getRandomProductPrice(1, 1000));
                    $em->persist($produkt);
                } 
                $em->persist($zamowienie);
                
            }
            $em->persist($klient);
            
        }
        $em->flush();
        
        
        /*
        // Generowanie klientow

        $klients = array();

        for($i = 0; $i < $clientsNumber; $i++) {
            
            $klient = new Klient();
            $klient->setImie(Generator::getRandomFirstname());
            $klient->setNazwisko(Generator::getRandomLastname());
            $klients[] = $klient;
            
            $em->persist($klient);
        }
        //$em->flush();
        
        
        // Generowanie zamowien
        
        $zamowienia = array();
        
        foreach($klients as $klient) {
           
           $randNumberOrders = mt_rand(1, $ordersNumber);
            
           for($i = 0; $i < $randNumberOrders; $i++) {
              $zamowienie = new Zamowienie();
              //$zamowienie->setIdKlient($klient->getIdKlient());
              //$zamowienie->setIdKlient($em->getRepository('PpiatekOrderBundle:Klient')->findOneById($klient->getIdKlient()));
              $zamowienie->setIdKlient($klient);
              $zamowienia[] = $zamowienie;
              
              $em->persist($zamowienie);
           }  
        }
        //$em->flush();
        
        // Generowanie produktow
        
        foreach($zamowienia as $zamowienie) {
           
           $randNumberProducts = mt_rand(1, $productsNumber);
            
           for($i = 0; $i < $randNumberProducts; $i++) {
              $produkt = new Produkt();
              //$produkt->setIdZamowienie($zamowienie->getIdZamowienie());
              $produkt->setIdZamowienie($zamowienie);
              
              $produkt->setNazwa(Generator::getRandomProductName());
              $produkt->setCena(Generator::getRandomProductPrice(1, 1000));
              $em->persist($produkt); 
           }  
        }
        $em->flush();
        */

        $output->writeln('Ilosc wygenerowanych klientow: '.$clientsNumber);
    }
}
