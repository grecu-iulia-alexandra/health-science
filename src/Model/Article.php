<?php

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
     * @ORM\Column(type="integer")
     */
    private int $publishingYear;

    /**
     * @ORM\ManyToMany(targetEntity="Author",mappedBy="articles", cascade={"persist"})
     */
    private Collection $authors;

    /**
     * @ORM\ManyToMany(targetEntity="Category",mappedBy="categories", cascade={"persist"})
     */
    private Collection $categories;

    /**
     * @ORM\ManyToMany(targetEntity="Label",mappedBy="labels", cascade={"persist"})
     */
    private Collection $labels;

    /**
     * Article constructor.
     * @param string $title
     * @param int $publishingYear
     * @param Collection $authors
     */
    public function __construct(
        string $title,
        int $publishingYear,
        Collection $authors
    ) {
        $this->title = $title;
        $this->publishingYear = $publishingYear;
        $this->authors = new ArrayCollection([]);

        foreach ($authors as $author) {
            $author->addArticle($this);
        }
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
     * @return int
     */
    public function getPublishingYear(): int
    {
        return $this->publishingYear;
    }

    /**
     * @return Collection
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    /**
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @return Collection
     */
    public function getLabels(): Collection
    {
        return $this->labels;
    }
}