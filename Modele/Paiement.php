<?php

require_once 'Modele/Modele.php';

class Paiement extends Modele {
    
    public function getPaiements($idCompte) {
        $sql = 'select * from paiement'
                . ' where ID_Compte=?';
        
        $paiements = $this->executerRequete($sql, array($idPaiements));
        
        return $paiements;
    }
    
    public function getPaiement($id) {
        $sql = 'select * from paiement'
                . ' where ID = ?';
        $paiement = $this->executerRequete($sql, array($id));
        
        if ($paiement->rowCount() == 1)
            return $paiement->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun commentaire ne correspond à l'identifiant '$id'");
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
    public function setPaiement($paiement) {
        $sql = 'INSERT INTO paiement (ID_Compte, Date, Montant) VALUES(?, ?, ?)';
        $result = $this->executerRequete($sql, array($paiement['ID_Compte'], $paiement['Date'], $paiement['Montant']));
        
        return $result;
    }
}

