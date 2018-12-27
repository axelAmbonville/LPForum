<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181204072559 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categories ADD cat_section_id INT NOT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF346685C1C88B FOREIGN KEY (cat_section_id) REFERENCES sections (id)');
        $this->addSql('CREATE INDEX IDX_3AF346685C1C88B ON categories (cat_section_id)');
        $this->addSql('ALTER TABLE posts ADD posts_author_id INT NOT NULL, ADD posts_topic_id INT NOT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA141746D7 FOREIGN KEY (posts_author_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAC59AF8F4 FOREIGN KEY (posts_topic_id) REFERENCES topics (id)');
        $this->addSql('CREATE INDEX IDX_885DBAFA141746D7 ON posts (posts_author_id)');
        $this->addSql('CREATE INDEX IDX_885DBAFAC59AF8F4 ON posts (posts_topic_id)');
        $this->addSql('ALTER TABLE topics ADD topics_cat_id INT NOT NULL');
        $this->addSql('ALTER TABLE topics ADD CONSTRAINT FK_91F6463939EC640C FOREIGN KEY (topics_cat_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_91F6463939EC640C ON topics (topics_cat_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF346685C1C88B');
        $this->addSql('DROP INDEX IDX_3AF346685C1C88B ON categories');
        $this->addSql('ALTER TABLE categories DROP cat_section_id');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA141746D7');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAC59AF8F4');
        $this->addSql('DROP INDEX IDX_885DBAFA141746D7 ON posts');
        $this->addSql('DROP INDEX IDX_885DBAFAC59AF8F4 ON posts');
        $this->addSql('ALTER TABLE posts DROP posts_author_id, DROP posts_topic_id');
        $this->addSql('ALTER TABLE topics DROP FOREIGN KEY FK_91F6463939EC640C');
        $this->addSql('DROP INDEX IDX_91F6463939EC640C ON topics');
        $this->addSql('ALTER TABLE topics DROP topics_cat_id');
    }
}
