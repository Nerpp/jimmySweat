<?php

namespace App\DataFixtures;

use App\Entity\Tricks;
use App\Entity\TricksGroup;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $figureGroupeNames = [
            'Les grabs',
            'Les rotations',
            'Les flips',
            'Les rotations désaxées',
            'Les slides',
            'Old school'
        ];

        $videosYoutube = [
            'https://www.youtube.com/embed/Zc8Gu8FwZkQ',
            'https://www.youtube.com/embed/0uGETVnkujA',
            'https://www.youtube.com/embed/G9qlTInKbNE',
            'https://www.youtube.com/embed/8AWdZKMTG3U',
            'https://www.youtube.com/embed/SQyTWk7OxSI'
        ];
        $figureDatas = [
            [
                'titre' => 'Mute',
                'desciption' => 'saisie de la carre frontside de la planche entre les deux pieds avec la main avant.',
                'categorie' => 'Les grabs'
            ],
            [
                'titre' => '360',
                'desciption' => 'trois six pour un tour complet.',
                'categorie' => 'Les rotations'
            ],
            [
                'titre' => 'Japan air',
                'desciption' => 'Saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside.',
                'categorie' => 'Les grabs'
            ],
            [
                'titre' => '1080',
                'desciption' => 'trois tours complets',
                'categorie' => 'Les rotations'
            ],
            [
                'titre' => 'Back flips',
                'desciption' => 'Rotations en arrière',
                'categorie' => 'Les rotations'
            ],
            [
                'titre' => 'Rodeo',
                'desciption' => 'Figure tête en bas où l’athlète pivote en diagonale au-dessus de son épaule pendant qu’il fait un salto',
                'categorie' => 'Les rotations désaxées'
            ],
            [
                'titre' => 'Rocket air',
                'desciption' => 'Figure aérienne où le surfeur saisit la carre pointe du pied à l’avant du pied avant avec la main avant, la jambe est redressée et la planche pointe perpendiculairement au sol',
                'categorie' => 'Old school'
            ],
            [
                'titre' => 'Seat belt',
                'desciption' => 'Figure aérienne où le surfeur saisit 
                le talon de la planche de surf avec sa main avant pendant que la jambe avant est tendue.',
                'categorie' => 'Les grabs'
            ],
            [
                'titre' => 'Truck driver',
                'desciption' => 'saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture)',
                'categorie' => 'Les grabs'
            ],
            [
                'titre' => 'Stalefish',
                'desciption' => ' Figure aérienne où l’athlète saisit la carre côté talons derrière la jambe arrière avec la main arrière pendant que la jambe arrière est redressée.',
                'categorie' => 'Les grabs'
            ],
            [
                'titre' => 'Japaasdfsadfn air',
                'desciption' => 'Saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside.',
                'categorie' => 'Les grabs'
            ],
            [
                'titre' => 'Jaasdfsadfpan air',
                'desciption' => 'Saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside.',
                'categorie' => 'Les grabs'
            ],
            [
                'titre' => 'Japasdfasdfasan air',
                'desciption' => 'Saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside.',
                'categorie' => 'Les grabs'
            ],
            [
                'titre' => 'Jdfasdfasdfapan air',
                'desciption' => 'Saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside.',
                'categorie' => 'Les grabs'
            ],
        ];

        $RandComments = [
            'Trop bien cette figure',
            'C\'est magnifique',
            'C\'est ma figure !',
            'Top',
            'Comment on peut faire ça !? ^^',
            'Polalalalal !',
            'Impressionant !',
            'WTF!',
            'Completement fou :) ',
            'waw',
            'WAOUWWWWW'
        ];

        foreach ($figureGroupeNames as $name) {
            $figuregroupe = new TricksGroup();
            $figuregroupe->setName($name);
            $manager->persist($figuregroupe);
        }

        for ($i = 0; $i < 4; $i++) {
            $user = new User();
            $user->setEmail($faker->safeEmail)
                ->setPassword($this->encoder->encodePassword($user, "testpass"));
            $manager->persist($user);
        }
        /** @var EntityManagerInterface  $manager */
        $manager->flush();

        /** @var User $allUser */
        $allUser = $manager->getRepository(User::class)->findAll();

        /**
         * table containing all user ids to randomize comment creation on line 169
         * @var array $userIds
         */
        $userIds = [];
        foreach ($allUser as $userId) {
            array_push($userIds, $userId->getId());
        }
        foreach ($figureDatas as $figureData) {
            $figure = new  Tricks();
            $figure
                ->setName($figureData['titre'])
                ->setCreateDate($faker->dateTimeInInterval('-30 days', '+5 days'))
                ->setFkTricksGroup(
                    $manager->getRepository(TricksGroup::class)
                        ->findOneBy(['name' => $figureData['categorie']])
                )
                ->setDescription($figureData['desciption']);
            $manager->persist($figure);
        }
        $manager->flush();
    }
}
