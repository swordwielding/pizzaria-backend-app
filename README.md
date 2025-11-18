# ⚙️ Pizzeria backend app
Клиентское приложение онлайн-пиццерии

Это админка и api сервис, который отвечает за создание новых товаров и передачу их по api фронтенду.  
Он обращается к frontend-сервису **Pizzeria Public App**, отпраляя данные через REST API.

Frontend-сервис находится в отдельном репозитории:  
**https://github.com/swordwielding/pizzaria-public-app**

# 🔧 Установка и запуск

## Клонировать проект и запустите проект
```bash
git clone https://github.com/swordwielding/pizzaria-backend-app.git
```
```powershell
cd pizzaria-backend-app
```
```powershell
composer install
npm install
copy .env.example .env
php artisan key:generate
npm run build
php artisan serve --port=8000
```
Данные для входа в аккаунт:
логин: admin
пароль: 123
