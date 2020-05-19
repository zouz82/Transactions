<?php

require_once 'Modele/Modele.php';

class Paiement extends Modele {
    
    public function getPaiements($idCompte) {
        $sql = 'select * from paiement'
                . ' where ID_Compte=?';
        
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
        return $paiement;
    }

    // Supprime un compte
    public function deletePaiement($id) {
        $sql = 'DELETE FROM paiement'
                . ' WHERE ID = ?';
        $result = $this->executerRequete($sql, array($id));
        
        return $result;
    }

    public function modifierPaiement($post) {
        $sql = 'UPDATE paiement SET Date = ?, Montant = ? WHERE ID = ?';
        $result = $this->executerRequete($sql, array($post['Date'], $post['Montant'], $post['ID']));
    //    $result->execute(array($id));
        
        return $result;
    }

    // Ajoute un commentaire associés à un article
    //if changes don't work $paiement is param and for executerRequete array($paiement[etc])
    public function setPaiement($ID_Compte, $Date, $Montant) {
        $sql = 'INSERT INTO paiement (ID_Compte, Date, Montant) VALUES(?, ?, ?)';
        $result = $this->executerRequete($sql, array($ID_Compte, $Date, $Montant));
        
        return $result;
    }
}
