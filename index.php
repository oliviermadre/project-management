<?php

require_once 'vendor/autoload.php';

/**
collaborators.json generated from given url :
https://evaneos.ilucca.net/api/v3/users/scopedSearch?appInstanceId=5&operations=1&departmentid=30,31,22,28&fields=id,name,firstName,lastName,jobTitle,birthDate,picture[id,name,url,href,mimetype]
 */

use ProjectManagement\Collection\EvaneossianCollection;
use ProjectManagement\Imputation;
use ProjectManagement\Period;
use ProjectManagement\Projection\ExportCSVProjectListProjection;
use ProjectManagement\Projection\ListEvaneossianImputationForGivenDateProjection;
use ProjectManagement\Projection\ListProjectsForGivenDateProjection;
use ProjectManagement\Repository\CollaboratorJsonRepository;
use ProjectManagement\Repository\ImputationJsonRepository;
use ProjectManagement\Repository\ProjectJsonRepository;

$evaneossianRepo = new CollaboratorJsonRepository('./data/collaborators.json');
$evaneossianCollection = $evaneossianRepo->findAll();

$projectRepo = new ProjectJsonRepository('./data/projects.json');
$projectCollection = $projectRepo->findAll();

$imputationRepo = new ImputationJsonRepository('./data/imputation.json', $evaneossianCollection, $projectCollection);
$imputationCollection = $imputationRepo->findAll();


//$res = $evaneossianCollection->findAll('desneuf');
$devs = $evaneossianCollection->filter(EvaneossianCollection::FILTER_DEVELOPER);
var_dump($devs);
die();

//var_dump($imputationCollection->count());


$export = new ExportCSVProjectListProjection(Period::createFromString('2019-01-01', '2019-01-16'), $imputationCollection);
$export->render();

die();
// qui bosse sur quoi le 2 fevrier
for ($i = 1; $i <= 60; $i++) {
    if ($i < 10) {
        $v = '0' . $i;
    } else {
        $v = $i;
    }

    $date = DateTime::createFromFormat('Y-m-d H:i:s', '2019-01-' . $v . ' 12:00:00');
//    $projection = new ListProjectsForGivenDateProjection($date, $imputationCollection);
    $projection = new ListEvaneossianImputationForGivenDateProjection($date, $imputationCollection);

    echo $date->format('Y-m-d') . PHP_EOL;
    $projection->render();
    echo PHP_EOL;
}



//$pms = $evaneossianCollection->filter(EvaneossianCollection::FILTER_PM);
//$charles = $devs->findAll('desneuf')->first();
//var_dump($charles);