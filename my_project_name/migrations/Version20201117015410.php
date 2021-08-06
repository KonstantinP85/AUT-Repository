<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201117015410 extends AbstractMigration
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
        $this->addSql('ALTER TABLE task ADD executor_id INT NOT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB258ABD09BB FOREIGN KEY (executor_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_527EDB258ABD09BB ON task (executor_id)');
        $this->addSql('ALTER TABLE user CHANGE name name VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB258ABD09BB');
        $this->addSql('DROP INDEX IDX_527EDB258ABD09BB ON task');
        $this->addSql('ALTER TABLE task DROP executor_id');
        $this->addSql('ALTER TABLE user CHANGE name name VARCHAR(250) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
