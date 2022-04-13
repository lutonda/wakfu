<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412182540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, pessoa_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649DF6FA0A5 (pessoa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DF6FA0A5 FOREIGN KEY (pessoa_id) REFERENCES pessoa (id)');
        $this->addSql('DROP TABLE departamento_pessoa');
        $this->addSql('ALTER TABLE contato CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE created created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE curso CHANGE departamento_id departamento_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE coordenador_id coordenador_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE apresentacao apresentacao VARCHAR(1000) DEFAULT NULL, CHANGE created created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE departamento CHANGE coordenador_id coordenador_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE created created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE evento CHANGE created created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE instituicional CHANGE coordenador_id coordenador_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE lingua CHANGE created created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE isactive isactive TINYINT(1) DEFAULT true NOT NULL');
        $this->addSql('ALTER TABLE noticia CHANGE created created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE periodo CHANGE created created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE pessoa CHANGE created created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE subscribe CHANGE full_name full_name VARCHAR(255) DEFAULT NULL, CHANGE created created DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departamento_pessoa (departamento_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', pessoa_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_A268A1355A91C08D (departamento_id), INDEX IDX_A268A135DF6FA0A5 (pessoa_id), PRIMARY KEY(departamento_id, pessoa_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE departamento_pessoa ADD CONSTRAINT FK_A268A1355A91C08D FOREIGN KEY (departamento_id) REFERENCES departamento (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departamento_pessoa ADD CONSTRAINT FK_A268A135DF6FA0A5 FOREIGN KEY (pessoa_id) REFERENCES pessoa (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE contato CHANGE nome nome VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE endereco endereco VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE `utf8_unicode_ci`, CHANGE telefone telefone VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE created created DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE curso CHANGE departamento_id departamento_id BINARY(16) DEFAULT \'NULL\' COMMENT \'(DC2Type:uuid)\', CHANGE coordenador_id coordenador_id BINARY(16) DEFAULT \'NULL\' COMMENT \'(DC2Type:uuid)\', CHANGE titulo titulo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE apresentacao apresentacao VARCHAR(1000) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE condicoes condicoes LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE plano plano LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon icon VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE imagem imagem LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created created DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE departamento CHANGE coordenador_id coordenador_id BINARY(16) DEFAULT \'NULL\' COMMENT \'(DC2Type:uuid)\', CHANGE texto texto VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE text text LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE titulo titulo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE imagem imagem LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon icon VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created created DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE evento CHANGE titulo titulo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE texto texto LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE imagem imagem LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created created DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE galeria CHANGE titulo titulo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE imagem imagem VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE descricao descricao LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE instituicional CHANGE coordenador_id coordenador_id BINARY(16) DEFAULT \'NULL\' COMMENT \'(DC2Type:uuid)\', CHANGE mensagem mensagem LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE ensino ensino LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE investigacao investigacao LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE extensao extensao LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE imagem_a imagem_a VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE imagem_b imagem_b VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE imagem_c imagem_c VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE lingua CHANGE nome nome VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon icon VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created created DATETIME DEFAULT \'current_timestamp()\' NOT NULL, CHANGE isactive isactive TINYINT(1) DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE noticia CHANGE titulo titulo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE categoria categoria VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE text text LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created created DATETIME DEFAULT \'current_timestamp()\' NOT NULL, CHANGE imagem imagem LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE periodo CHANGE nome nome VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created created DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE pessoa CHANGE nome nome VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE linkedin linkedin VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE titulo titulo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE descricao descricao VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE imagem imagem LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon icon VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created created DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE sobre CHANGE sobre sobre LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE missao missao LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE visao visao LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE historia historia LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`, CHANGE mensagem mensagem LONGTEXT NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE subscribe CHANGE full_name full_name VARCHAR(255) DEFAULT \'NULL\' COLLATE `utf8_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE created created DATETIME DEFAULT \'current_timestamp()\'');
        $this->addSql('ALTER TABLE tag CHANGE nome nome VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE time_line CHANGE titulo titulo VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
    }
}
