# Web CRUD KTP
Web untuk skilltest proses recruitment Bromindo. Berbentuk Web CRUD KTP menggunakan framework Laravel

## API Endpoints
Below are the available API endpoints:

Get all KTPs:
GET /api/ktps

Get a specific KTP by ID:
GET /api/ktps/{id}

Create a new KTP:
POST /api/ktps
Request Body (JSON):

```json {
  "nama": " ",
  "nik": " ",
  "alamat": " ",
  "tempat_lahir": " ",
  "tanggal_lahir": " "
}```
Update a KTP by ID:
PUT /api/ktps/{id}

Delete a KTP by ID:
DELETE /api/ktps/{id}

Import data from CSV:
POST /api/ktps/import
Form Data:

file: Upload a CSV file containing KTP data.
Export data to CSV:
GET /api/ktps/export/csv

Export data to PDF:
GET /api/ktps/export/pdf
