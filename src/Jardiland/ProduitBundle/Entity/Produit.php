<?php

namespace Jardiland\ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;


/**
 * Produit
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jardiland\ProduitBundle\Entity\ProduitRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Produit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal")
     */
    private $prix;
    
    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255)
     */
    private $marque;
    
    
    /**
    * @ORM\ManyToOne(targetEntity="Jardiland\ProduitBundle\Entity\Categorie",inversedBy="produits")
    * @ORM\JoinColumn(nullable=false)
    * @Assert\Valid()
    */
    private $categorie;
    
    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
    public $path;
    
    /**
    * @Assert\File(maxSize="6000000")
    */
    public $file;
    
    // propriété utilisé temporairement pour la suppression
    private $filenameForRemove;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Produit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prix
     *
     * @param string $prix
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Produit
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set puissance
     *
     * @param string $puissance
     * @return Produit
     */
    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;

        return $this;
    }

    /**
     * Get puissance
     *
     * @return string 
     */
    public function getPuissance()
    {
        return $this->puissance;
    }

    /**
     * Set debit
     *
     * @param string $debit
     * @return Produit
     */
    public function setDebit($debit)
    {
        $this->debit = $debit;

        return $this;
    }

    /**
     * Get debit
     *
     * @return string 
     */
    public function getDebit()
    {
        return $this->debit;
    }

    /**
     * Set dimension_sortie
     *
     * @param string $dimensionSortie
     * @return Produit
     */
    public function setDimensionSortie($dimensionSortie)
    {
        $this->dimension_sortie = $dimensionSortie;

        return $this;
    }

    /**
     * Get dimension_sortie
     *
     * @return string 
     */
    public function getDimensionSortie()
    {
        return $this->dimension_sortie;
    }

    /**
     * Set total_head
     *
     * @param string $totalHead
     * @return Produit
     */
    public function setTotalHead($totalHead)
    {
        $this->total_head = $totalHead;

        return $this;
    }

    /**
     * Get total_head
     *
     * @return string 
     */
    public function getTotalHead()
    {
        return $this->total_head;
    }

    /**
     * Set marque
     *
     * @param string $marque
     * @return Produit
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string 
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set capacite
     *
     * @param string $capacite
     * @return Produit
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * Get capacite
     *
     * @return string 
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * Set matiere
     *
     * @param string $matiere
     * @return Produit
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get matiere
     *
     * @return string 
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * Set categorie
     *
     * @param \Jardiland\ProduitBundle\Entity\Categorie $categorie
     * @return Produit
     */
    public function setCategorie(\Jardiland\ProduitBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Jardiland\ProduitBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }


    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->id.'.'.$this->path;
    }
    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->id.'.'.$this->path;
    }
    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/documents';
    }
    
    
    /**
    * @ORM\PostPersist()
    * @ORM\PostUpdate()
    */
    public function upload()
    {
        if (null === $this->file) {
        return;
        }
        // vous devez lancer une exception ici si le fichier ne peut pas
        // être déplacé afin que l'entité ne soit pas persistée dans la
        // base de données comme le fait la méthode move() de UploadedFile
        $this->file->move($this->getUploadRootDir(),
        $this->id.'.'.$this->file->guessExtension());
        unset($this->file);
    }
    
    /**
    * @ORM\PrePersist()
    * @ORM\PreUpdate()
    */
    public function preUpload()
    {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            $this->path = $this->file->guessExtension();
        }
    }
    
    /**
    * @ORM\PreRemove()
    */
    public function storeFilenameForRemove()
    {
        $this->filenameForRemove = $this->getAbsolutePath();
    }
    
    /**
    * @ORM\PostRemove()
    */
    public function removeUpload()
    {
        
        if ($this->filenameForRemove) {
        unlink($this->filenameForRemove);
        }
    }
    
    
    
    

     


    /**
     * Set path
     *
     * @param string $path
     * @return Produit
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
}
