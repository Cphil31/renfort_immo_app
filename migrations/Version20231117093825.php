<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231117093825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accompte ADD CONSTRAINT FK_BD09DAF741DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816F6203804 FOREIGN KEY (statut_id) REFERENCES statut_adresse (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE analyse ADD CONSTRAINT FK_351B0C7EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE appels_recus ADD CONSTRAINT FK_2F9E5C3AE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE appels_recus ADD CONSTRAINT FK_2F9E5C3ABE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE communication ADD CONSTRAINT FK_F9AFB5EBD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE communication ADD CONSTRAINT FK_F9AFB5EBF6203804 FOREIGN KEY (statut_id) REFERENCES statut_communication (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638F6203804 FOREIGN KEY (statut_id) REFERENCES statut_contact (id)');
        $this->addSql('ALTER TABLE deplacement ADD CONSTRAINT FK_1296FAC2D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE deplacement ADD CONSTRAINT FK_1296FAC2F6203804 FOREIGN KEY (statut_id) REFERENCES statut_deplacement (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE devis_deplacement ADD CONSTRAINT FK_BCF731C341DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE devis_hebergement ADD CONSTRAINT FK_E633169D41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE devis_prestation ADD CONSTRAINT FK_E169C44541DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE devis_restauration ADD CONSTRAINT FK_FE224FAC41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE devis_reunion ADD CONSTRAINT FK_C9EE3FDE41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60F6203804 FOREIGN KEY (statut_id) REFERENCES statut_entreprise (id)');
        $this->addSql('ALTER TABLE etat_des_lieux ADD CONSTRAINT FK_F7210312F6203804 FOREIGN KEY (statut_id) REFERENCES statut_etat_des_lieux (id)');
        $this->addSql('ALTER TABLE etat_des_lieux ADD CONSTRAINT FK_F7210312F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE forfait ADD CONSTRAINT FK_BBB5C482D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9CD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145CD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145CF6203804 FOREIGN KEY (statut_id) REFERENCES statut_intervenant (id)');
        $this->addSql('ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145CA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145CE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145CF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC48F6203804 FOREIGN KEY (statut_id) REFERENCES statut_mail (id)');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC48E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC48A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC48BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE mission_produit ADD CONSTRAINT FK_B899786ABE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_produit ADD CONSTRAINT FK_B899786AF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE moyen ADD CONSTRAINT FK_2D6523D6D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE ouverture_dossier ADD CONSTRAINT FK_4F94D6EB41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE probleme ADD classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE probleme ADD CONSTRAINT FK_7AB2D714F6203804 FOREIGN KEY (statut_id) REFERENCES statut_probleme (id)');
        $this->addSql('ALTER TABLE probleme ADD CONSTRAINT FK_7AB2D714BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE probleme ADD CONSTRAINT FK_7AB2D7148F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_7AB2D7148F5EA509 ON probleme (classe_id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC274DFE3A85 FOREIGN KEY (identification_id) REFERENCES identification (id)');
        $this->addSql('ALTER TABLE profession ADD CONSTRAINT FK_BA930D69A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE profession ADD CONSTRAINT FK_BA930D69E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE restauration ADD CONSTRAINT FK_898B1EF1D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE reunion ADD CONSTRAINT FK_5B00A482D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE tache DROP classe_id');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_9387207596784F9E FOREIGN KEY (probleme_id) REFERENCES probleme (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075F6203804 FOREIGN KEY (statut_id) REFERENCES statut_tache (id)');
        $this->addSql('ALTER TABLE telephone ADD CONSTRAINT FK_450FF010F6203804 FOREIGN KEY (statut_id) REFERENCES statut_telephone (id)');
        $this->addSql('ALTER TABLE telephone ADD CONSTRAINT FK_450FF010A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE telephone ADD CONSTRAINT FK_450FF010E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accompte DROP FOREIGN KEY FK_BD09DAF741DEFADA');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816F6203804');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816E7A1254A');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816F347EFB');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A4AEAFEA');
        $this->addSql('ALTER TABLE analyse DROP FOREIGN KEY FK_351B0C7EF347EFB');
        $this->addSql('ALTER TABLE appels_recus DROP FOREIGN KEY FK_2F9E5C3AE7A1254A');
        $this->addSql('ALTER TABLE appels_recus DROP FOREIGN KEY FK_2F9E5C3ABE6CAE90');
        $this->addSql('ALTER TABLE communication DROP FOREIGN KEY FK_F9AFB5EBD2235D39');
        $this->addSql('ALTER TABLE communication DROP FOREIGN KEY FK_F9AFB5EBF6203804');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638F6203804');
        $this->addSql('ALTER TABLE deplacement DROP FOREIGN KEY FK_1296FAC2D2235D39');
        $this->addSql('ALTER TABLE deplacement DROP FOREIGN KEY FK_1296FAC2F6203804');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BBE6CAE90');
        $this->addSql('ALTER TABLE devis_deplacement DROP FOREIGN KEY FK_BCF731C341DEFADA');
        $this->addSql('ALTER TABLE devis_hebergement DROP FOREIGN KEY FK_E633169D41DEFADA');
        $this->addSql('ALTER TABLE devis_prestation DROP FOREIGN KEY FK_E169C44541DEFADA');
        $this->addSql('ALTER TABLE devis_restauration DROP FOREIGN KEY FK_FE224FAC41DEFADA');
        $this->addSql('ALTER TABLE devis_reunion DROP FOREIGN KEY FK_C9EE3FDE41DEFADA');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76D2235D39');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60F6203804');
        $this->addSql('ALTER TABLE etat_des_lieux DROP FOREIGN KEY FK_F7210312F6203804');
        $this->addSql('ALTER TABLE etat_des_lieux DROP FOREIGN KEY FK_F7210312F347EFB');
        $this->addSql('ALTER TABLE forfait DROP FOREIGN KEY FK_BBB5C482D2235D39');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9CD2235D39');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECE7A1254A');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECA4AEAFEA');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECF347EFB');
        $this->addSql('ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145CD2235D39');
        $this->addSql('ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145CF6203804');
        $this->addSql('ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145CA4AEAFEA');
        $this->addSql('ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145CE7A1254A');
        $this->addSql('ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145CF347EFB');
        $this->addSql('ALTER TABLE mail DROP FOREIGN KEY FK_5126AC48F6203804');
        $this->addSql('ALTER TABLE mail DROP FOREIGN KEY FK_5126AC48E7A1254A');
        $this->addSql('ALTER TABLE mail DROP FOREIGN KEY FK_5126AC48A4AEAFEA');
        $this->addSql('ALTER TABLE mail DROP FOREIGN KEY FK_5126AC48BE6CAE90');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CE7A1254A');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CA4AEAFEA');
        $this->addSql('ALTER TABLE mission_produit DROP FOREIGN KEY FK_B899786ABE6CAE90');
        $this->addSql('ALTER TABLE mission_produit DROP FOREIGN KEY FK_B899786AF347EFB');
        $this->addSql('ALTER TABLE moyen DROP FOREIGN KEY FK_2D6523D6D2235D39');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14E7A1254A');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14A4AEAFEA');
        $this->addSql('ALTER TABLE ouverture_dossier DROP FOREIGN KEY FK_4F94D6EB41DEFADA');
        $this->addSql('ALTER TABLE probleme DROP FOREIGN KEY FK_7AB2D714F6203804');
        $this->addSql('ALTER TABLE probleme DROP FOREIGN KEY FK_7AB2D714BE6CAE90');
        $this->addSql('ALTER TABLE probleme DROP FOREIGN KEY FK_7AB2D7148F5EA509');
        $this->addSql('DROP INDEX IDX_7AB2D7148F5EA509 ON probleme');
        $this->addSql('ALTER TABLE probleme DROP classe_id');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27D5E86FF');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC274DFE3A85');
        $this->addSql('ALTER TABLE profession DROP FOREIGN KEY FK_BA930D69A4AEAFEA');
        $this->addSql('ALTER TABLE profession DROP FOREIGN KEY FK_BA930D69E7A1254A');
        $this->addSql('ALTER TABLE restauration DROP FOREIGN KEY FK_898B1EF1D2235D39');
        $this->addSql('ALTER TABLE reunion DROP FOREIGN KEY FK_5B00A482D2235D39');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_9387207596784F9E');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075F6203804');
        $this->addSql('ALTER TABLE tache ADD classe_id INT NOT NULL');
        $this->addSql('ALTER TABLE telephone DROP FOREIGN KEY FK_450FF010F6203804');
        $this->addSql('ALTER TABLE telephone DROP FOREIGN KEY FK_450FF010A4AEAFEA');
        $this->addSql('ALTER TABLE telephone DROP FOREIGN KEY FK_450FF010E7A1254A');
    }
}
