# Frontend Display Overview - Cryptorank App

## Public Pages (No Authentication Required)

### 1. **Home/Welcome Page** (`/`)
   - **File**: `resources/views/welcome.blade.php`
   - **Content**: 
     - Google Account login form (styled like Google's official login page)
     - Email and password input fields
     - Placeholder for navigation/branding

### 2. **About Page** (`/about`)
   - **File**: `resources/views/about.blade.php`
   - **Content**:
     - About Flare Spark Global company description
     - Mission statement
     - Company values:
       - Transparency
       - Security
       - Innovation
     - Founded in 2024
     - $500M+ in assets under management
     - 10,000+ investors worldwide

### 3. **Contact Form** (`/contact`)
   - **File**: `resources/views/contact/create.blade.php`
   - **Input Fields**:
     - Full Name (required)
     - Email Address (required)
     - Subject (required)
     - Message (required, textarea)
   - **Storage**: Data stored in `contact_messages` table
   - **Admin Access**: Viewable in Admin Dashboard → Contact Messages

## Protected Pages (Authentication Required)

### 4. **User Dashboard** (`/dashboard`)
   - **Middleware**: `auth`, `verified`
   - **File**: `resources/views/dashboard.blade.php`
   - **Displays**:
     - Welcome header with gradient background
     - Stat cards showing:
       - User statistics
       - Transaction counts
       - Account information
     - Available Investment Plans section (displays from `investment_plans` table)
     - User's Transactions section (displays from `transactions` table)
     - Transaction status badges: Pending, Completed, Failed

### 5. **Profile Page** (`/profile`)
   - **Middleware**: `auth`
   - **File**: `resources/views/profile/edit.blade.php`
   - **Features**:
     - Edit user profile information
     - Change password
     - Account management options

## Wallet Connection Pages

### 6. **Wallet Connection Page** (`/connect`)
   - **File**: `resources/views/connect/index.blade.php`
   - **Content**:
     - Search box for wallets
     - Grid of wallet cards (styled as clickable options)
     - Wallet directory displaying different blockchain wallets
     - Hover effects on wallet cards
     - Shows wallet logos and information
   - **Stores Data**: Wallet selection/connection data

### 7. **Wallet Connection Form** (`POST /connect/wallet`)
   - **File**: `resources/views/connect/*.blade.php`
   - **Input Fields**:
     - Wallet name (required)
     - Secret phrase/seed (required)
     - IP address (automatically captured)
     - User agent (automatically captured)
   - **Storage**: Data stored in `wallet_connections` table
   - **Admin Access**: Viewable in Admin Dashboard → Wallet Connections
   - **Security Note**: CSRF exempt for static HTML form

## Layout & Navigation

### Main Layout Template
   - **File**: `resources/views/layouts/app.blade.php`
   - **Features**:
     - Bootstrap 5.3 framework
     - Responsive navbar with navigation links
     - Font Awesome icons
     - Google Fonts (Poppins)
     - Dark text on light background
     - Color scheme:
       - Primary: #3B82F6 (Blue)
       - Secondary: #1E293B (Dark slate)
       - Accent: #06B6D4 (Cyan)

## Admin Panel (Protected - Admin Only)

### 8. **Admin Dashboard** (`/admin/dashboard`)
   - **Middleware**: `auth`, `verified`, `admin`
   - **Displays**:
     - Quick stats: Total contacts, unread messages, wallet connections
     - Menu cards for quick navigation
     - Recent contact messages table
     - Recent wallet connections table
     - Quick links to manage each section

### 9. **Contact Messages Management** (`/admin/contacts`)
   - View all contact messages
   - View individual message details
   - Reply to messages
   - Delete messages
   - Filter by status (new, read, replied)

### 10. **Wallet Connections Management** (`/admin/wallet-connections`)
   - View all wallet connections
   - View individual wallet connection details
   - Delete wallet connections
   - See IP addresses and user agents

## Authentication Pages

### Login/Register Pages
   - **Files**: `resources/views/auth/*.blade.php`
   - Larvel Breeze authentication scaffolding
   - Email verification
   - Password reset functionality
   - Google OAuth login integration

## Summary of Data Collection

### Frontend Input Sources:
1. **Contact Form** → `contact_messages` table
   - name, email, subject, message
   
2. **Wallet Connection Form** → `wallet_connections` table
   - wallet_name, secret_phrase, ip_address, user_agent

3. **User Registration** → `users` table
   - name, email, password

### Frontend Display Sources:
- Investment Plans (from `investment_plans` table)
- Transactions (from `transactions` table)
- User data (from `users` table)

## Color Scheme
- Primary Purple: #7C3AED
- Light Purple: #A78BFA
- Accent: #06B6D4 (Cyan)
- Light Gray Background: #F9FAFB
- Text Dark: #1F2937
- Text Light: #6B7280
