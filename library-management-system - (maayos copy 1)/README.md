# Library Management System

A complete library management system built with Laravel 11, featuring book management, borrowing tracking, fine calculations, and administrative reports.

## Features

- **User Authentication**: Login and registration system with role-based access control
- **Book Management**: Add, edit, and manage books with categories
- **Borrower Management**: Register and manage library members
- **Book Borrowing**: Track book borrowing with due dates and fine calculation
- **Overdue Detection**: Automatic detection and tracking of overdue books
- **Fine System**: Automatic fine calculation based on overdue days
- **Reports**: 
  - Borrowing history reports
  - Overdue book reports
  - Fine collection reports
  - Activity logs
  - Borrower statistics
- **User Dashboard**: View personal borrowing history and profile

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL or SQLite
- Node.js and npm (optional, for frontend assets)

## Installation

### Step 1: Clone or Extract the Project

```bash
cd C:\xampp\htdocs\library-management-system
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Setup Environment File

```bash
copy .env.example .env
```

Then edit the `.env` file and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_db
DB_USERNAME=root
DB_PASSWORD=
```

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

### Step 5: Run Migrations

```bash
php artisan migrate
```

### Step 6: Create Admin User (Optional)

```bash
php artisan tinker
```

Then in the tinker prompt, type:

```php
App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin'
]);

exit
```

### Step 7: Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Database Schema

### Tables

- **users**: User accounts with role-based access (admin/user)
- **categories**: Book categories
- **books**: Book inventory with ISBN, title, author, quantity, available count
- **borrowers**: Library member profiles with membership ID
- **book_transactions**: Tracking of book borrowing and returning with fines
- **activity_logs**: System activity tracking for audit purposes

## Usage

### For Admins

1. Login with admin credentials at `/login`
2. Access admin dashboard at `/admin/dashboard`
3. Manage books, categories, and borrowers
4. Process book borrowing and returns
5. View overdue books and generate reports

### For Users

1. Register at `/register` or request admin to create account
2. Login to personal dashboard
3. View borrowing history
4. Search available books
5. View profile and membership information

## File Structure

```
library-management-system/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
├── database/
│   └── migrations/
├── resources/
│   └── views/
│       ├── admin/
│       ├── user/
│       └── auth/
├── routes/
├── config/
└── public/
```

## API Endpoints (if applicable)

### Authentication
- `POST /login` - User login
- `POST /register` - User registration
- `POST /logout` - User logout

### Admin Routes
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/books` - List books
- `POST /admin/books` - Create book
- `GET /admin/books/{id}/edit` - Edit book
- `PUT /admin/books/{id}` - Update book
- `DELETE /admin/books/{id}` - Delete book

### Borrowing Routes
- `GET /admin/borrow` - Borrow form
- `POST /admin/borrow` - Process borrowing
- `POST /admin/return` - Return book
- `GET /admin/overdue` - View overdue books

### Reports Routes
- `GET /admin/reports/fine` - Fine reports
- `GET /admin/reports/borrowing` - Borrowing history
- `GET /admin/reports/overdue` - Overdue reports
- `GET /admin/reports/activity` - Activity logs
- `GET /admin/reports/borrower-statistics` - Borrower statistics

## Configuration

### Fine Calculation

Fine is calculated as: `(overdue_days × 5)` per book

You can modify this in `app/Models/BookTransaction.php` in the `calculateFine()` method.

### Borrowing Duration

Default borrowing period is 14 days. Modify in:
- `app/Http/Controllers/BookTransactionController.php`
- Change the `due_date` calculation logic

## Troubleshooting

### Composer Install Issues

If you get "composer.json not found":
1. Ensure you're in the correct directory
2. Check that all files were extracted properly
3. Run: `composer install`

### Database Connection Error

1. Verify MySQL is running (via XAMPP control panel)
2. Check `.env` file database credentials
3. Ensure the database `library_db` exists or create it manually

### Migration Errors

If migrations fail:
```bash
php artisan migrate:reset
php artisan migrate
```

### Permission Issues

Make sure `storage/` and `bootstrap/cache/` directories have write permissions:

```bash
chmod -R 777 storage bootstrap/cache
```

## Support

For issues or questions, please check the logs in `storage/logs/laravel.log`

## License

MIT License - See LICENSE file for details
