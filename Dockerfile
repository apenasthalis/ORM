# Usar a imagem oficial do Nginx
FROM nginx:1.27.1

# Copiar a configuração personalizada do Nginx
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# Copiar o código da aplicação para o diretório esperado
COPY ./src /var/www/html/crud

# Expor a porta 80 para o tráfego HTTP
EXPOSE 8070

# Iniciar o Nginx
CMD ["nginx", "-g", "daemon off;"]
