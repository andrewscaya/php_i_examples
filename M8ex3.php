<?php
include 'common_functions.php';

echo "All Customers\n";
echo json_encode(getCustomers());
echo PHP_EOL;

echo "Jason Flores\n";
echo json_encode(getOrdersByCustomer(3));
echo PHP_EOL;

echo "Customer SELECT\n";
echo buildCustomerSelect();
echo PHP_EOL;


