# 📜 Laravel Artisan Commands Cheat Sheet

## 1. 🔍 Route (Định tuyến)
| Lệnh                      | Mô tả                                                           |
|---------------------------|-----------------------------------------------------------------|
| `php artisan route:list`  | Liệt kê tất cả route đã đăng ký, method, middleware, controller |
| `php artisan route:clear` | Xóa cache route                                                 |
| `php artisan route:cache` | Tạo cache route để tăng tốc (chỉ dùng production)               |

---

## 2. 🗂️ Model & Migration (Mô hình & CSDL)
| Lệnh                                            | Mô tả                                         |
|-------------------------------------------------|-----------------------------------------------|
| `php artisan make:model Task`                   | Tạo model `Task`                              |
| `php artisan make:model Task -m`                | Tạo model `Task` kèm migration                |
| `php artisan make:model Task -mcr`              | Tạo model + migration + controller + resource |
| `php artisan make:migration create_tasks_table` | Tạo file migration                            |
| `php artisan migrate`                           | Chạy tất cả migration                         |
| `php artisan migrate:rollback`                  | Quay lại migration gần nhất                   |
| `php artisan migrate:reset`                     | Reset tất cả migration về trạng thái ban đầu  |
| `php artisan migrate:refresh`                   | Reset và chạy lại toàn bộ migration           |
| `php artisan migrate:refresh --seed`            | Reset, chạy lại migration và seed dữ liệu     |
| `php artisan migrate:fresh`                     | Xóa toàn bộ bảng và chạy lại migration        |
| `php artisan migrate:fresh --seed`              | Xóa toàn bộ bảng, chạy lại migration và seed  |

---

## 3. 🌱 Seed & Factory (Dữ liệu mẫu)
| Lệnh                                                | Mô tả                        |
|-----------------------------------------------------|------------------------------|
| `php artisan make:factory TaskFactory --model=Task` | Tạo factory cho model `Task` |
| `php artisan db:seed`                               | Chạy tất cả seeder           |
| `php artisan db:seed --class=TaskSeeder`            | Chạy seeder cụ thể           |
| `php artisan make:seeder TaskSeeder`                | Tạo seeder mới               |

---

## 4. ⚙️ Cache & Config
| Lệnh                         | Mô tả                                   |
|------------------------------|-----------------------------------------|
| `php artisan cache:clear`    | Xóa toàn bộ cache ứng dụng              |
| `php artisan config:clear`   | Xóa cache cấu hình                      |
| `php artisan config:cache`   | Tạo cache cấu hình                      |
| `php artisan view:clear`     | Xóa cache view                          |
| `php artisan optimize`       | Tối ưu autoloader, cache route & config |
| `php artisan optimize:clear` | Xóa toàn bộ cache liên quan             |

---

## 5. 📦 Controller, Middleware & Command
| Lệnh                                                    | Mô tả                        |
|---------------------------------------------------------|------------------------------|
| `php artisan make:controller TaskController`            | Tạo controller               |
| `php artisan make:controller TaskController --resource` | Tạo controller kiểu resource |
| `php artisan make:middleware CheckUserRole`             | Tạo middleware               |
| `php artisan make:command CustomCommand`                | Tạo custom Artisan command   |

---

## 6. 🔄 Queue, Job & Event
| Lệnh                                                                | Mô tả                      |
|---------------------------------------------------------------------|----------------------------|
| `php artisan queue:work`                                            | Chạy hàng đợi (queue)      |
| `php artisan queue:listen`                                          | Lắng nghe và chạy queue    |
| `php artisan queue:restart`                                         | Khởi động lại queue worker |
| `php artisan make:job SendEmailJob`                                 | Tạo job                    |
| `php artisan make:event UserRegistered`                             | Tạo event                  |
| `php artisan make:listener SendWelcomeEmail --event=UserRegistered` | Tạo listener cho event     |

---

## 7. 🛠️ Debug & Dev
| Lệnh                                           | Mô tả                                    |
|------------------------------------------------|------------------------------------------|
| `php artisan serve`                            | Chạy server Laravel tại `localhost:8000` |
| `php artisan serve --host=0.0.0.0 --port=8080` | Chạy server với host & port tùy chỉnh    |
| `php artisan tinker`                           | Mở console tương tác với Laravel         |
| `php artisan down`                             | Đưa ứng dụng vào chế độ bảo trì          |
| `php artisan up`                               | Thoát chế độ bảo trì                     |

---

## 8. 🔐 Authentication & Passport / Sanctum
| Lệnh                                                                             | Mô tả                                       |
|----------------------------------------------------------------------------------|---------------------------------------------|
| `php artisan make:auth`                                                          | (Laravel < 6.x) Tạo scaffold login/register |
| `php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"` | Publish file Sanctum                        |
| `php artisan passport:install`                                                   | Cài đặt Passport (OAuth2)                   |

---

## 9. 📄 Form Request Validation
| Lệnh                                         | Mô tả                                          |
|----------------------------------------------|------------------------------------------------|
| `php artisan make:request StoreTaskRequest`  | Tạo Form Request để validate khi thêm mới Task |
| `php artisan make:request UpdateTaskRequest` | Tạo Form Request để validate khi cập nhật Task |

---

## 10. 📊 Khác
| Lệnh                       | Mô tả                                   |
|----------------------------|-----------------------------------------|
| `php artisan storage:link` | Tạo symbolic link cho thư mục `storage` |
| `php artisan inspire`      | Hiển thị câu quote ngẫu nhiên 😄        |
| `php artisan schedule:run` | Chạy các tác vụ đã lên lịch             |
