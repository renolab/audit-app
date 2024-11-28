<?php

namespace App\Domain\Mur\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeMur: string implements Enum
{
    case INCONNU = 'INCONNU';
    case PIERRE_MOELLONS = 'PIERRE_MOELLONS';
    case PIERRE_MOELLONS_AVEC_REMPLISSAGE = 'PIERRE_MOELLONS_AVEC_REMPLISSAGE';
    case PISE_OU_BETON_TERRE = 'PISE_OU_BETON_TERRE';
    case PAN_BOIS_SANS_REMPLISSAGE = 'PAN_BOIS_SANS_REMPLISSAGE';
    case PAN_BOIS_AVEC_REMPLISSAGE = 'PAN_BOIS_AVEC_REMPLISSAGE';
    case BOIS_RONDIN = 'BOIS_RONDIN';
    case BRIQUE_PLEINE_SIMPLE = 'BRIQUE_PLEINE_SIMPLE';
    case BRIQUE_PLEINE_DOUBLE_AVEC_LAME_AIR = 'BRIQUE_PLEINE_DOUBLE_AVEC_LAME_AIR';
    case BRIQUE_CREUSE = 'BRIQUE_CREUSE';
    case BLOC_BETON_PLEIN = 'BLOC_BETON_PLEIN';
    case BLOC_BETON_CREUX = 'BLOC_BETON_CREUX';
    case BETON_BANCHE = 'BETON_BANCHE';
    case BETON_MACHEFER = 'BETON_MACHEFER';
    case BRIQUE_TERRE_CUITE_ALVEOLAIRE = 'BRIQUE_TERRE_CUITE_ALVEOLAIRE';
    case SANDWICH_BETON_ISOLANT_BETON_SANS_ISOLATION_RAPPORTEE = 'SANDWICH_BETON_ISOLANT_BETON_SANS_ISOLATION_RAPPORTEE';
    case CLOISON_PLATRE = 'CLOISON_PLATRE';
    case OSSATURE_BOIS_SANS_REMPLISSAGE = 'OSSATURE_BOIS_SANS_REMPLISSAGE';
    case OSSATURE_BOIS_AVEC_REMPLISSAGE_TOUT_VENANT = 'OSSATURE_BOIS_AVEC_REMPLISSAGE_TOUT_VENANT';
    case OSSATURE_BOIS_AVEC_REMPLISSAGE_ISOLANT = 'OSSATURE_BOIS_AVEC_REMPLISSAGE_ISOLANT';
    case BETON_CELLULAIRE = 'BETON_CELLULAIRE';

    public static function from_enum_materiaux_structure_id(int $materiaux_structure_id): self
    {
        return match ($materiaux_structure_id) {
            1 => self::INCONNU,
            2 => self::PIERRE_MOELLONS,
            3 => self::PIERRE_MOELLONS_AVEC_REMPLISSAGE,
            4 => self::PISE_OU_BETON_TERRE,
            5 => self::PAN_BOIS_SANS_REMPLISSAGE,
            6 => self::PAN_BOIS_AVEC_REMPLISSAGE,
            7 => self::BOIS_RONDIN,
            8 => self::BRIQUE_PLEINE_SIMPLE,
            9 => self::BRIQUE_PLEINE_DOUBLE_AVEC_LAME_AIR,
            10 => self::BRIQUE_CREUSE,
            11 => self::BLOC_BETON_PLEIN,
            12 => self::BLOC_BETON_CREUX,
            13 => self::BETON_BANCHE,
            14 => self::BETON_MACHEFER,
            15 => self::BRIQUE_TERRE_CUITE_ALVEOLAIRE,
            16 => self::BETON_CELLULAIRE,
            17 => self::BETON_CELLULAIRE,
            18 => self::OSSATURE_BOIS_AVEC_REMPLISSAGE_ISOLANT,
            19 => self::SANDWICH_BETON_ISOLANT_BETON_SANS_ISOLATION_RAPPORTEE,
            20 => self::CLOISON_PLATRE,
            21 => self::INCONNU,
            22 => self::INCONNU,
            23 => self::INCONNU,
            24 => self::OSSATURE_BOIS_AVEC_REMPLISSAGE_ISOLANT,
            25 => self::OSSATURE_BOIS_SANS_REMPLISSAGE,
            26 => self::OSSATURE_BOIS_AVEC_REMPLISSAGE_ISOLANT,
            27 => self::OSSATURE_BOIS_AVEC_REMPLISSAGE_TOUT_VENANT,
        };
    }

