<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Utils\TimeCalculator;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SongRepository")
 */
class Song
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $length;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Album",inversedBy = "songs", fetch="EXTRA_LAZY" )
     */
    private $album;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getLengthInMin()
    {
        return TimeCalculator::timeFromSeconds($this->length);
    }


    public function setLength( $length): self
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Set album.
     *
     * @param \App\Entity\Album|null $album
     *
     * @return Song
     */
    public function setAlbum(\App\Entity\Album $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album.
     *
     * @return \App\Entity\Album|null
     */
    public function getAlbum()
    {
        return $this->album;
    }
}
