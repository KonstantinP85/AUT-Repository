<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119052452 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task ADD performer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB256C6B33F3 FOREIGN KEY (performer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_527EDB256C6B33F3 ON task (performer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB256C6B33F3');
        $this->addSql('DROP INDEX IDX_527EDB256C6B33F3 ON task');
        $this->addSql('ALTER TABLE task DROP performer_id');
    }
}
