run in dir:
```bash
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout ssl/nginx.key -out ssl/nginx.crt -subj "/C=DE/ST=Berlin/L=Berlin/O=LocalDev/CN=localhost"
```
