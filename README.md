# 🏥 Hospital Management System (HMS)

A modern Hospital Management System built with Laravel, designed to streamline hospital operations through role-based access for Administrators, Doctors, and Patients.

---

## 🚀 Features

### 👨‍💼 Admin Panel

* Dashboard with analytics and charts
* Manage Doctors
* Manage Patients
* Manage Appointments
* Manage Specializations
* View Reports
* System Notifications

### 👨‍⚕️ Doctor Panel

* Doctor Dashboard
* Manage Appointments
* View Assigned Patients
* Create Medical Records
* Manage Schedule & Availability
* Upload Digital Signature
* Profile Management

### 👤 Patient Panel

* Patient Dashboard
* Book Appointments
* Secure Online Payment
* View Appointment History
* Download Invoices
* View Medical Records
* Manage Health Profile
* Receive Notifications

### 🤖 AI Assistant

* Role-based HMS Assistant
* Appointment Guidance
* Medical Record Assistance
* Invoice Support
* General Health Education
* Suggested Quick Actions

### 💳 Payment Integration

* Razorpay Payment Gateway
* Secure Appointment Payments
* Payment Tracking
* Invoice Generation

### 📄 PDF Generation

* Appointment Invoices
* Medical Reports
* Doctor Signature Support

### 🔔 Notifications

* Appointment Updates
* Booking Confirmations
* Medical Record Alerts
* Read/Unread Tracking

---

## 🛠 Technology Stack

### Backend

* Laravel 12
* PHP 8.2
* MySQL

### Frontend

* Blade Templates
* JavaScript
* CSS3
* Vite

### APIs & Services

* Groq AI API
* Razorpay Payment Gateway

---

## 📂 User Roles

### Admin

* Full system access
* Doctor management
* Patient management
* Appointment monitoring
* Reports and analytics

### Doctor

* Appointment handling
* Patient management
* Medical records
* Schedule management

### Patient

* Appointment booking
* Payments
* Medical records access
* Profile management

---

## ⚙️ Installation

### Clone Repository

```bash
git clone https://github.com/Arnxb007/Hospital_Management_System
cd hospital-management-system
```

### Install Dependencies

```bash
composer install
npm install
```

### Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Configure:

```env
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

GROQ_API_KEY=

RAZORPAY_KEY_ID=
RAZORPAY_KEY_SECRET=
```

### Database

```bash
php artisan migrate
```

or import the provided SQL backup.

### Storage Link

```bash
php artisan storage:link
```

### Build Assets

```bash
npm run build
```

### Run Application

```bash
php artisan serve
```

---

## 📸 Key Modules

* Appointment Management
* Medical Record System
* Notification System
* Patient Health Profile
* Doctor Scheduling
* AI Assistant
* Invoice Management
* Dashboard Analytics

---

## 🔒 Security Features

* Authentication & Authorization
* Role-Based Access Control
* CSRF Protection
* Secure File Uploads
* Protected Medical Records

---

## 📈 Future Enhancements

* Email Notifications
* SMS Alerts
* Telemedicine Support
* Multi-Hospital Management
* Mobile Application
* Advanced Analytics

---

## 👨‍💻 Developer

Developed as a full-stack healthcare management solution using Laravel and modern web technologies.

---

## 📜 License

This project is intended for educational, academic, and portfolio purposes.
