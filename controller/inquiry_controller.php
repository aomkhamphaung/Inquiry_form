<?php
include_once __DIR__ . '/../model/inquiry.php';

class InquiryController extends Inquiry
{
    public function addData($company_name, $name, $email, $classification, $contract, $requirement)
    {
        $result = parent::addData($company_name, $name, $email, $classification, $contract, $requirement);
        return $result;
    }
}
?>