<?php

use Alura\Doctrine\Entity\Phone;
use Alura\Doctrine\Entity\Student;
use Alura\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManager = EntityManagerCreator::createEntityManager();

$student = new Student('Aluno com telefone XXX');
$student->addPhone(new Phone('11 9999-9999'));
$student->addPhone(new Phone('11 2222-2222'));

$entityManager->persist($student);
$entityManager->flush();
 