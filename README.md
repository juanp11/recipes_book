# Recipes Book

Web application to manage cooking recipes with their ingredients, built with Laravel.

## Prerequisites

- PHP >= 8.2
- Composer
- MySQL or MariaDB (or any other database supported by Laravel)
- Node.js and NPM (for frontend assets)

> **Note:** This project uses MySQL as the primary database, but thanks to Laravel's migration system, it can work with other databases such as PostgreSQL, SQLite, or SQL Server with minimal configuration changes.

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/juanp11/recipes_book.git
cd recipes_book
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node.js dependencies

```bash
npm install
```

### 4. Configure environment file

Copy the `.env.example` file to `.env`:

```bash
copy .env.example .env
```

Edit the `.env` file and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=recipes_book
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Create the database

Create the database in MySQL:

```sql
CREATE DATABASE recipes_book;
```

### 7. Run migrations

Execute migrations to create tables in the database:

```bash
php artisan migrate
```

This will create the following tables:
- `users` - System users
- `recipes` - Recipes
- `ingredients` - Ingredients
- `recipe_ingredients` - Relationship between recipes and ingredients (with quantities)


### 9. Compile assets

For development:
```bash
npm run dev
```

For production:
```bash
npm run build
```

## Running the Server

Start the Laravel development server:

```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

## Database Structure

### Table: recipes
- `id` - Recipe ID
- `title` - Recipe title
- `instructions` - Preparation instructions
- `preparation_time` - Preparation time
- `servings` - Number of servings

### Table: ingredients
- `id` - Ingredient ID
- `name` - Ingredient name
- `unit` - Unit of measurement (grams, liters, etc.)

### Table: recipe_ingredients
- `recipe_id` - Recipe ID
- `ingredient_id` - Ingredient ID
- `quantity` - Ingredient quantity

## Features

- ✅ Create, list and view recipes
- ✅ Manage ingredients
- ✅ Associate multiple ingredients to each recipe
- ✅ Specify ingredient quantities per recipe
- ✅ View list of recipes and ingredients

## Technologies Used

- **Backend:** Laravel 11
- **Frontend:** Blade Templates, Bootstrap 5
- **Database:** MySQL
- **Build Tools:** Vite

## Architecture and Implementation Details

### Many-to-Many Relationship

The many-to-many relationship between recipes and ingredients is implemented through a pivot table called `recipe_ingredients`. This table connects both the `recipes` and `ingredients` tables using their respective IDs, and also stores the quantity of each ingredient needed for a specific recipe.

### Application Logic

**Ingredients Management:**
- The `ingredients` table is populated independently, allowing you to create and manage ingredients separately from recipes.

**Recipe Creation:**
- A single form is used to create recipes, which handles both recipe data and ingredient associations.
- The form features a dynamic interface that allows users to add or remove ingredients before saving the recipe.
- Users can specify the quantity for each ingredient directly in the form.

**Data Processing Flow:**
1. When the form is submitted, the recipe data (title, instructions, preparation time, and servings) is saved first to the `recipes` table.
2. The system retrieves the newly created recipe's ID.
3. The ingredients and their quantities are received as arrays from the form.
4. The system iterates through these arrays and inserts each ingredient into the `recipe_ingredients` pivot table with:
   - The recipe ID
   - The ingredient ID
   - The quantity specified for that ingredient

This approach ensures data integrity and allows for flexible recipe creation with multiple ingredients in a single operation.

### Recipe Cost Calculation

To calculate the total cost of a recipe, the system performs the following operations:

1. **Database Query:** Queries the `recipe_ingredients` table filtering by recipe ID, performing a JOIN with the `ingredients` table using the ingredient ID.

2. **Cost Calculation:** Iterates through the retrieved ingredients and:
   - Multiplies the quantity from the `recipe_ingredients` table by the cost from the `ingredients` table
   - Creates a new array that includes the ingredient data plus the calculated cost for that specific quantity
   - Accumulates the individual ingredient costs to calculate the total recipe cost

3. **Result:** Returns both the detailed cost breakdown per ingredient and the total cost of the recipe.

This calculation method provides transparency in recipe pricing and helps users understand the cost distribution across different ingredients.

**Reusability:** This cost calculation logic is implemented as a reusable function that can be called from different parts of the application, such as:
- The recipe listing page (to display the total cost for each recipe in the list)
- Individual recipe detail pages (to show both the total cost and the cost breakdown per ingredient)


