# Laravel Project Setup Guide

## ***** Day 1 *****

### ✅ Step 1: Install Laravel Installer

Kwanza kabisa tunahitaji kuwa na **Laravel Installer** kwenye mfumo wetu. Hii itaturahisishia kuanzisha miradi mipya kwa urahisi.

```bash
composer global require laravel/installer
```

🔹 **Note:** Hakikisha umeongeza `~/.composer/vendor/bin` (Linux/macOS) au `%USERPROFILE%\AppData\Roaming\Composer\vendor\bin` (Windows) kwenye `PATH` yako ili `laravel` command ifanye kazi popote kwenye terminal.

---

### ✅ Step 2: Create a New Laravel Project

Baada ya ku-install Laravel Installer, fungua terminal yako au CMD kisha andika amri hii:

```bash
laravel new project-name
```

✳️ Badilisha `project-name` na jina unalotaka kwa project yako. Mfano:

```bash
laravel new myshop
```

---

### ✅ Step 3: Navigate to Your Project Directory

```bash
cd myshop
```

---

### ✅ Step 4: Run the Project Locally

Ili kuendesha project yako kwa mara ya kwanza:

```bash
php artisan serve
```

🌐 Tembelea: `http://localhost:8000`

---

## 🛡️ Step 5: Add Authentication using Breeze

**Laravel Breeze** ni njia rahisi ya kuanza na authentication (login, register, logout).

### 🔽 Install Laravel Breeze

```bash
composer require laravel/breeze --dev
```

### 📦 Run Breeze Installer

```bash
php artisan breeze:install
```

🔹 Unaweza kuchagua kutumia stack ya `blade` au `react/vue` kwa UI. Kwa sasa, tutatumia blade (default).

### ⚙️ Run Migrations

```bash
php artisan migrate
```

### 📦 Install Frontend Dependencies

```bash
npm install && npm run dev
```

💡 **Note:** Hakikisha una `Node.js` na `npm` tayari kwenye mfumo wako.

---

### ✅ Final Step: Start the Server Again

```bash
php artisan serve
```

Tembelea tena `http://localhost:8000` na utaona link za `Login` na `Register` tayari zipo kwenye homepage.

---

## ✅ Summary

Leo tumeweza:

- Ku-install Laravel Installer
- Kuanzisha project mpya ya Laravel
- Kuweka Breeze kwa ajili ya login/register
- Ku-run project yetu local

---

**End of Day 1** ✨


