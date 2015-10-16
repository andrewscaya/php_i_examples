<?php
define('DEFAULT_STATUS', 'ordered');
/**
 * 
 * @return array [status values]
 */
function getStatusValues()
{
	return array('unassigned', 'ordered', 'sent', 'canceled');
}

/**
 * 
 * @param string $selectedStatus
 * @return string HTML SELECT
 */
function buildStatusOptions($selectedStatus = DEFAULT_STATUS)
{
	$statusValues = getStatusValues();
	$html = '<select name="status">';
	foreach ($statusValues as $value) {
		if ($value == $selectedStatus) {
			$selected = ' selected';
		} else {
			$selected = '';
		}
		$html .= '<option value="' . $value . '"' .$selected . '>' . $value . '</option>';
	}
	$html .= '</select>';
	return $html;
}

function getStaticOrders($num = 1)
{
	//['id' => sequential int, 'order_status' => getStatusValues(RAND), 'amount' => RAND float]
	$data         = [];
	$statusValues = getStatusValues();
	$max          = count($statusValues) - 1;
	for ($id = 1; $id <= $num; $id++) {
		$status = $statusValues[rand(0, $max)];
		$amount = rand(1, 99999);
		$data[] = ['id' => $id, 'order_status' => $status, 'amount' => $amount];
	}
	return $data;
}

/**
 * Opens and returns connection
 * @param bool $close == TRUE == close connection
 * @return resource MySQL connection
 */
function getConnection($close = FALSE)
{
	static $link = NULL;
	if ($close) {
		mysqli_close($link);
		return FALSE;	
	} elseif ($link === NULL) {
		$link = mysqli_connect('127.0.0.1', 'phpi', 'password', 'php1');
		return $link;	
	}
}

function getQuote()
{
	return "'";
}

// SELECT `id`,`firstname`,`lastname` FROM `customers` WHERE x=y 
// $where = [key = column name, value = data]
// $andOr = AND | OR
function getCustomers(array $where = array(), $andOr = 'AND')
{
	$query = 'SELECT `id`,`firstname`,`lastname` FROM `customers`';
	if ($where) {
		$query .= ' WHERE ';
		foreach ($where as $column => $value) {
			$query .= ' ' . $column . ' = ' . getQuote() . $value . getQuote() . ' ' . $andOr;
		}
		$query = substr($query, 0, -(strlen($andOr)));
	}
	return queryResults($query);
}

// from Richard
function getOrdersByCustomer($customerId = '')
{
	if ($customerId === '' || !is_int($customerId)) {
		return FALSE;
	}
	
	$customerId = (int)$customerId;
	$query = 'SELECT `order_date`,
                     `order_status`,
                     `amount`,
                     `description`
              FROM `orders`
              WHERE `customer_id` = ' . $customerId;

	return queryResults($query);
}

/**
 * 
 * @param string SQL $query
 * @return associative array 
 */
function queryResults($query)
{
    $link = getConnection();
    $result = mysqli_query($link, $query);
    $value = mysqli_fetch_all($result, MYSQLI_ASSOC);   
    mysqli_close($link);     
    // NOTE: if a large data set you will need to 
    //       iterate through the results using while() and fetch
    return $value;   
}

/**
 * 
 * @param int $custId
 * @return string HTML $output
 */
function buildCustomerSelect($custId = 0)
{
	$list = getCustomers();
	var_dump($list); exit;
	$select = '<select name="custId">';
	foreach ($list as $customer) {
		if ($custId == $customer['id']) {
			$sel = ' selected';
		} else {
			$sel = '';
		}
 		$select .= '<option value="' 
 				 . $customer['id']
 				 . $sel 
 				 .'">' 
 				 . $customer['firstname'] 
 				 . ' '
 				 . $customer['lastname']
 		 		 . '</option>';
    }
    $select .= '</select>';
    return $select;
}
