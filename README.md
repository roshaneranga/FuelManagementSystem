# Fuel Management System

A comprehensive web application built with Laravel for managing vehicle and fuel entry data. This system allows for tracking fuel consumption, costs, and vehicle details, with plans for advanced reporting and data visualization.

---

## 🚀 Features

### Current Core Features:
* **Vehicle Management:**
    * Add new vehicles (name, type, fuel type).
    * View details of individual vehicles.
    * Edit existing vehicle information.
    * Delete vehicles.
    * List all vehicles.
* **Fuel Entry Management:**
    * Add new fuel entries, linking them to specific vehicles.
    * Automatically calculates Fuel Amount (Liters) based on Total Cost and Fuel Price per Liter.
    * View all fuel entries.
    * View details of individual fuel entries.
    * Edit existing fuel entries.
    * Delete fuel entries.
* **Relationships:** Vehicles can have multiple associated fuel entries.

### Planned Enhancements (Future Development - TALL Stack):
* **Modern Frontend:** Integration with Tailwind CSS, Alpine.js, and Livewire for a dynamic and elegant user interface.
* **Advanced Reporting:** Comprehensive data visualization (charts) for fuel consumption trends, cost analysis, etc.
* **PDF Reporting:** Generate printable PDF reports of fuel data.
* **Excel/CSV Export:** Export fuel entry data for further analysis.
* **Dashboard:** An intuitive dashboard summarizing key metrics.

---

## 🛠️ Technologies Used

* **Backend Framework:** Laravel 12.x (PHP 8.4.x)
* **Database:** MySQL
* **Frontend (Current):** Blade Templates, Bootstrap 5, Vanilla JavaScript
* **Frontend (Planned):** Tailwind CSS, Alpine.js, Livewire
* **Version Control:** Git & GitHub

---

## ⚡ Getting Started

Follow these steps to set up the project locally on your machine.

### Prerequisites

* **XAMPP** (or equivalent like Laragon, WAMP, Docker with PHP/MySQL)
    * PHP 8.4.x
    * MySQL Database
* **Composer** (PHP dependency manager)
* **Node.js & npm** (for frontend asset compilation, primarily for planned Tailwind/Livewire)
* **Git**

### Installation Steps

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/roshaneranga/FuelManagementSystem.git](https://github.com/roshaneranga/FuelManagementSystem.git)
    cd FuelManagementSystem
    ```

2.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```

3.  **Set up Environment File:**
    ```bash
    cp .env.example .env
    ```

4.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Configure Database:**
    Open the newly created `.env` file and update your database credentials:
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=fuel_management_db # You can choose any name
    DB_USERNAME=root               # Your MySQL username (e.g., root for XAMPP)
    DB_PASSWORD=                   # Your MySQL password (empty for XAMPP root by default)
    ```
    Make sure to create the `fuel_management_db` database in your MySQL (e.g., via phpMyAdmin) before running migrations.

6.  **Run Database Migrations:**
    This will create the necessary tables in your database.
    ```bash
    php artisan migrate
    ```
    *If you encounter issues and want to reset your database, use `php artisan migrate:fresh` (this will delete all data).*

7.  **Seed Database (Optional):**
    If you have seeders (e.g., for test data), you can run them:
    ```bash
    php artisan db:seed
    ```

8.  **Install Node.js Dependencies:**
    ```bash
    npm install
    ```

9.  **Compile Frontend Assets:**
    ```bash
    npm run dev # For development
    # or npm run build # For production
    ```

10. **Start the Laravel Development Server:**
    ```bash
    php artisan serve
    ```

    The application will typically be available at `http://127.0.0.1:8000`.

---

## 🤝 Contribution

Contributions are welcome! If you have suggestions or want to contribute, please feel free to:

1.  Fork the repository.
2.  Create your feature branch (`git checkout -b feature/AmazingFeature`).
3.  Commit your changes (`git commit -m 'Add some AmazingFeature'`).
4.  Push to the branch (`git push origin feature/AmazingFeature`).
5.  Open a Pull Request.

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 📞 Contact

Roshan Eranga - [Your Email Address] - [Your LinkedIn Profile URL (Optional)]

Project Link: [https://github.com/roshaneranga/FuelManagementSystem](https://github.com/roshaneranga/FuelManagementSystem)