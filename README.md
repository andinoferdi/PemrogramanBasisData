
# Laravel Inventory Management System

This project is a **Web Application for Managing Procurement, Sales, Receipt, Stock, and Returns of Goods** built with **Laravel** framework. The application provides a seamless way to manage inventory data, transactions, and reporting.

## Features

### Core Modules
- **User Management**:
  - Create, Read, Update, Delete users with different roles.
- **Procurement Management**:
  - Record procurement transactions, including vendors and items.
  - Calculate totals with tax inclusion (PPN).
- **Stock Receipt Management**:
  - Record received items from procurement.
  - Automatically update stock in the system.
- **Sales Management**:
  - Record sales transactions.
  - Automatically reduce stock based on sold items.
- **Return Management**:
  - Handle returned goods and adjust stock accordingly.
- **Stock Card**:
  - Track stock movements (in and out) for each item.

### Key Functionalities
- **Data Validation**: Ensures transactions like receipts and sales respect stock availability.
- **Triggers and Stored Procedures**:
  - Automatically update stock card for every transaction.
  - Validate data integrity across all modules.
- **Custom Views**:
  - For reporting purposes, including a detailed stock card view.

## Installation

### Requirements
- PHP 8.0 or higher
- MySQL 8.0 or higher
- Composer
- Laravel 9.x

## Usage

### User Roles
- **Admin**: Full access to all modules and data.

### Workflow
1. **Procurement**:
   - Admin records procurement with vendor details and item quantities.
2. **Stock Receipt**:
   - Admin/Staff records received items against procurement.
   - Updates stock automatically.
3. **Sales**:
   - Staff records sales transactions, reducing stock.
4. **Returns**:
   - Staff records returned items, adjusting stock accordingly.
5. **Stock Card**:
   - Admin views detailed stock movements for each item.

## Contributing
Contributions are welcome! Please follow the [contribution guide](CONTRIBUTING.md).

## License
This project is open-source and licensed under the [MIT license](https://opensource.org/licenses/MIT).
