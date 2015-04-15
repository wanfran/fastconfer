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
                $this->getWord($words['one']),
                $this->getWord($words['two']),
                $this->getWord($words['three']),
                $this->getWord($words['four'])
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
            $number[array_rand($number)],
            $scope[array_rand($scope)],
            $conference[array_rand($conference)],
            $topic[array_rand($topic)]
        );
    }

    private function getWord(array $array)
    {
        return $array[array_rand($array)];
    }
}