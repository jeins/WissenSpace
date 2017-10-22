## WissenSpace

### Requirements
- PHP >=7.0.0
- NodeJS >=6.x
- MySQL
- Windows user setup untuk OAuth
    - Download versi terbaru curl untuk windows [https://curl.haxx.se/download.html](https://curl.haxx.se/download.html)
    - Download certificates [https://curl.haxx.se/ca/cacert.pem](https://curl.haxx.se/ca/cacert.pem)
    - Extract dan save ditempat yang dapat diakses
    - Edit php.ini, search [curl]
    - Ubah bagian ini  `curl.cainfo = “\path\cacert.pem”`

### Installation Instructions
1. run: `$ git clone https://github.com/jeins/WissenSpace`
2. buat database baru pada mysql
3. copy file .env.example => .env
4. setup .env (mysql connection, oauth connection)
5. run: `$ composer install`
6. run: `$ npm install`
7. run: `$ npm run dev`
8. run: `$ php artisan key:generate`
9. run: `$ php artisan migrate`
10. run: `$ composer dump-autoload`
11. untuk melihat website run : `$ php artisan serve`

