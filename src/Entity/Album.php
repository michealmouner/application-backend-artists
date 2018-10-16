<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 */
class Album
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cover;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=6, unique=true)
     */
    private $token;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist",inversedBy = "albums", fetch="EXTRA_LAZY" )
     */
    private $artist;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Song",mappedBy = "album" , fetch="EXTRA_LAZY" )
     */
    private $songs;


    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken(string $token)
    {
        $this->token = $token;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->songs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set artist.
     *
     * @param \App\Entity\Artist|null $artist
     *
     * @return Album
     */
    public function setArtist(\App\Entity\Artist $artist = null)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist.
     *
     * @return \App\Entity\Artist|null
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Add song.
     *
     * @param \App\Entity\Song $song
     *
     * @return Album
     */
    public function addSong(\App\Entity\Song $song)
    {
        $this->songs[] = $song;

        return $this;
    }

    /**
     * Remove song.
     *
     * @param \App\Entity\Song $song
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSong(\App\Entity\Song $song)
    {
        return $this->songs->removeElement($song);
    }

    /**
     * Get songs.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSongs()
    {
        return $this->songs;
    }
}
