# Railway Deployment Guide

This guide will help you deploy the Alumni USTP Balubal Portal to Railway.

## Prerequisites

- A Railway account (https://railway.app)
- A GitHub repository with this code
- MySQL database (Railway will provide this)

## Deployment Steps

### 1. Prepare Your Repository

The following files have been created for Railway deployment:
- `railway.toml` - Railway configuration
- `Procfile` - Application startup command
- `.env.example` - Environment variables template

### 2. Create a New Railway Project

1. Go to [Railway Dashboard](https://railway.app)
2. Click "New Project"
3. Select "Deploy from GitHub repo"
4. Choose your repository

### 3. Add Database

1. In your Railway project, click "New"
2. Select "Database" → "MySQL"
3. Railway will create a MySQL database and provide connection details

### 4. Configure Environment Variables

In Railway project settings, add these environment variables:

```env
APP_NAME="Alumni USTP Balubal Portal"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.railway.app

# Database (provided by Railway MySQL service)
DB_CONNECTION=mysql
DB_HOST=your-mysql-host.railway.app
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=your-password

# Session Configuration
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache Configuration
CACHE_STORE=database

# Queue Configuration
QUEUE_CONNECTION=database

# Storage Configuration
FILESYSTEM_DISK=local

# Mail Configuration (update with your SMTP settings)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@your-domain.com
MAIL_FROM_NAME="Alumni USTP Balubal Portal"
```

### 5. Deploy

Railway will automatically:
1. Install PHP dependencies
2. Run database migrations
3. Start the application

### 6. Build Configuration

Railway will use the `railway.toml` file which:
- Uses Nixpacks to detect and build your PHP application
- Runs `composer install --no-dev --optimize-autoloader`
- Caches configuration, routes, and views for better performance
- Runs migrations on each deployment

### 7. Post-Deployment

1. **Create Admin User**: You'll need to create an admin user. You can do this by:
   - Running `php artisan tinker` in Railway console
   - Or creating a database seeder

2. **Set up File Storage**: 
   - Railway's ephemeral storage is limited
   - Consider using S3 or another cloud storage for user uploads

3. **Configure Custom Domain** (Optional):
   - In Railway project settings, go to "Settings" → "Domain"
   - Add your custom domain

## Important Notes

### Database Migrations
- Migrations run automatically on each deployment via the `Procfile`
- The `--force` flag ensures migrations run in production

### Storage
- Railway's file system is ephemeral (files are deleted on restart)
- For production, consider:
  - Using S3 for file uploads
  - Adding persistent volume for storage
  - Or implementing cloud storage

### Environment Variables
- Never commit `.env` file to git
- All sensitive data should be in Railway environment variables
- Database credentials are auto-provided by Railway MySQL service

### Debugging

If you encounter issues:
1. Check Railway logs in the dashboard
2. Verify all environment variables are set
3. Ensure database migrations completed successfully
4. Check that `APP_URL` matches your Railway domain

### Useful Commands

Run these in Railway's console:
- `php artisan config:clear` - Clear config cache
- `php artisan cache:clear` - Clear application cache
- `php artisan route:list` - List all routes
- `php artisan tinker` - Interactive shell

## Security Checklist

- [ ] `APP_DEBUG=false` in production
- [ ] `APP_ENV=production` in production
- [ ] Strong `APP_KEY` generated
- [ ] Database credentials kept secure
- [ ] Mail configuration set up
- [ ] HTTPS enabled (Railway provides this by default)

## Monitoring

Railway provides:
- Build logs
- Application logs
- Resource monitoring
- Deployment history

Check these regularly for issues or performance problems.

