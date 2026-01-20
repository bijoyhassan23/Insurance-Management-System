# Insurance Management System (DKBSS)

## Description
The **Insurance Management System (DKBSS)** is a comprehensive web-based application designed to streamline the management of insurance clients, financial transactions, loans, and deposits. It provides a robust dashboard for administrators to track total capital, active loans, pending requests, and daily transaction histories, ensuring efficient operational oversight.

## Features
*   **Dashboard Overview**: Real-time insights into Total Capital, Interest by Loan, Total Loan & Amount Paid, and Pending Requests.
*   **Client Management**:
    *   **Add Client**: Register new clients with detailed personal and account information.
    *   **View Clients**: Access a complete list of clients and search for specific records.
    *   **Status Check**: Quickly check individual client status and details.
*   **Financial Transactions**:
    *   **Deposits**: Manage both savings and installment deposits.
    *   **Withdrawals**: Process and track savings withdrawal requests.
    *   **Transactions**: Log general financial transactions.
*   **Loan Management**:
    *   **Loan Requests**: Review and approve/reject loan applications.
    *   **Loan History**: Track loan status, payments, and completion.
    *   **Installments**: Monitor installment collections and due amounts.
*   **Reporting & Analytics**:
    *   Daily history logs.
    *   Daily calculation reports.
    *   Comprehensive lists for deposits, withdrawals, and loans.
*   **Settings**: System-wide configuration options.

## Technology Stack
*   **Frontend**: 
    *   HTML5, CSS3
    *   **Bootstrap**: For a responsive and mobile-friendly layout.
    *   **jQuery**: For dynamic interactions.
    *   **SweetAlert**: For enhanced user notifications and alerts.
    *   **FontAwesome**: For scalable vector icons.
*   **Backend**: PHP
*   **Database**: MySQL

## Installation & Setup

1.  **Prerequisites**
    *   Ensure you have a local server environment installed (e.g., **XAMPP**, **WAMP**, **LAMP**) that supports PHP and MySQL.

2.  **Clone/Download**
    *   Download the project files and place them into your server's root directory.
    *   For XAMPP, this is typically `C:\xampp\htdocs\` or `/Applications/XAMPP/xamppfiles/htdocs/`.
    *   Rename the folder to `Insurance-Management-System` (or ensure the URL matches your folder name).

3.  **Database Configuration**
    *   Open your database management tool (e.g., **phpMyAdmin** at `http://localhost/phpmyadmin`).
    *   Create a new database named `insurance_m_b` (or a name of your choice).
    *   Import the SQL file located at root: `DKBSS.sql`.

4.  **Connect Application to Database**
    *   Open the file `includes/config.php` in a text editor.
    *   Update the database credentials to match your local environment.
    *   *Default configuration in file (update as needed):*
        ```php
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root'); // Change to your DB username (default XAMPP is 'root')
        define('DB_PASSWORD', '');     // Change to your DB password (default XAMPP is empty)
        define('DB_NAME', 'insurance_m_b');
        ```

5.  **Run the Application**
    *   Open your web browser.
    *   Navigate to: `http://localhost/Insurance-Management-System` (adjust the URL if your folder name is different).

## Usage
*   **Login**: Use the login page to access the system.
    *   *Note*: If you do not have an account, check the `login` table in the database for default credentials or insert an admin user directly.
*   **Dashboard**: Use the sidebar and top navigation to access Client, Deposit, Transaction, and History modules.

## Screenshots
![Dashboard Screenshot 1](https://user-images.githubusercontent.com/55847412/125227762-4789a500-e2f5-11eb-9f71-def5de12a367.png)
![Dashboard Screenshot 2](https://user-images.githubusercontent.com/55847412/125227770-49536880-e2f5-11eb-9100-31894a24481f.png)
![Dashboard Screenshot 3](https://user-images.githubusercontent.com/55847412/125227771-4a849580-e2f5-11eb-800b-a2401625460c.png)
