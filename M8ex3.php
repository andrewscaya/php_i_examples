<?php
include 'common_functions.php';

$all = getCustomers();
echo json_encode($all);
echo PHP_EOL;

$all = getOrdersByCustomer(3);
echo json_encode($all);
echo PHP_EOL;

$all = buildCustomerSelect();
echo htmlspecialchars($all);
echo PHP_EOL;


