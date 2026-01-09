# Student Academic Portal (CodeName: EduSphere)

[![Status](https://img.shields.io/badge/Status-Active-success.svg)]()
[![PHP](https://img.shields.io/badge/Backend-PHP-blue.svg)]()
[![MySQL](https://img.shields.io/badge/Database-MySQL-orange.svg)]()

A comprehensive web-based platform designed to bridge the gap between students types faculty/resources at **Amrita Vishwa Vidyapeetham**. This application provides a seamless interface for accessing study materials, viewing faculty profiles, and managing student information.

---

## 🌐 Live Demo

**URL**: [http://ojasvats.wuaze.com](http://ojasvats.wuaze.com)  
**Hosting Provider**: InfinityFree  
**Status**: Live & Deployment Ready

---

## 🚀 Project Overview

This project modernizes the traditional "Student Help Desk" into a vibrant, responsive web application. It features a **Glassmorphism-inspired UI**, clean typography, and a robust PHP backend to handle user sessions and data management.

### ✨ Key Features

- **🔐 Secure Authentication**: Full Login/Signup system with password hashing and session management.
- **👤 Student Profiles**: View and edit personal and academic details in a responsive grid layout.
- **📚 Study Material Repository**: Organized tabular access to notes and drive links for all branches.
- **👨‍🏫 Faculty Directory**: Detailed, card-based pages for each department (CSE, ECE, MECH, etc.) showcasing faculty roles, qualifications, and interests.
- **💬 Feedback System**: Integrated feedback form for continuous improvement.
- **📱 Responsive Design**: Fully optimized for desktops, tablets, and mobile devices.

---

## 🛠️ Technology Stack

- **Frontend**: HTML5, CSS3 (Custom Glassmorphism), JavaScript
- **Backend**: PHP (Vanilla)
- **Database**: MySQL
- **Styling**: Custom CSS Variables, Flexbox/Grid
- **Fonts & Icons**: Google Fonts (Poppins), Material Icons

---

## 📂 Project Structure

```text
Student-Helpdesk/
├── css/             # Modern stylesheets (style_home.css, style_study.css, etc.)
├── html/            # Frontend views and PHP unified pages (index.php, study_page.html)
├── server/          # Backend logic (login.php, signup.php, db_connect.php)
├── assets/          # Images and resources
└── db_schema.sql    # Database structure
```

---

## ⚙️ Setup & Installation

1.  **Clone the Repository**

    ```bash
    git clone https://github.com/yourusername/project-name.git
    ```

2.  **Server Setup**

    - Install **XAMPP** or **WAMP**.
    - Move the project folder to `htdocs` (XAMPP) or `www` (WAMP).

3.  **Database Configuration**

    - Open phpMyAdmin.
    - Create a database named `student_help_desk_db` (or as per `db_connect.php`).
    - Import the `db_schema.sql` file provided in the root directory.

4.  **Run the Application**
    - Start Apache and MySQL modules.
    - Navigate to `http://localhost/student-helpdesk-folder/html/index.php`.

---

## 🔮 Future Enhancements

- Admin Dashboard for managing faculty and materials.
- Real-time chat integration for student-faculty interaction.
- Dark Mode toggle.

---

## 📝 License

This project is open-source and available for educational purposes.
