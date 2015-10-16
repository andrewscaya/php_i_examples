# php_i_examples
Doug,

Not sure the best way to communicate this to the group, but think I've come up with 2 issues with the orders program as we left it after class today.

1. The static $link you mentioned only calls (or sets?) the $link once. But we close it after each query in the query results function. So any time we run more than one query on a page, the $link is gone for the second query. Not sure best way to adjust for this. Move the close out to a separate function always run at the end of a page?

2. The customer_id from getCustomers returns as a string. I think at the top of Richard's getOrdersByCustomer() error checking is returning false of the OR !is_int condition.

Still working, but thought I would pass that on since I wasn't entirely sure what to do with the static $link set up.

Cheers,

Mike
