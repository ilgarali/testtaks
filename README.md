After migrating and seeding db, you'll have 10 bonds and 10 orders.

You can have a look Bond Interest Payment Dates by these urls. Change {id} to 1-10.

It only accepts GET request

http://127.0.0.1:8000/api/bond/{id}

Example

http://127.0.0.1:8000/api/bond/1

Creating a Bond Purchase Order you have to send POST request to below url with form-data which has to include
these data: order_date, number_of_bonds_bought.

http://127.0.0.1:8000/api/bond/{id}/order

Example

http://127.0.0.1:8000/api/bond/2/order


Bond Order Interest Payments

Send POST request with order id parameter below url

http://127.0.0.1:8000/api/bond/order/{id}

Example

http://127.0.0.1:8000/api/bond/order/1
