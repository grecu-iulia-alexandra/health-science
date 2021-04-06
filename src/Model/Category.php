<?php

namespace App\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;


/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private string $title;


    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="articles", cascade={"persist"})
     */
    private Collection $articles;

    /**
     * Category constructor.
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
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
    public function getTitle(): string
    {
        return $this->title;
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
    public function setArticles(Collection $articles): Category
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