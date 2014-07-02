<?php
// src/Ppiatek/OrderBundle/Entity/Zamowienie.php
namespace Ppiatek\OrderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="zamowienie",indexes={@ORM\Index(name="idx_klient", columns={"id_klient"})})
 */
class Zamowienie
{

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_zamowienie;

    /**
     * @ORM\ManyToOne(targetEntity="Klient", inversedBy="zamowienia", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_klient", referencedColumnName="id_klient", nullable=false)
     **/
    protected $id_klient;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $data_zamowienie;
    
    /**
     * @ORM\OneToMany(targetEntity="Produkt", mappedBy="id_zamowienie")
     **/
    protected $produkty;
    
    
    public function __construct() {
        
        $this->produkty = new ArrayCollection();
        
        $this->data_zamowienie = new \DateTime();
         
    }
    

    /**
     * Get id_zamowienie
     *
     * @return integer 
     */
    public function getIdZamowienie()
    {
        return $this->id_zamowienie;
    }

    /**
     * Set id_klient
     *
     * @param integer $idKlient
     * @return Zamowienie
     */
    public function setIdKlient($idKlient)
    {
        $this->id_klient = $idKlient;

        return $this;
    }

    /**
     * Get id_klient
     *
     * @return integer 
     */
    public function getIdKlient()
    {
        return $this->id_klient;
    }

    /**
     * Set data_zamowienie
     *
     * @param \DateTime $dataZamowienie
     * @return Zamowienie
     */
    public function setDataZamowienie($dataZamowienie)
    {
        $this->data_zamowienie = $dataZamowienie;

        return $this;
    }

    /**
     * Get data_zamowienie
     *
     * @return \DateTime 
     */
    public function getDataZamowienie()
    {
        return $this->data_zamowienie;
    }

    /**
     * Add produkty
     *
     * @param \Ppiatek\OrderBundle\Entity\Produkt $produkt
     * @return Zamowienie
     */
    public function addProdukty(\Ppiatek\OrderBundle\Entity\Produkt $produkt)
    {
        $this->produkty[] = $produkt;

        return $this;
    }

    /**
     * Remove produkty
     *
     * @param \Ppiatek\OrderBundle\Entity\Produkt $produkt
     */
    public function removeProdukty(\Ppiatek\OrderBundle\Entity\Produkt $produkt)
    {
        $this->produkty->removeElement($produkt);
    }

    /**
     * Get produkty
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProdukty()
    {
        return $this->produkty;
    }
}
