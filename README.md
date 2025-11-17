# 🛒 E-Commerce Shopping Cart (Laravel + PostgreSQL)

A full-stack e-commerce shopping cart application built using **Laravel**, **PHP**, and **PostgreSQL**.  
This project includes product management, a session-based cart, a checkout workflow, and a simple built-in admin interface for managing products.

---

##  Features

### Product Management (Admin)
- Add new products with:
  - SKU  
  - Name  
  - Description  
  - Price  
  - Image URL  
- Edit product details  
- Delete products  
- View all products stored in the database  

---

### Shopping Cart
- Browse all available products  
- View detailed product pages  
- Add items to cart  
- Update item quantities  
- Remove items from cart  
- Cart stored in session (one cart per user)

---

### Checkout
- Enter basic shipping information  
- Convert cart into an order  
- Save order and purchased items in PostgreSQL  

---

## Tech Stack
- **Laravel 10**  
- **PHP 8+**  
- **PostgreSQL** (managed using DBeaver)  
- **Blade Templates**  
- **Bootstrap 5**  
- **Eloquent ORM**

---

## Database Structure

### Tables:
- `products`
- `carts`
- `cart_items`
- `orders`
- `order_items`

### Product fields include:
- SKU  
- Name  
- Description  
- Price  
- Image URL  

---

##  Installation

### 1. Clone the repository
```bash, git clone https://github.com/YOUR-USERNAME/ecommerce-cart.git, cd ecommerce-cart

git clone https://github.com/YOUR-USERNAME/ecommerce-cart.git
cd ecommerce-cart

