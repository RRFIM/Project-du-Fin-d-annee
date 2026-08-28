<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $game = new Game();
        $game->setTitle('GAME');
        $game->setDescription('DESCRIPTION');
        $game->setMetaDescription('METADESCRIPTION');
        $game->setDownloadRate(mt_rand(20, 200));
        $game->setIsApproved(true);
        $game->setOnlineGameUrl('ONLINEGAMEURL');
        $game->setSourceCodeUrl('SOURCECODEURL');
        $game->setBrowserVersion('BROWSERVERSION');
        $game->setRequirements('REQUIREMENTS');
        $game->setNbPlayerMax(1);
        $game->setSubmitter($user);
        $game->setUploads($user);
        $manager->persist($game);


        $manager->flush();
    }
}
