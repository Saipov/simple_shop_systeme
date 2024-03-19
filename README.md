## Test task test-for-candidates

### Getting started
```bash
$ composer run setup
```
**Get product list**
```bash
$ composer run plist
```
**Get a list of coupons**
```bash
$ composer run clist
```

### Calculate product price endpoint
```bash
curl -X POST http://127.0.0.1:8000/api/v1/calculate-price \
     -H 'Content-Type: application/json' \
     -d '{
           "product": 4,
           "taxNumber": "DE123456789",
           "couponCode": "P10"
         }'
```
### Purchase endpoint
```bash
curl -X POST http://127.0.0.1:8000/api/v1/purchase \
     -H 'Content-Type: application/json' \
     -d '{
           "product": 4,
           "taxNumber": "IT12345678900",
           "couponCode": "P10",
           "paymentProcessor": "paypal"
         }'
```