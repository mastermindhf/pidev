<?php

namespace BiblioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Livres
 *
 * @ORM\Table(name="livres")
 * @ORM\Entity(repositoryClass="BiblioBundle\Repository\LivresRepository")
 */
class Livres
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLivre", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idLivre;


    /**
     * @var integer
     *
     * @ORM\Column(name="likes", type="integer")
     */
    private $likes;



    /**
     * @var integer
     *
     * @ORM\Column(name="dislikes", type="integer")
     */
    private $dislikes;

    /**
     * @return int
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param int $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

    /**
     * @return int
     */
    public function getDislikes()
    {
        return $this->dislikes;
    }

    /**
     * @param int $dislikes
     */
    public function setDislikes($dislikes)
    {
        $this->dislikes = $dislikes;
    }

    /**
     * @var string
     * @Assert\NotBlank(message="Entrer le nom du livre")
     * @ORM\Column(name="nom", type="string", length=20, nullable=true)
     */
    private $nom;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumn(name="id_type",referencedColumnName="idL")
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="res", type="integer", nullable=false)
     */
    private $res;

    /**
     * @return int
     */
    public function getRes()
    {
        return $this->res;
    }

    /**
     * @param int $res
     */
    public function setRes($res)
    {
        $this->res = $res;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="nbPersonnes", type="integer", nullable=false)
     */
    private $nbpersonnes;

    /**
     * @return int
     */
    public function getNbpersonnes()
    {
        return $this->nbpersonnes;
    }

    /**
     * @param int $nbpersonnes
     */
    public function setNbpersonnes($nbpersonnes)
    {
        $this->nbpersonnes = $nbpersonnes;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }



    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=20, nullable=true)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(message="Champs pas vide")
     * @ORM\Column(name="auteur", type="string", length=20, nullable=true)
     */
    private $auteur;



    /**
     * @Assert\NotBlank(message="Champs pas vide")
     * @var integer
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var string
     * @Assert\Image()
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     *
     */
    private $image;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getIdLivre()
    {
        return $this->idLivre;
    }

    /**
     * @param int $idLivre
     */
    public function setIdLivre($idLivre)
    {
        $this->idLivre = $idLivre;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    /**
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param string $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }


}

