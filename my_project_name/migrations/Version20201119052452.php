<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201119052452 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription() : string
    {
        return '';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE task ADD performer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB256C6B33F3 FOREIGN KEY (performer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_527EDB256C6B33F3 ON task (performer_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB256C6B33F3');
        $this->addSql('DROP INDEX IDX_527EDB256C6B33F3 ON task');
        $this->addSql('ALTER TABLE task DROP performer_id');
    }
}
