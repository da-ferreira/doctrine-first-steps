<?php

namespace Alura\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'students')]
class Student
{
    #[Id, GeneratedValue, Column]
    public int $id;

    #[OneToMany(targetEntity: Phone::class, mappedBy: 'student', cascade: ['persist'], orphanRemoval: true)]
    private Collection $phones;

    #[ManyToMany(targetEntity: Course::class, inversedBy: 'students')]
    private Collection $courses;

    public function __construct(
        #[Column]
        public string $name
    ) {
        $this->phones = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

    public function addPhone(Phone $phone)
    {
        $phone->setStudent($this);
        $this->phones->add($phone);
    }

    /** @return Collection<Phone> */
    public function phones(): Collection
    {
        return $this->phones;
    }

    /** @return Collection<Course> */
    public function courses(): Collection
    {
        return $this->courses;
    }

    public function enrollInCourse(Course $course): void
    {
        if ($this->courses->contains($course)) {
            return;
        }

        $this->courses->add($course);
        $course->addStudent($this);
    }
}
