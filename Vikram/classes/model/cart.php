<?php 
class Cart {
    private $invoice_id;
    private $car_id;
    private $car_quantity;

    public function __construct($invoice_id, $car_id, $car_quantity) {
        $this->invoice_id = $invoice_id;
        $this->car_id = $car_id;
        $this->car_quantity = $car_quantity;
    }

    public function getInvoiceId() {
        return $this->invoice_id;
    }

    public function setInvoiceId($invoice_id) {
        $this->invoice_id = $invoice_id;
    }

    public function getCarId() {
        return $this->car_id;
    }

    public function setCarId($car_id) {
        $this->car_id = $car_id;
    }

    public function getCarQuantity() {
        return $this->car_quantity;
    }

    public function setCarQuantity($car_quantity) {
        $this->car_quantity = $car_quantity;
    }
}
?>