FROM nginx:1.23.1-alpine
LABEL com.tuanitpro.description="This is my cv using docker"
WORKDIR /usr/share/nginx/html
# Remove default nginx static assets
RUN rm -rf ./*
COPY nginx.config /etc/nginx/conf.d/default.conf
COPY . /usr/share/nginx/html
CMD ["nginx", "-g", "daemon off;"]