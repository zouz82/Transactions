<?php

//require_once 'Modele/Modele.php';
require_once 'Framework/Modele.php';

class Paiement extends Modele {
    
    public function getPaiements($idCompte = NULL) {
        if ($idCompte == NULL) {
            $sql = 'select p.ID, p.ID_Compte, p.Date, p.Montant,'
                    . ' c.NomCompte as nomCompte from paiement p'
                    . ' inner join compte c on p.ID_Compte = c.ID_Compte'
                    . ' order by ID desc';
        } else {
            $sql = 'select * from paiement where ID_Compte = ?'
                    . ' order by ID desc';
        }
        $paiement = $this->executerRequete($sql, array($idCompte));
        return $paiement;
    }
    
    public function getPaiementsPublics($idCompte = NULL) {
        if ($idCompte == NULL) {
            $sql = 'select p.ID, p.ID_Compte, p.Date, p.Montant,'
                    . ' c.NomCompte as nomCompte from paiement p'
                    . ' inner join compte c on p.ID_Compte = c.ID_Compte'
                    . ' order by ID desc';
        } else {
            $sql = 'select * from paiement where ID_Compte = ? order by ID desc';
        }
        $paiements = $this->executerRequete($sql, array($idCompte));
        return $paiements;
    }
    
    public function getPaiement($id) {
        $sql = 'select * from paiement'
                . ' where ID = ?';
        $paiement = $this->executerRequete($sql, array($id));
        
        if ($paiement->rowCount() == 1) {
            return $paiement->fetch();  // Accès à la première ligne de résultat
        } else {
            throw new Exception("Aucun commentaire ne correspond à l'identifiant '$id'");
        }
        
    }

    // Supprime un compte
    public function deletePaiement($id) {
        $sql = 'DELETE FROM paiement'
                . ' WHERE ID = ?';
        $result = $this->executerRequete($sql, array($id));
        
        return $result;
    }

    public function modifierPaiement($paiement) {
        $sql = 'UPDATE paiement SET Date = ?, Montant = ? WHERE ID = ?';
        $result = $this->executerRequete($sql, array($paiement['Date'], $paiement['Montant'], $paiement['ID']));
    //    $result->execute(array($id));
        
        return $result;
    }

    
    //if changes don't work $paiement is param and for executerRequete array($paiement[etc])
    public function setPaiement($paiement) {
        $sql = 'INSERT INTO paiement (ID_Compte, Date, Montant) VALUES(?, ?, ?)';
        $result = $this->executerRequete($sql, array($paiement['ID_Compte'], $paiement['Date'], $paiement['Montant']));
        
        return $result;
    }
}

