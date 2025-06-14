<div dir="rtl">


###  مدیریت کتابخانه - LibraryManagmentApi
---
###  ویژگی‌های پروژه مدیریت کتابخانه

#### دارای سه نقش عضو، کتابدار و مدیر

عضو: مشاهده کتاب ها و انتشارات و جست و جو

کتابدار: اضافه و ویرایش کتاب، آپدیت جریمه، اضافه و ویراش امانت، بازگشت امانت

مدیر: اضافه و ویرایش انتشارات، ویرایش کاربران

#### افزدون کتاب و انتشارات

اضافه کردن کتاب و انتشارات. هر انتشارت می تواند چند کتاب داشته باشد.

#### فیلتر و جستجو

فیلتر کتاب ها، ناشران و امانت هت براساس عنوان، نویسنده، نام انتشرات، تاریخ شروع لمانت و ...

#### ارسال ایمیل

ارسال ایمیل خودکار در صورت دیر کرد تحویل کتاب برای تمامی کاربران.

#### گزارش‌گیری

خروجی PDF از کابران فعال، کتاب های پر امانت، جریمه های دیر کرد، کتاب های موجود.

---

###  نصب و راه‌اندازی

#### 1. پروژه را clone کنید
```bash
git clone https://github.com/yusofsf/LibraryManagmentApi.git
cd LibraryManagmentApi
```

#### 1.2 نصب وابستگی ها
```bash
composer install
npm install
```

#### 2.2 تولید key و فایل env.
```bash
cp .env.example .env 
php artisan key:generate
```

#### 3.2 اجرای migrate و seed DB
```bash
php artisan migrate --seed
```
#### 4.2 اجرای پروژه
```bash
npm run dev
php artisan serve
```
---

#### مشخصات ادمین
```bash
password: 1234567
email: hassan@example.com
```
#### مشخصات کتابدار
```bash
password: 123456
email: mohammad@example.com
```
---
#### ساختار کلی پروژه


</div>


```
app/
├── Constants/
├── Enums/
├── Http/
│   ├── Controllers/
│       ├── Api/
│   ├── Requests/
├── Interfaces/
├── Models/
├── Providers/
├── Services/
```
---
