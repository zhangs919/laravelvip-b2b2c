# octane 加速配置

# 创建软链接
sudo ln -s /home/vagrant/code/laravelvip/data/octane/nginx_frontend.conf /etc/nginx/sites-enabled/www.lrw.test

sudo ln -s /home/vagrant/code/laravelvip/data/octane/nginx_m.conf /etc/nginx/sites-enabled/m.lrw.test

sudo ln -s /home/vagrant/code/laravelvip/data/octane/nginx_backend.conf /etc/nginx/sites-enabled/backend.lrw.test

sudo ln -s /home/vagrant/code/laravelvip/data/octane/nginx_seller.conf /etc/nginx/sites-enabled/seller.lrw.test

sudo ln -s /home/vagrant/code/laravelvip/data/octane/nginx_store.conf /etc/nginx/sites-enabled/store.lrw.test

# 启动 octane

php /home/vagrant/code/laravelvip/artisan octane:start --port=8000 &
