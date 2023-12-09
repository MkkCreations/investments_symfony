<?php

namespace App\DataFixtures;

use App\Entity\Asset;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AssetFixture extends Fixture
{
    public const ASSET_REFERENCE = 'asset';
    public function load(ObjectManager $manager): void
    {
        $asset = new Asset();
        $asset->setName('Asset_1');
        $asset->setBoughtAt(new \DateTimeImmutable());
        $asset->setAmount(random_int(1, 100));
        $asset->setBoughtPrice(random_int(1, 100));

        $manager->persist($asset);

        $manager->flush();

        $this->addReference(self::ASSET_REFERENCE, $asset);
    }
}
