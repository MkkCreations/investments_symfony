<?php

namespace App\DataFixtures;

use App\Entity\Portfolio;
use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class PortfolioFixture extends Fixture
{
    public const PORTFOLIO_REFERENCE = 'portfolio';
    public function load(ObjectManager $manager): void
    {
        $portfolio = new Portfolio();
        $portfolio->setName('Portfolio_1');
        $portfolio->setCreatedAt(new \DateTimeImmutable());
        $portfolio->setStatus(Status::ACTIVE);
        $portfolio->addAsset($this->getReference(AssetFixture::ASSET_REFERENCE));

        $manager->persist($portfolio);

        $manager->flush();
        $this->addReference(self::PORTFOLIO_REFERENCE, $portfolio);
    }
}
