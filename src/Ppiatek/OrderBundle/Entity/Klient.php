<?php
// src/Ppiatek/OrderBundle/Entity/Klient.php
namespace Ppiatek\OrderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="klient")
 */
class Klient
{
    /**
     * @ORM\Column(name="id_klient",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_klient;

    /**
     * @ORM\Column(type="string", length=127, nullable=false)
     */
    protected $imie;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $nazwisko;
    
    /**
     * @ORM\OneToMany(targetEntity="Zamowienie", mappedBy="id_klient")
     **/
    protected $zamowienia;
    
    
    public function __construct() {
        $this->zamowienia = new ArrayCollection();
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
     * Set imie
     *
     * @param string $imie
     * @return Klient
     */
    public function setImie($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get imie
     *
     * @return string 
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * Set nazwisko
     *
     * @param string $nazwisko
     * @return Klient
     */
    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * Get nazwisko
     *
     * @return string 
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }

    /**
     * Add zamowienia
     *
     * @param \Ppiatek\OrderBundle\Entity\Zamowienie $zamowienie
     * @return Klient
     */
    public function addZamowienie(\Ppiatek\OrderBundle\Entity\Zamowienie $zamowienie)
    {
        $this->zamowienia[] = $zamowienie;

        return $this;
    }

    /**
     * Remove zamowienia
     *
     * @param \Ppiatek\OrderBundle\Entity\Zamowienie $zamowienie
     */
    public function removeZamowienie(\Ppiatek\OrderBundle\Entity\Zamowienie $zamowienie)
    {
        $this->zamowienia->removeElement($zamowienie);
    }

    /**
     * Get zamowienia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getZamowienia()
    {
        return $this->zamowienia;
    }
}
