# Storak Admin Panel

**Laravel 8 Blade** super-admin panel for the Storak multi-vendor e-commerce marketplace. Manages vendor lifecycle, 3-level category hierarchy, product moderation, order management, commissions, website content, and role-based sub-admin access. All data fetched from the Storak backend API via Unirest HTTP.

![PHP](https://img.shields.io/badge/PHP-7.3%2B-777BB4?style=flat&logo=php)
![Laravel](https://img.shields.io/badge/Laravel-8.x-FF2D20?style=flat&logo=laravel)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=flat&logo=bootstrap)
![CKEditor](https://img.shields.io/badge/CKEditor-4.x-0287D0?style=flat)
![DomPDF](https://img.shields.io/badge/DomPDF-PDF-CC0000?style=flat)
![Maatwebsite Excel](https://img.shields.io/badge/Maatwebsite-Mass_Upload-green?style=flat)

## Features

- **Vendor Lifecycle** — view all/incomplete/under-review/approved/rejected vendors; approve/reject; store management
- **Category Taxonomy** — 3-level hierarchy (Categories → Subcategories → Child Categories) with CRUD, archive/restore, drag-and-drop order, status toggle
- **Product Management** — CRUD + variants + translations + mass Excel upload + product Q&A and review moderation
- **Customer Management** — profile listing, wishlist/cart viewer, account status toggle
- **Order Management** — listing, status updates, PDF invoices
- **Commission Module** — view and update commission rules
- **Content** — banners, mobile covers, site settings, app settings, social login links, partners, subscribers, contacts
- **Access Control** — roles, permissions, sub-admin user creation
- **Cache Management** — one-click clear at `/cache`
- **Dashboard** — counts for categories, products, brands, stores, vendors, buyers + recent orders/products

## Architecture

All data via `Unirest\Request` HTTP calls to `config('app.url') . 'api/admin/...'`. Tightly coupled to Storak backend API.

## Getting Started

```bash
composer install
cp .env.example .env && php artisan key:generate
# Set APP_URL to Storak backend API URL
php artisan migrate && php artisan serve
```

## License
MIT
