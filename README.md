# Fair‑Nest

> **A modern Laravel‑based platform for managing shared living spaces (colocations).**

---

## 📖 Project Description

Fair‑Nest is a web application that simplifies the creation, management, and financial settlement of shared living arrangements (colocations). It solves common pain points for roommates and property owners:

- **Centralised management** of colocation details, members, and invitations.
- **Transparent expense tracking** with automated settlement calculations.
- **Real‑time communication** via an integrated chat system.
- **Robust admin controls** for moderation, user bans, and ownership transfers.
- **Secure authentication** and role‑based access control.

The platform is built on **Laravel 12**, leveraging Livewire for reactive UI components and Docker for reproducible development environments.

---

## 🛠️ Installation Instructions

### Prerequisites

- **PHP 8.2+**
- **Composer**
- **Node.js 20+** and **npm**
- **Docker & Docker Compose** (optional but recommended for a one‑click setup)

### Local Setup (Docker‑less)

```bash
# 1. Clone the repository
git clone https://github.com/your‑username/fair‑nest.git
cd fair‑nest

# 2. Copy the example environment file and generate an app key
cp .env.example .env
php artisan key:generate

# 3. Install PHP dependencies
composer install

# 4. Install front‑end assets
npm install
npm run build   # or `npm run dev` for development mode

# 5. Run database migrations (SQLite is used by default)
php artisan migrate --seed

# 6. Start the development server
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

### Docker‑Compose Setup (recommended)

```bash
# 1. Build and start containers
docker compose up -d --build

# 2. Run migrations inside the app container
docker exec -it fair-nest-app php artisan migrate --seed

# 3. The application will be reachable at http://localhost
```

To stop the containers:

```bash
docker compose down
```

---

## 🚀 Usage Instructions

### Authentication

- Register a new account or log in with an existing one.
- Email verification is required for full access.

### Core Workflow

1. **Create a Colocation** – Provide a name, address, and optional description.
2. **Invite Members** – Send email invitations; invitees can accept or decline.
3. **Add Expenses** – Record shared expenses (amount, description, payer, participants).
4. **Settle Payments** – The system calculates each member’s balance and generates payment links.
5. **Chat** – Use the built‑in chat to discuss bills, chores, or any topic.

### Admin Panel (admin users only)

- Access via `/dashboard/admin`.
- Ban/unban users, transfer colocation ownership, and view system metrics.

---

## ✨ Features / Functionalities

- **User Management** – Registration, email verification, profile editing, and account deletion.
- **Role‑Based Access** – Regular users, colocation owners, and administrators.
- **Colocation Lifecycle** – Create, view, edit settings, invite members, and delete.
- **Invitation System** – Secure token‑based invitations with accept/decline flows.
- **Expense Tracking** – CRUD operations for expenses with multi‑user split logic.
- **Automatic Settlement** – Calculates debts and generates payment actions.
- **Real‑Time Chat** – Message threads per colocation using Livewire components.
- **Admin Dashboard** – User bans, ownership transfers, and system health overview.
- **Dockerised Development** – One‑command environment setup.
- **Comprehensive Test Suite** – PHPUnit & Pest tests for core business logic.

---

## 🛠️ Technologies Used

| Layer | Technology |
|-------|------------|
| Backend | **PHP 8.2**, **Laravel 12**, **Livewire**, **Laravel Reverb** |
| Database | **MySQL** (via Docker) or **SQLite** for local dev |
| Front‑end | **Blade**, **Tailwind CSS**, **Vite** |
| DevOps | **Docker**, **Docker Compose**, **GitHub Actions** (CI) |
| Testing | **PHPUnit**, **Pest**, **Mockery** |
| CI/CD | **GitHub Actions** for linting, testing, and building assets |

---

## 🤝 Contributing Guidelines

We welcome contributions! Please follow these steps:

1. **Fork the repository** and clone your fork.
2. **Create a feature branch** (`git checkout -b feature/awesome-feature`).
3. **Write tests** for any new functionality.
4. **Run the test suite** (`php artisan test`).
5. **Commit with clear messages** and push to your fork.
6. **Open a Pull Request** targeting the `main` branch.

Please adhere to the existing coding style and run `composer lint` before submitting.

---

## 📄 License

This project is licensed under the **MIT License** – see the [LICENSE](LICENSE) file for details.

---

## 📬 Contact Information

**Author:** Guemry Reda 
**Email:** [EMAIL_ADDRESS](guemryreda@gmail.com) 
**GitHub:** [github.com/guemryreda](https://github.com/guemryreda)  

Feel free to open an issue or reach out directly for questions, suggestions, or collaboration opportunities.




