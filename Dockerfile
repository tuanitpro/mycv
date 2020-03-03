FROM nginx
COPY ./web /usr/share/nginx/html
EXPOSE 8000