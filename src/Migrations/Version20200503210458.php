<?php


namespace App\Migrations;


use Doctrine\DBAL\Schema\Schema;

class Version20200503210458
{
    public function up(Schema $schema) : void
    {
        $this->addSql('INSERT INTO `client_contact` (`id`, `email`, `professional_email`) VALUES (NULL, \'email@yahoo.com\', \'pro@yahoo.com\'), (NULL, \'email@gmail.com\', \'emailpro@gmail.com\');');
        $this->addSql('INSERT INTO `client` (`id`, `contact_id`, `name`) VALUES (NULL, \'1\', \'mon client\');');
        $this->addSql('INSERT INTO `client` (`id`, `contact_id`, `name`) VALUES (NULL, \'2\', \'mon client 2\');');
    }

    public function down(Schema $schema) : void
    {
    }
}
