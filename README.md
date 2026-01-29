**Elderly Care Home Management System**

## 📋 **Project Overview**
A comprehensive web-based database management system designed to streamline operations in elderly care facilities. The system automates resident management, room allocation, medical records, and visitor scheduling using advanced Database Administration (DBA) concepts.


## 🚀 **Features**

### **Core Modules:**
1. **Resident Management** - Complete CRUD operations for resident records
2. **Room Management** - Floor-wise room allocation with real-time status
3. **Medical Records** - Medication history and health tracking
4. **Visitor Management** - Scheduling and logging system
5. **Admin Dashboard** - Advanced DBA utilities and reporting

### **Advanced DBA Features:**
- ETL Operations (CSV import/export)
- Horizontal Fragmentation
- Stored Procedures
- Materialized Views
- Partitioned Queries

---

## 🖼️ **System Screenshots**

### **1. Main Dashboard**
<img width="554" height="246" alt="image" src="https://github.com/user-attachments/assets/6ee6e772-269d-466c-9cfe-74ae8d72ec6d" />

*Dashboard showing system overview with resident statistics and quick access modules*

### **2. Resident Management**
<img width="499" height="215" alt="image" src="https://github.com/user-attachments/assets/cfe59948-f4cd-484c-9c20-f8e569b6bf02" />

*Resident records interface with search, filter, and CRUD operations*

### **3. Medication Management**
<img width="385" height="168" alt="image" src="https://github.com/user-attachments/assets/8e8b73e6-5c02-4afe-9c43-681f15264af2" />

*Medication schedule and alerts for residents*

### **4. Medication alters**
<img width="352" height="158" alt="image" src="https://github.com/user-attachments/assets/530a93cf-948c-481a-8a7d-581c7bae44fa" />

### **5. Medical History**
<img width="727" height="210" alt="image" src="https://github.com/user-attachments/assets/e9071c57-494f-4bee-a8d8-43d510f59710" />

*Complete medical history and treatment records for each resident*

### **6. Dietary Plans**
<img width="609" height="187" alt="image" src="https://github.com/user-attachments/assets/534fbbc3-7895-4825-80cc-4eb1547e0635" />

*Nutritional plans and dietary requirements tracking*

### **7. Room Management**
<img width="555" height="198" alt="image" src="https://github.com/user-attachments/assets/6bc43d12-8d53-41eb-85f1-a6c8e389a348" />

*Floor-wise room allocation with occupancy status indicators*

### **8. Family visits**
<img width="412" height="119" alt="image" src="https://github.com/user-attachments/assets/bbd306fb-7be0-4942-8ea8-6bf3a06d5a0b" />
<img width="353" height="163" alt="image" src="https://github.com/user-attachments/assets/5fa7dfac-1575-4f7c-8b39-8e1060a409fd" />

### **9. Reports**
<img width="586" height="243" alt="image" src="https://github.com/user-attachments/assets/8744948a-6985-499d-b4c6-d7c768f2f243" />

### **10. Admin Panel**
<img width="572" height="249" alt="image" src="https://github.com/user-attachments/assets/803d0b07-edc9-44b8-848c-da91ec4c4669" />

*Administrator interface with CSV import/export and database utilities*

### **11. Audits logs**
<img width="357" height="158" alt="image" src="https://github.com/user-attachments/assets/4859a811-c5a4-45f4-b09f-3989185c64d4" />

---

## 🛠️ **Technology Stack**

### **Frontend:**
- HTML5, CSS3
- Bootstrap 5
- JavaScript

### **Backend:**
- PHP 8+
- MySQL 5.7/8.0

### **Development Environment:**
- XAMPP (Apache + MySQL)
- Visual Studio Code
- phpMyAdmin

---

## 📊 **Database Architecture**

### **System Workflow**
<img width="1054" height="473" alt="image" src="https://github.com/user-attachments/assets/e0c5519c-ebf6-42f3-a985-a05b48acf336" />

*UML representation of system processes and data flow*

---

## ⚙️ **Installation & Setup**

### **Prerequisites:**
- XAMPP/WAMP/LAMP stack
- PHP 8.0+
- MySQL 5.7/8.0

### **Installation Steps:**
1. **Download** project files
2. **Extract** to `htdocs` folder
3. **Start** Apache and MySQL
4. **Create Database:**
   ```sql
   CREATE DATABASE elderly_care_db;
   ```
5. **Import** database schema
6. **Configure** connection in `config.php`
7. **Access** via `http://localhost/elderly-care-system`

---

## 📖 **Module Screenshots & Details**

### **Module 1: Resident Management**
**Features:**
- Add new residents
- Edit existing records
- Search and filter functionality
- Resident profiles with photos

### **Module 2: Medical Module**
**Features:**
- Medication schedules
- Prescription tracking
- Doctor appointment logs
- Health condition updates


### **Module 3: Room Allocation**
**Features:**
- Floor-wise partitioning
- Real-time availability
- Room transfer history
- Maintenance scheduling


### **Module 4: Visitor Management**
**Features:**
- Visitor scheduling
- Check-in/check-out system
- Security logging
- Family access controls

---

## 🔧 **DBA Features Implementation**

### **Stored Procedures Execution**
<img width="1039" height="899" alt="image" src="https://github.com/user-attachments/assets/a34b9c29-4df0-4010-8e1f-5efd3547b39c" />
<img width="1039" height="907" alt="image" src="https://github.com/user-attachments/assets/f2b23833-a544-4341-bb85-016a106358a8" />
<img width="1039" height="912" alt="image" src="https://github.com/user-attachments/assets/bef2244b-9819-4332-9d26-1786cd04b02d" />

*Interface for executing database stored procedures*

---


## 🔮 **Future Enhancements**

### **Planned Features:**
1. **Authentication System** - Role-based access control
2. **Real-time Monitoring** - Live dashboard updates
3. **Mobile Application** - Companion mobile app
4. **IoT Integration** - Smart monitoring devices

---

## 🤝 **Contributors**

| Team Member | Role | Contribution |
|-------------|------|--------------|
| **Madeeha Talib** | Database Architect | Database design, DBA features |
| **Arjan Kumar** | Frontend Developer | UI/UX design, responsive layout |
| **Hussnain Khalid** | Backend Developer | PHP logic, documentation |

---


## ⚠️ **Important Notes**

1. **Academic Project:** Developed for educational purposes
2. **Test Data:** Use sample data for demonstration
3. **Security:** Additional measures needed for production
4. **Backup:** Regular database backups recommended

---
