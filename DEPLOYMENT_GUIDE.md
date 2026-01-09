# 🚀 Deployment Guide: InfinityFree

This guide will help you upload your **Student Help Desk (EduSphere)** website to the internet using **InfinityFree** (a free PHP hosting provider).

---

## Step 1: Create an Account & Database

1.  Go to [InfinityFree.com](https://www.infinityfree.com/) and Sign Up.
2.  **Create an Account**: Choose a free subdomain (e.g., `edusphere.rf.gd`).
3.  **Open Control Panel (vPanel)**: Once created, click "Manage" and then "Control Panel".
4.  **Create Database**:
    - Click on **"MySQL Databases"**.
    - Enter a database name (e.g., `helpdesk`) and click **"Create Database"**.
    - **STOP & SAVE THESE DETAILS**:
      - **MySQL Host Name**: (e.g., `sql306.infinityfree.com`)
      - **MySQL User Name**: (e.g., `if0_37123456`)
      - **MySQL Password**: (Your vPanel password)
      - **MySQL Database Name**: (e.g., `if0_37123456_helpdesk`)

---

## Step 2: Import Your Database

1.  In the standard vPanel, click on **"phpMyAdmin"**.
2.  Click "Connect Now" next to your new database.
3.  Click the **"Import"** tab at the top.
4.  Click **"Choose File"** and select `db_schema.sql` from your project folder.
5.  Click **"Go"** at the bottom.
    - _Success! Your tables (users, feedback, etc.) are now made._

---

## Step 3: Upload Your Files

1.  Go back to the **Client Area** (not vPanel) and click **"File Manager"**.
2.  Open the **`htdocs`** folder.
    - _Delete the default `index2.html` or welcome file if you see one._
3.  **Upload**:
    - **CRITICAL**: Delete `html/profile_page.html` from your htdocs if it exists.
    - Upload the NEW `html/profile_page.php`.
    - Upload the UPDATED `server/` folder (login.php, signup.php, profile.php).
    - **Structure**:
      ```text
      /htdocs
         /assets
         /css
         /html
            /profile_page.php (Not .html)
         /server
         index.php
      ```

---

## Step 4: Configure the Connection

1.  In the File Manager, go to **`server/db_connect.php`**.
2.  Right-click and select **"Edit"**.
3.  **Change `$is_local` to `false`**:
    ```php
    $is_local = false;
    ```
4.  **Fill in your details** (from Step 1):
    ```php
    $servername = "sql306.infinityfree.com";
    $username   = "if0_37123456";
    $password   = "YOUR_PASSWORD";
    $dbname     = "if0_37123456_helpdesk";
    ```
5.  Click **"Save"**.

---

## Step 5: Test It!

Visit your website URL (e.g., `edusphere.rf.gd`).

- It should automatically redirect you to the Login/Home page.
- Try Logging in or Signing up to test the database connection.

---

### 🆘 Troubleshooting

- **"Connection Failed" Error**: Double-check the password and Hostname in `db_connect.php`. InfiniteFree passwords are often different from your login password (check the "MySQL Details" section).
- **404 Not Found**: Make sure your `index.php` is directly inside `htdocs`.
