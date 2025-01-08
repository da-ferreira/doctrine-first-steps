<?php

use Alura\Doctrine\Entity\Course;
use Alura\Doctrine\Entity\Phone;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManager = EntityManagerCreator::createEntityManager();
$studentList = $entityManager->createQuery(
    'SELECT s, p, c
    from Alura\\Doctrine\\Entity\\Student s 
    LEFT JOIN s.phones p
    LEFT JOIN s.courses c'
)->getResult();

print_r(get_object_vars($studentList[0]->phones()));

print_r($studentList[0]->phones()->first()->number);

// $studentRepository = $entityManager->getRepository(Student::class);

// /** @var Student[] $studentList */
// $studentList = $studentRepository->findAll();

// print_r($studentRepository->find(1)->phones()->first()->number);

// echo PHP_EOL . implode(', ', $studentList[0]->phones()
//     ->map(fn(Phone $phone) => $phone->number)
//     ->toArray());

// echo PHP_EOL . implode(', ', $studentList[0]->courses()
//     ->map(fn(Course $course) => $course->name)
//     ->toArray());

// echo PHP_EOL . $studentList[0]->courses()->count();
