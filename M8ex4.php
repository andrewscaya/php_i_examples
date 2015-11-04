<?php 
include 'common_functions.php';
$custId = (isset($_GET['custId'])) ? (int) $_GET['custId'] : 0;
$orders = getOrdersByCustomer($custId);
$cust   = ($custId) ? getCustomers(['id' => $custId])[0] : array();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Order History</title>
</head>
<body>
	<form action="M8ex4.php" method="get">
	<?php echo buildCustomerSelect($custId) ?>
	<input type="submit" />
	</form>
    <?php if ($cust) : ?>
        <h1><?php echo $cust['firstname'] . ' ' . $cust['lastname'] ?></h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $countOrders = count($orders);
                for($i=0;$i < $countOrders;$i++) : ?>
                <tr>
                    <?php foreach($orders[$i] as $order) : ?>
                    <td style="border: 1px solid black;"><?php echo $order;?></td>
                    <?php endforeach; ?>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    <?php endif; getConnection(FALSE); ?>
</body>
</html>
