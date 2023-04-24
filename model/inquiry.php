<?php
include_once __DIR__ . '/../include/db.php';

class Inquiry
{
    private $pdo;
    public function addData($company_name, $name, $email, $classification, $contract, $requirement)
    {
        $this->pdo = Database::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "insert into informations(company_name, name, email, classification, contract, requirement) values (:company_name, :name, :email, :classification, :contract, :requirement)";
        $statement = $this->pdo->prepare($sql);
        //binding parameters
        $statement->bindParam(":company_name", $company_name);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":classification", $classification);
        $statement->bindParam(":contract", $contract);
        $statement->bindParam(":requirement", $requirement);
        //$statement->execute();

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>