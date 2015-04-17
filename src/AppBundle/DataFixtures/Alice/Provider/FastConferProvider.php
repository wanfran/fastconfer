<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 15/04/15
 * Time: 04:24
 */

namespace AppBundle\DataFixtures\Alice\Provider;


use Symfony\Component\Yaml\Yaml;

class FastConferProvider
{
    public function article()
    {
        $words = Yaml::parse( __DIR__ . '/data/article.yml' );
        return mb_convert_case(
            sprintf("%s %s in %s %s",
                $this->getOne($words['one']),
                $this->getOne($words['two']),
                $this->getOne($words['three']),
                $this->getOne($words['four'])
            ),
            MB_CASE_TITLE
        );
    }

    public function conference()
    {
        $number = array (
            "I", "II", "III", "IV", "V", "VI", "VII",
        );

        $scope = array(
            "International", "European", "Spanish", "American", "French", "Italian", "Asian"
        );

        $conference = array(
            "Conference", "Symposium", "Workshop", "Seminar", "Colloquium", "Convention", "Congresses"
        );

        $topic = array(
            "Data Mining",
            "Big Data",
            "Online Journalism",
            "Computer Science",
            "Chemistry",
            "Artificial Intelligence",
            "SoftComputing",
            "Academic Comunication",
            "Education",
            "Security",
            "Economy",
        );

        return sprintf("%s %s %s on %s",
            $this->getOne( $number ),
            $this->getOne( $scope ),
            $this->getOne( $conference ),
            $this->getOne( $topic )
        );
    }

    public function researchOrganization()
    {
        $organizations = array(
            "Massachusetts Institute of Technology (MIT)",
            "Stanford University",
            "Carnegie Mellon University",
            "University of Cambridge",
            "Harvard University",
            "University of California, Berkeley (UCB)",
            "University of Oxford",
            "ETH Zurich - Swiss Federal Institute of Technology",
            "National University of Singapore (NUS)",
            "Politécnica de Madrid",
            "University of Córdoba",
        );

        return $this->getOne( $organizations );
    }

    private function getOne(array $array)
    {
        return $array[array_rand($array)];
    }
}