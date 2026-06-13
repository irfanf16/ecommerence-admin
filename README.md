# Multi-Vendor eCommerce — Super Admin Panel

> **Laravel 8 Blade** super-admin panel for managing a multi-vendor eCommerce marketplace. Acts as a frontend that proxies all data operations through the backend REST API (`ecommerence-api`). Manages vendor lifecycle, 3-level category hierarchy, product catalog, orders, commissions, and platform settings.

![Laravel](https://img.shields.io/badge/Laravel-8-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.0-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)

---

## Architecture

This panel does **not** query the database directly. Every controller action calls `ecommerence-api` via `mashape/unirest-php`, forwarding a session-stored auth token. It is a pure HTML frontend for the API backend.

```
Browser
  |
  v
Admin Panel (this repo — Laravel 8 Blade)
  |  All data via Unirest HTTP calls
  v
ecommerence-api (Laravel 8 REST API)
  |
  v
MySQL Database (shared with vendor + website panels)
```

---

## Tech Stack

| Package | Version | Purpose |
|---|---|---|
| `laravel/framework` | ^8.40 | Core framework |
| `mashape/unirest-php` | ^3.0 | HTTP client for API proxy calls |
| `guzzlehttp/guzzle` | ^7.0 | Secondary HTTP client |
| `laraveldaily/laravel-invoices` | ^2.0 | PDF invoice generation |

**Auth:** Custom `isStorakAdmin` middleware — checks `session('user')` and `role_id == 1`.

---

## Route Structure

All routes under `/admin/*` prefix, protected by `isStorakAdmin` middleware.

| Module | Routes |
|---|---|
| Dashboard | `GET /admin/dashboard` |
| Categories (3-level) | Resource + archive/restore/reorder/status — categories, subcategories, childcategories |
| Brands, Attributes, Variants, Keys | Resource CRUD |
| Cities | Resource |
| Products | Resource + variant management (nested), mass CSV upload, stock management, AR/EN translation |
| Product Q&A | Global list + per-product + status management |
| Product Reviews | Global list + per-product + status management |
| Vendor Management | Profiles by status (all/incomplete/under-review/approved/rejected), status update |
| Store Management | Vendor stores + customer stores |
| Buyer/Customer Management | Resource CRUD, wishlist view, cart items |
| Orders | Resource + status update + invoice PDF |
| Commissions | Index + applied commissions + update |
| Banners | Resource + archive/restore/reorder |
| Mobile Covers | Resource |
| Partners | Resource |
| Social Links | CRUD |
| Site Settings | Resource |
| App Settings | CRUD + status toggle |
| Admin Users & Roles | Resource (RBAC for sub-admins) |
| Subscribers, Contacts | Index views |
| Ajax | `/admin/ajax/categories`, `subcategories`, `childcategories`, `variants`, multi-level chained selects |

**34 controllers** in `app/Http/Controllers/Admin/`.

---

## Key Features

- **3-level category hierarchy** — category → subcategory → child category, with drag-to-reorder, soft deletes, archive/restore
- **Vendor lifecycle** — incomplete → under-review → approved/rejected workflow
- **Product management** — multi-variant SKUs, stock tracking, bilingual (AR/EN) translation, mass CSV upload
- **Commission module** — category-level commission rates, applied commission tracking
- **RBAC** — admin roles and permissions for sub-admin users
- **Invoice PDF** — order invoice streaming via `laraveldaily/laravel-invoices`
- **Banner management** — website and mobile app banners with ordering

---

## Related Repositories

| Repo | Purpose |
|---|---|
| `ecommerence-api` | Laravel 8 REST API backend (source of truth) |
| `ecommerence-vendor` | Vendor self-service portal (same DB) |
| `ecommerce-website` | Customer-facing storefront (same DB) |
