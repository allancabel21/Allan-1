# Railway Deployment Quick Start

## Quick Deploy to Railway

### 1. Push to GitHub
Make sure your code is pushed to a GitHub repository.

### 2. Create Railway Project
1. Visit https://railway.app
2. Click "New Project"
3. Select "Deploy from GitHub repo"
4. Choose your repository

### 3. Railway Auto-Configuration
Railway will automatically:
- Detect it's a PHP/Laravel application
- Use the `railway.toml` configuration
- Start your application

### 4. Add MySQL Database
1. In Railway project, click "New"
2. Select "Database" → "MySQL"
3. Railway will auto-configure database connection

### 5. Configure Environment Variables

Go to your Railway project → Settings → Variables and add:

```env
APP_NAME="Alumni USTP Balubal Portal"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.railway.app
APP_KEY=base64:generate-this-with-php-artisan-key:generate
```

**Important**: After the first deployment, Railway will run `php artisan key:generate` automatically, but you can also set `APP_KEY` manually.

### 6. Database Configuration (Auto)
Railway MySQL automatically provides these variables:
- `DB_CONNECTION=mysql`
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- These are auto-configured, you don't need to set them manually

### 7. Build Logs
Check Railway logs during deployment to see:
- `composer install` progress
- Migrations running
- Application startup

## Important Production Settings

### Environment Variables to Set

```env
# Application
APP_NAME="Alumni USTP Balubal Portal"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.railway.app

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Storage
FILESYSTEM_DISK=local

# Mail (optional - configure if you need email)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@your-domain.com
MAIL_FROM_NAME="Alumni USTP Balubal Portal"
```

## After Deployment

### 1. Access Your App
Railway will provide a URL like: `https://your-app-name.up.railway.app`

### 2. First Login
- You'll need to create a user account
- Use the Database Seeder or create manually via Railway console

### 3. Railway Console
To run commands:
```bash
railway shell
# Then run artisan commands
php artisan tinker
php artisan make:seeder AdminUserSeeder
```

## Storage Warning

⚠️ **Railway's file system is ephemeral** - files are deleted on restart!

**Solutions**:
1. Use Railway's Persistent Volume (limited)
2. Use AWS S3 or cloud storage for uploads
3. Store files in the database (not recommended for large files)

For this app, consider storing uploaded images in S3 or another cloud service.

## What Happens on Deploy

1. Railway detects PHP project
2. Runs `composer install --no-dev --optimize-autoloader`
3. Runs `php artisan key:generate` (if no APP_KEY set)
4. Caches config, routes, views
5. Runs `php artisan migrate --force`
6. Starts `php artisan serve`

## Troubleshooting

### Build fails
- Check Railway build logs
- Verify `composer.json` is valid
- Ensure `railway.toml` exists

### App won't start
- Check railway logs
- Verify database connection
- Check environment variables

### Migrations fail
- Ensure database is provisioned
- Check database credentials in Railway variables
- Verify migration files exist

## Need Help?

- Railway Docs: https://docs.railway.app
- Laravel Docs: https://laravel.com/docs
- Check Railway logs for detailed error messages

