# ESSU Library System

Welcome to the ESSU Library System project! This document will guide you through the steps to set up and run the website locally using XAMPP.

## Prerequisites

Before getting started, make sure you have the following installed on your machine:

- [XAMPP](https://www.apachefriends.org/index.html)
- [Git for Windows](https://git-scm.com/downloads)

## Setup Instructions
0. Set `allow_url_include` in your "php.ini" to "On", here is a guide to that: [Enable allow_url_include video](https://www.youtube.com/watch?v=WV9YJmxlJpI&ab_channel=ITSECLABHUN).
1. **Open your Command Promt on your windows computer, press `win + R` then type `cmd` and press enter**.
2. **Change directory to Desktop Folder (so we can easily access our file):**
    ```
    cd Desktop
    ```
3. **Clone the Repository and open it with VS Code:**
    ```
    git clone https://github.com/MarkChito/ESSU-Library-System.git
    ```
    - Or just download the zip file directly from the github repository.
4. **Import the Database:**
    - Launch your preferred web browser and navigate to http://localhost/phpmyadmin.
    - Create a new database named essu_library_system.
    - Click on the newly created database in the left sidebar.
    - Choose the "Import" tab and upload the essu_library_system.sql file from the database_file folder.
    - Click "Go" to import the database.
5. **Copy or Move the whole folder "ESSU-Library-System" from your "Desktop" folder to "C:\xampp\htdocs\" folder**
6. **Start XAMPP:**
   - Open XAMPP and start the Apache and MySQL.
7. **Run the Website:**
   - Open your web browser and go to http://localhost/ESSU-Library-System.
8. **Administrator Account:**
   - Username: admin
   - Password: admin123
