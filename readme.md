# Laravel SIM QC App Setup

Buat Database Baru:

Atur koneksi database di file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quality_control
DB_USERNAME=root
DB_PASSWORD=
```

Import database dengan menjalankan:
```bash
php artisan migrate --seed
```

Seeder akan membuat 3 user:

| Name       | Password     |
|------------|--------------|
| Admin QC   | Rahasia123$  |
| Pimpinan   | password     |
| QC Inline  | password     |

Login menggunakan **name** dan **password**.

Jalankan server lokal:
```bash
php artisan serve
```

Buka browser dan akses: http://localhost:8000
