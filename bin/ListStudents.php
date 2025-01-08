<?php

use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManager = EntityManagerCreator::createEntityManager();

$studentRepository = $entityManager->getRepository(Student::class);
$studentList = $studentRepository->show();

print_r(get_object_vars($studentList[0]->phones()));
print_r($studentList[0]->phones()->first()->number);
