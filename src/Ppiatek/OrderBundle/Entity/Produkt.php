<?php
// src/Ppiatek/OrderBundle/Entity/Produkt.php
namespace Ppiatek\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="produkt",indexes={@ORM\Index(name="idx_zamowienie", columns={"id_zamowienie"})})
 */
class Produkt
{
    
    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_produkt;
    
    /**
     * @ORM\ManyToOne(targetEntity="Zamowienie", inversedBy="produkty", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_zamowienie", referencedColumnName="id_zamowienie", nullable=false)
     **/
    protected $id_zamowienie;

    /**
     * @ORM\Column(type="string", length=511, nullable=false)
     */
    protected $nazwa;
    
    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=false)
     */
    protected $cena;
    

    /**
     * Get id_produkt
     *
     * @return integer 
     */
    public function getIdProdukt()
    {
        return $this->id_produkt;
    }

    /**
     * Set id_zamowienie
     *
     * @param integer $idZamowienie
     * @return Produkt
     */
    public function setIdZamowienie($idZamowienie)
    {
        $this->id_zamowienie = $idZamowienie;

        return $this;
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
     * Set nazwa
     *
     * @param string $nazwa
     * @return Produkt
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string 
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Set cena
     *
     * @param string $cena
     * @return Produkt
     */
    public function setCena($cena)
    {
        $this->cena = $cena;

        return $this;
    }

    /**
     * Get cena
     *
     * @return string 
     */
    public function getCena()
    {
        return $this->cena;
    }
}
