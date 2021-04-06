<?php

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AuthorRepository;


/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $lastName;


    /**
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="authors", cascade={"persist"})
     */
    private Collection $articles;

    /**
     * Author constructor.
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(
        string $firstName,
        string $lastName
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->articles = new ArrayCollection([]);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return Collection
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    /**
     * @param Collection $articles
     * @return $this
     */
    public function setArticles(Collection $articles): Author
    {
        $this->articles = $articles;

        return $this;
    }

    public function addArticle(Article $article)
    {
        $this->articles->add($article);

        return $this;
    }
}