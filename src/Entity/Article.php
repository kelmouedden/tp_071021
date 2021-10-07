<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

    /**
     * @ORM\Column(type="text")
     */
    private $Contenu;

    /**
     * @ORM\Column(type="blob")
     */
    private $Image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DatePublication;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="article")
     */
    private $Commenter;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Ecrire")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->Commenter = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->Contenu;
    }

    public function setContenu(string $Contenu): self
    {
        $this->Contenu = $Contenu;

        return $this;
    }

    public function getImage()
    {
        return $this->Image;
    }

    public function setImage($Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->DatePublication;
    }

    public function setDatePublication(\DateTimeInterface $DatePublication): self
    {
        $this->DatePublication = $DatePublication;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommenter(): Collection
    {
        return $this->Commenter;
    }

    public function addCommenter(Commentaire $commenter): self
    {
        if (!$this->Commenter->contains($commenter)) {
            $this->Commenter[] = $commenter;
            $commenter->setArticle($this);
        }

        return $this;
    }

    public function removeCommenter(Commentaire $commenter): self
    {
        if ($this->Commenter->removeElement($commenter)) {
            // set the owning side to null (unless already changed)
            if ($commenter->getArticle() === $this) {
                $commenter->setArticle(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
