<?php

declare(strict_types=1);

namespace Alura\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250108230643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE courses (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE phones (id INT AUTO_INCREMENT NOT NULL, number VARCHAR(255) NOT NULL, student_id INT DEFAULT NULL, INDEX IDX_E3282EF5CB944F1A (student_id), PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE students (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE student_course (student_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_98A8B739CB944F1A (student_id), INDEX IDX_98A8B739591CC992 (course_id), PRIMARY KEY(student_id, course_id))');
        $this->addSql('ALTER TABLE phones ADD CONSTRAINT FK_E3282EF5CB944F1A FOREIGN KEY (student_id) REFERENCES students (id)');
        $this->addSql('ALTER TABLE student_course ADD CONSTRAINT FK_98A8B739CB944F1A FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_course ADD CONSTRAINT FK_98A8B739591CC992 FOREIGN KEY (course_id) REFERENCES courses (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phones DROP FOREIGN KEY FK_E3282EF5CB944F1A');
        $this->addSql('ALTER TABLE student_course DROP FOREIGN KEY FK_98A8B739CB944F1A');
        $this->addSql('ALTER TABLE student_course DROP FOREIGN KEY FK_98A8B739591CC992');
        $this->addSql('DROP TABLE courses');
        $this->addSql('DROP TABLE phones');
        $this->addSql('DROP TABLE students');
        $this->addSql('DROP TABLE student_course');
    }
}
