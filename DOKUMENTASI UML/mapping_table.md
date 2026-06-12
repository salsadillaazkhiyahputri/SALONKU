# Database Mapping Table - SalonKu

Berikut adalah pemetaan kolom-kolom database beserta tipe data, atribut, dan relasinya pasca-refactoring.

## 1. Tabel `users`
Menyimpan data akun baik customer maupun admin.
| Kolom | Tipe Data | Panjang | Atribut | Keterangan |
| --- | --- | --- | --- | --- |
| `id` | BigInt | 20 | PK, Auto Increment, Unsigned | Primary Key |
| `name` | Varchar | 255 | Not Null | Nama Lengkap User |
| `email` | Varchar | 255 | Not Null, Unique | Email Login |
| `phone` | Varchar | 255 | Nullable | Nomor Telepon |
| `role` | Varchar | 255 | Not Null, Default: 'customer' | Peran: 'admin' atau 'customer' |
| `password` | Varchar | 255 | Not Null | Password Hashed |
| `email_verified_at`| Timestamp | - | Nullable | Waktu Verifikasi Email |
| `remember_token` | Varchar | 100 | Nullable | Token untuk sesi remember me |
| `created_at` | Timestamp | - | Nullable | Waktu pembuatan baris |
| `updated_at` | Timestamp | - | Nullable | Waktu update baris |

## 2. Tabel `categories`
Menyimpan data kategori dan sub-kategori layanan (hirarki dengan `parent_id`).
| Kolom | Tipe Data | Panjang | Atribut | Keterangan |
| --- | --- | --- | --- | --- |
| `id` | BigInt | 20 | PK, Auto Increment, Unsigned | Primary Key |
| `parent_id` | BigInt | 20 | FK, Unsigned, Nullable | Menunjuk ke `categories(id)`, Delete Cascade |
| `name` | Varchar | 255 | Not Null | Nama Kategori / Sub-Kategori |
| `description` | Text | - | Nullable | Deskripsi |
| `image` | Varchar | 255 | Nullable | URL atau path gambar kategori |
| `created_at` | Timestamp | - | Nullable | Waktu pembuatan baris |
| `updated_at` | Timestamp | - | Nullable | Waktu update baris |

## 3. Tabel `services`
Menyimpan data sub-layanan / jasa spesifik yang dapat dipesan oleh customer.
| Kolom | Tipe Data | Panjang | Atribut | Keterangan |
| --- | --- | --- | --- | --- |
| `id` | BigInt | 20 | PK, Auto Increment, Unsigned | Primary Key |
| `category_id` | BigInt | 20 | FK, Unsigned, Not Null | Menunjuk ke `categories(id)`, Delete Cascade |
| `name` | Varchar | 255 | Not Null | Nama Layanan |
| `description` | Text | - | Nullable | Deskripsi Layanan |
| `price` | Integer | 10 | Unsigned, Not Null | Harga Layanan |
| `is_starting_price`| Boolean | 1 | Not Null, Default: false | Indikator apakah harga adalah "Mulai dari" |
| `duration_minutes` | SmallInt| 5 | Unsigned, Not Null | Durasi layanan dalam menit |
| `is_active` | Boolean | 1 | Not Null, Default: true | Status ketersediaan layanan |
| `created_at` | Timestamp | - | Nullable | Waktu pembuatan baris |
| `updated_at` | Timestamp | - | Nullable | Waktu update baris |

## 4. Tabel `stylists`
Menyimpan data stylist/pegawai salon.
| Kolom | Tipe Data | Panjang | Atribut | Keterangan |
| --- | --- | --- | --- | --- |
| `id` | BigInt | 20 | PK, Auto Increment, Unsigned | Primary Key |
| `name` | Varchar | 255 | Not Null | Nama Stylist |
| `specialty` | Varchar | 255 | Nullable | Keahlian / Spesialisasi Stylist |
| `status` | Enum | - | Not Null, Default: 'active' | Nilai: 'active', 'inactive' |
| `created_at` | Timestamp | - | Nullable | Waktu pembuatan baris |
| `updated_at` | Timestamp | - | Nullable | Waktu update baris |

## 5. Tabel `reservations`
Menyimpan data transaksi/booking yang dilakukan user.
| Kolom | Tipe Data | Panjang | Atribut | Keterangan |
| --- | --- | --- | --- | --- |
| `id` | BigInt | 20 | PK, Auto Increment, Unsigned | Primary Key |
| `user_id` | BigInt | 20 | FK, Unsigned, Not Null | Menunjuk ke `users(id)`, Delete Cascade |
| `reservation_date` | Date | - | Not Null | Tanggal Reservasi |
| `start_time` | Time | - | Not Null | Jam Mulai Reservasi |
| `total_price` | Integer | 10 | Unsigned, Default: 0 | Total Biaya Seluruh Service |
| `status` | Enum | - | Not Null, Default: 'pending'| Nilai: 'pending', 'confirmed', 'completed', 'cancelled' |
| `notes` | Text | - | Nullable | Catatan Tambahan dari Customer |
| `created_at` | Timestamp | - | Nullable | Waktu pembuatan baris |
| `updated_at` | Timestamp | - | Nullable | Waktu update baris |

## 6. Tabel Pivot `reservation_service`
Menyimpan relasi Many-to-Many antara `reservations` dan `services` (Satu transaksi bisa memiliki banyak layanan).
| Kolom | Tipe Data | Panjang | Atribut | Keterangan |
| --- | --- | --- | --- | --- |
| `id` | BigInt | 20 | PK, Auto Increment, Unsigned | Primary Key |
| `reservation_id` | BigInt | 20 | FK, Unsigned, Not Null | Menunjuk ke `reservations(id)`, Delete Cascade |
| `service_id` | BigInt | 20 | FK, Unsigned, Not Null | Menunjuk ke `services(id)`, Delete Cascade |
| `created_at` | Timestamp | - | Nullable | Waktu pembuatan baris |
| `updated_at` | Timestamp | - | Nullable | Waktu update baris |

## 7. Tabel Pivot `reservation_stylist`
Menyimpan relasi Many-to-Many antara `reservations` dan `stylists` beserta penguncian slot jadwal (`slot_hash`).
| Kolom | Tipe Data | Panjang | Atribut | Keterangan |
| --- | --- | --- | --- | --- |
| `id` | BigInt | 20 | PK, Auto Increment, Unsigned | Primary Key |
| `reservation_id` | BigInt | 20 | FK, Unsigned, Not Null | Menunjuk ke `reservations(id)`, Delete Cascade |
| `stylist_id` | BigInt | 20 | FK, Unsigned, Not Null | Menunjuk ke `stylists(id)`, Delete Cascade |
| `slot_hash` | Varchar | 255 | Unique, Nullable | Hash Unik pencegah double-booking (StylistID\|Tanggal\|Jam). Dikosongkan jika batal. |
| `created_at` | Timestamp | - | Nullable | Waktu pembuatan baris |
| `updated_at` | Timestamp | - | Nullable | Waktu update baris |
