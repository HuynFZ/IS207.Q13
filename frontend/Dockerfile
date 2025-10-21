# ---------- Base Node Image ----------
FROM node:25.0.0-alpine3.22
WORKDIR /app

# Copy và cài đặt phụ thuộc (có lock file để cache tốt)
COPY package.json package-lock.json ./
RUN npm ci

# Copy toàn bộ source code
COPY . .

# Expose cổng 5173 (Vite)
EXPOSE 5173

# Chạy Vite dev server
CMD ["npm", "run", "dev", "--", "--host=0.0.0.0"]
