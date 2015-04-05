<?php

use h4cc\AliceFixturesBundle\Fixtures\FixtureSet;

$set = new FixtureSet(array(
    'locale' => 'es_ES',
    'do_drop' => true,
    'do_persist' => true,
));

$set->addFile(__DIR__.'/topic.yml', 'yaml');
$set->addFile(__DIR__.'/conferences.yml', 'yaml');
$set->addFile(__DIR__.'/users.yml', 'yaml');
$set->addFile(__DIR__.'/inscription.yml', 'yaml');
$set->addFile(__DIR__.'/articles.yml', 'yaml');
$set->addFile(__DIR__.'/articlesReview.yml', 'yaml');
$set->addFile(__DIR__.'/reviewer.yml', 'yaml');
//$set->addFile(__DIR__.'/reviewComments.yml', 'yaml');

return $set;

