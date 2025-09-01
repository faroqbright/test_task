# Centralized Company Search & Reports

A Laravel + Blade + TailwindCSS application for centralized company search, company details, and cart functionality.  
Supports **four country-specific company databases** (Singapore, Mexico, Philippines, Malaysia) with country-specific report logic.

---

## 🚀 Installation

Clone the repository and install dependencies:

```bash
composer install
npm install
npm run build
```

1. Environment Setup

    DB_SG_CONNECTION=mysql
    DB_SG_HOST=127.0.0.1
    DB_SG_PORT=3306
    DB_SG_DATABASE=companies_house_sg
    DB_SG_USERNAME=root
    DB_SG_PASSWORD=

DB_MX_CONNECTION=mysql
DB_MX_HOST=127.0.0.1
DB_MX_PORT=3306
DB_MX_DATABASE=companies_house_mx
DB_MX_USERNAME=root
DB_MX_PASSWORD=

DB_PH_CONNECTION=mysql
DB_PH_HOST=127.0.0.1
DB_PH_PORT=3306
DB_PH_DATABASE=companies_house_ph
DB_PH_USERNAME=root
DB_PH_PASSWORD=

DB_MY_CONNECTION=mysql
DB_MY_HOST=127.0.0.1
DB_MY_PORT=3306
DB_MY_DATABASE=companies_house_my
DB_MY_USERNAME=root
DB_MY_PASSWORD=

1. Database Setup
   Run migrations for each country:

php artisan migrate:fresh --database=sg --path=/database/migrations/sg
php artisan migrate:fresh --database=my --path=/database/migrations/my
php artisan migrate:fresh --database=ph --path=/database/migrations/ph
php artisan migrate:fresh --database=mx --path=/database/migrations/mx

2. Seed demo data
   php artisan db:seed
