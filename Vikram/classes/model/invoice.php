<?php 
class Invoice {
    private $invoice_id;
    private $user_id;
    private $invoice_payment_mode;
    private $invoice_tax;
    private $invoice_total;
    private $invoice_date;

    public function __construct($invoice_id, $user_id, $invoice_payment_mode, $invoice_tax, $invoice_total, $invoice_date) {
        $this->invoice_id = $invoice_id;
        $this->user_id = $user_id;
        $this->invoice_payment_mode = $invoice_payment_mode;
        $this->invoice_tax = $invoice_tax;
        $this->invoice_total = $invoice_total;
        $this->invoice_date = $invoice_date;
    }

    public function getInvoiceId() {
        return $this->invoice_id;
    }

    public function setInvoiceId($invoice_id) {
        $this->invoice_id = $invoice_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getInvoicePaymentMode() {
        return $this->invoice_payment_mode;
    }

    public function setInvoicePaymentMode($invoice_payment_mode) {
        $this->invoice_payment_mode = $invoice_payment_mode;
    }

    public function getInvoiceTax() {
        return $this->invoice_tax;
    }

    public function setInvoiceTax($invoice_tax) {
        $this->invoice_tax = $invoice_tax;
    }

    public function getInvoiceTotal() {
        return $this->invoice_total;
    }

    public function setInvoiceTotal($invoice_total) {
        $this->invoice_total = $invoice_total;
    }

    public function getInvoiceDate() {
        return $this->invoice_date;
    }

    public function setInvoiceDate($invoice_date) {
        $this->invoice_date = $invoice_date;
    }
}
?>