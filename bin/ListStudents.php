<?php

use Alura\Doctrine\Entity\Course;
use Alura\Doctrine\Entity\Phone;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManager = EntityManagerCreator::createEntityManager();
$studentRepository = $entityManager->getRepository(Student::class);

/** @var Student[] $studentList */
$studentList = $studentRepository->findAll();

// print_r($studentList);
print_r($studentRepository->find(1)->phones()->first()->number);
// print_r($studentRepository->findOneBy(['name' => 'David Ferreira']));
// print_r($studentRepository->count());

echo PHP_EOL . implode(', ', $studentList[0]->phones()
    ->map(fn(Phone $phone) => $phone->number)
    ->toArray());

echo PHP_EOL . implode(', ', $studentList[0]->courses()
    ->map(fn(Course $course) => $course->name)
    ->toArray());

echo PHP_EOL . $studentList[0]->courses()->count();
