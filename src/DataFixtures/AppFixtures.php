<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Artist;
use App\Entity\Album;
use App\Entity\Song;
use App\Utils\TokenGenerator;
use App\Utils\TimeCalculator;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $data = json_decode(file_get_contents('dataset.json'), true);

        foreach($data as $key => $artistData)
        {
            $artist = new Artist();
            $artist->setName($artistData['name']);
            $artist->setToken(TokenGenerator::generate(6));

            foreach($artistData['albums'] as $albumData)
            {
                $album = new Album();
                $album->setArtist($artist);
                $album->setCover($albumData['cover']);
                $album->setTitle($albumData['title']);
                $album->setDescription($albumData['description']);
                $album->setToken(TokenGenerator::generate(6));

                $artist->addAlbum($album);
                $manager->persist($album);


                foreach($albumData['songs'] as $songData)
                {
                    $song = new Song();
                    $song->setAlbum($album);
                    $song->setTitle($songData['title']);
                    $song->setLength(TimeCalculator::secondsFromTime($songData['length']));

                    $album->addSong($song);
                    $manager->persist($song);
                }
            }
            $manager->persist($artist);
        }

        $manager->flush();
    }

}