    public function id(): string
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::INCONNU => 'Inconnu',
            self::PIERRE_MOELLONS => 'Murs en pierre de taille et moellons constitué d\'un seul matériaux',
            self::PIERRE_MOELLONS_AVEC_REMPLISSAGE => 'Murs en pierre de taille et moellons avec remplissage tout venant',
            self::PISE_OU_BETON_TERRE => 'Murs en pisé ou béton de terre stabilisé (à partir d\'argile crue)',
            self::PAN_BOIS_SANS_REMPLISSAGE => 'Murs en pan de bois sans remplissage tout venant',
            self::PAN_BOIS_AVEC_REMPLISSAGE => 'Murs en pan de bois avec remplissage tout venant',
            self::BOIS_RONDIN => 'Murs bois (rondin)',
            self::BRIQUE_PLEINE_SIMPLE => 'Murs en briques pleines simples',
            self::BRIQUE_PLEINE_DOUBLE_AVEC_LAME_AIR => 'Murs en briques pleines doubles avec lame d\'air',
            self::BRIQUE_CREUSE => 'Murs en briques creuses',
            self::BLOC_BETON_PLEIN => 'Murs en blocs de béton pleins',
            self::BLOC_BETON_CREUX => 'Murs en blocs de béton creux',
            self::BETON_BANCHE => 'Murs en béton banché',
            self::BETON_MACHEFER => 'Murs en béton de mâchefer',
            self::BRIQUE_TERRE_CUITE_ALVEOLAIRE => 'Brique terre cuite alvéolaire',
            self::SANDWICH_BETON_ISOLANT_BETON_SANS_ISOLATION_RAPPORTEE => 'Murs sandwich béton/isolant/béton (sans isolation rapportée)',
            self::CLOISON_PLATRE => 'Cloison de plâtre',
            self::OSSATURE_BOIS_SANS_REMPLISSAGE => 'Murs en ossature bois sans remplissage',
            self::OSSATURE_BOIS_AVEC_REMPLISSAGE_TOUT_VENANT => 'Murs en ossature bois avec remplissage tout venant',
            self::OSSATURE_BOIS_AVEC_REMPLISSAGE_ISOLANT => 'Murs en ossature bois avec isolant en remplissage',
            self::BETON_CELLULAIRE => 'Béton cellulaire',
        };
    }

    public function epaisseur_defaut(): int
    {
        return match ($this) {
            self::INCONNU => 0,
            self::PIERRE_MOELLONS => 20,
            self::PIERRE_MOELLONS_AVEC_REMPLISSAGE => 50,
            self::PISE_OU_BETON_TERRE => 40,
            self::PAN_BOIS_SANS_REMPLISSAGE => 8,
            self::PAN_BOIS_AVEC_REMPLISSAGE => 8,
            self::BOIS_RONDIN => 10,
            self::BRIQUE_PLEINE_SIMPLE => 9,
            self::BRIQUE_PLEINE_DOUBLE_AVEC_LAME_AIR => 20,
            self::BRIQUE_CREUSE => 15,
            self::BLOC_BETON_PLEIN => 20,
            self::BLOC_BETON_CREUX => 20,
            self::BETON_BANCHE => 20,
            self::BETON_MACHEFER => 20,
            self::BRIQUE_TERRE_CUITE_ALVEOLAIRE => 30,
            self::BETON_CELLULAIRE => 15,
            self::SANDWICH_BETON_ISOLANT_BETON_SANS_ISOLATION_RAPPORTEE => 15,
            self::CLOISON_PLATRE => 0,
            self::OSSATURE_BOIS_SANS_REMPLISSAGE => 8,
            self::OSSATURE_BOIS_AVEC_REMPLISSAGE_TOUT_VENANT => 8,
            self::OSSATURE_BOIS_AVEC_REMPLISSAGE_ISOLANT => 10,
        };
    }

    public function pont_thermique_negligeable(): bool
    {
        return \in_array($this, [
            self::BOIS_RONDIN,
            self::PAN_BOIS_SANS_REMPLISSAGE,
            self::PAN_BOIS_AVEC_REMPLISSAGE,
            self::CLOISON_PLATRE,
            self::OSSATURE_BOIS_AVEC_REMPLISSAGE_ISOLANT,
            self::OSSATURE_BOIS_AVEC_REMPLISSAGE_TOUT_VENANT,
            self::OSSATURE_BOIS_SANS_REMPLISSAGE,
        ]);
    }
}
