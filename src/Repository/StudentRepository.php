<?php

namespace Alura\Doctrine\Repository;

use Alura\Doctrine\Entity\Student;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;

class StudentRepository extends EntityRepository
{
    /**
     * @return Student[]
     */
    public function show(): array
    {
        $dql = 'SELECT s, p, c from Alura\\Doctrine\\Entity\\Student s LEFT JOIN s.phones p LEFT JOIN s.courses c';

        return $this->getEntityManager()->createQuery($dql)->getResult();
    }
}
