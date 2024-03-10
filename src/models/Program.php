<?php

class Program {
    public static function getDetailsById($db, $programId) {
        $query = $db->prepare("SELECT * FROM programs WHERE ProgramID = ?");
        $query->bindValue(1, $programId, SQLITE3_INTEGER);
        
        $result = $query->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);

        if ($row) {
            return $row;
        } else {
            return null;
        }
    }
}
?>
