# TaskTracker

TaskTracker is a simple web-based application for managing and tracking your daily tasks. It allows users to add, edit, complete (archive), restore, and delete tasks, providing a streamlined workflow for personal productivity.

## Features

- **User Registration & Login:** Secure authentication with password hashing.
- **Task Management:** Add, edit, and delete tasks with deadlines and time.
- **Task Completion:** Mark tasks as completed to move them to the archive.
- **Archive & Restore:** View archived tasks and restore them if needed.
- **Pagination:** Paginated views for both active and archived tasks.
- **Responsive UI:** Clean, modern interface styled with Tailwind CSS.
- **Visual Timeline:** Upcoming deadlines are displayed in a timeline format.

## Folder Structure


## Database Schema

The application uses a MySQL database with the following tables:

- **users:** Stores user credentials.
- **tasks:** Stores active tasks.
- **archives:** Stores completed (archived) tasks.

Example schema:
```sql
CREATE TABLE `users` (
  `UserID` int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `UserName` varchar(16) DEFAULT NULL,
  `UserEmail` varchar(255) DEFAULT NULL,
  `UserPassword` varchar(255) DEFAULT NULL
);

CREATE TABLE `tasks` (
  `TaskID` int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `TaskName` varchar(225) DEFAULT NULL,
  `TaskDeadline` date DEFAULT NULL,
  `UserID` int(4) DEFAULT NULL,
  `is_archived` tinyint(1) DEFAULT 0,
  `TaskTimeDeadline` time DEFAULT NULL
);

CREATE TABLE `archives` (
  `TaskID` int(4) NOT NULL,
  `TaskName` varchar(225) DEFAULT NULL,
  `CompletionDate` date DEFAULT NULL,
  `UserID` int(4) DEFAULT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT 1,
  `CompletionTime` time DEFAULT NULL
);
```

## Getting Started

1. **Clone the repository** and place it in your web server directory (e.g., `htdocs` for XAMPP).
2. **Create the MySQL database** using the schema above.
3. **Configure database connection** in [`tasktrackerdb.php`](tasktrackerdb.php).
4. **Run the application** by navigating to [`index.php`](index.php) in your browser.

## Technologies Used

- PHP (Procedural)
- MySQL
- Tailwind CSS
- JavaScript

---

> This project was developed for educational purposes.