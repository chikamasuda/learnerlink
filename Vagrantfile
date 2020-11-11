# -*- mode: ruby -*-
# vi: set ft=ruby :
VM_BOX = 'centos/7'

# ローカルLANで使う: true
# VM LAN使う       : false
NW_LAN = false

# ローカル LAN割当IP
NW_IP     = '192.168.1.110'
# VM LAN割当IP
VM_NW_IP     = '192.168.33.20'

# vagrant plugin install vagrant-hostsupdater で vagrant-hostsupdater をインストールしていた場合のHost設定
# up 時、勝手に /etc/hosts にドメイン書き込んでくれて、halt で消してくれる
NW_HOST_NAME = 'test.laravel.local'

# LAN接続させる場合に接続対象のイーサネットを指定
# 初回の接続で選択肢が出てくるので、その名前の部分をコピペで指定すれば２回目以降の指定は
# これが自動で使われる
NW_BRIDGE = 'en0: Wi-Fi (Wireless)'

# Webプロジェクトを保存しているローカルPCをのパスを指定（Laravelインストール先のフォルダを指定）
DIR_SYNC_WWW  = './htdocs/learnerlink'

# データ保管に使用するローカルPCをのパスを指定（サーバーデータ置き場を指定）
# 配下に docker ディレクトリ を作成します。（vagrantと共有される）
DIR_SYNC_DATA = './'

# 初期でLaravelをインストールするかどうか。
LARAVEL_INSTALL = true
LARAVEL_VERSION = "5.5.*"

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "centos/7"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  # config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  # config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  if NW_LAN == true then
    config.vm.network "public_network", ip: NW_IP, bridge: NW_BRIDGE
  else
    NW_IP = VM_NW_IP
    config.vm.network "private_network", ip: NW_IP
  end

  if Vagrant.has_plugin?('vagrant-hostsupdater')
    config.vm.hostname = NW_HOST_NAME
  else
    puts "vagrant-hostsupdater 未インストールのため NW_HOST_NAME の設定は無視されています。"
    NW_HOST_NAME = NW_IP
  end

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"
  # config.vm.network "public_network", ip: "192.168.1.100" , bridge: "en0: Wi-Fi (Wireless)"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder "../data", "/vagrant_data"
  Dir.mkdir(DIR_SYNC_WWW) unless Dir.exist?(DIR_SYNC_WWW)
  Dir.mkdir("./nginx") unless Dir.exist?("./nginx")
  Dir.mkdir("./nginx/conf") unless Dir.exist?("./nginx/conf")
  Dir.mkdir("./nginx/log") unless Dir.exist?("./nginx/log")
  Dir.mkdir("./nginx/ssl") unless Dir.exist?("./nginx/ssl")

  # config.vm.synced_folder DIR_SYNC_WWW,   "/var/www/html", mount_options: ['dmode=777','fmode=777'], type: "nfs"
  # config.vm.synced_folder DIR_SYNC_DATA + "/nginx/conf", "/etc/nginx/conf.d", mount_options: ['dmode=777','fmode=777'], type: "nfs"
  # config.vm.synced_folder DIR_SYNC_DATA + "/nginx/log", "/var/log/nginx", mount_options: ['dmode=777','fmode=777'], type: "nfs"
  # config.vm.synced_folder DIR_SYNC_DATA + "/nginx/ssl", "/etc/nginx/ssl", mount_options: ['dmode=777','fmode=777'], type: "nfs"
  config.vm.synced_folder DIR_SYNC_WWW,   "/var/www/html", type: "nfs"
  config.vm.synced_folder DIR_SYNC_DATA + "/nginx/conf", "/etc/nginx/conf.d", type: "nfs"
  config.vm.synced_folder DIR_SYNC_DATA + "/nginx/log", "/var/log/nginx", type: "nfs"
  config.vm.synced_folder DIR_SYNC_DATA + "/nginx/ssl", "/etc/nginx/ssl", type: "nfs"
  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
    vb.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
    vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    vb.customize ["modifyvm", :id, "--audio", "none"]
  end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Enable provisioning with a shell script. Additional provisioners such as
  # Ansible, Chef, Docker, Puppet and Salt are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell", inline: <<-SHELL
yum -y update
yum install -y net-tools

yum install -y yum-utils device-mapper-persistent-data lvm2
yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo
yum install -y docker-ce docker-ce-cli containerd.io
systemctl start docker
systemctl enable docker
docker -v

groupadd docker
usermod -a -G docker vagrant

curl -L https://github.com/docker/compose/releases/download/1.25.0-rc2/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose
mv /usr/local/bin/docker-compose /usr/bin/docker-compose
docker-compose -v

mkdir ./workspace
mkdir ./workspace/php

cat > ./workspace/php/Dockerfile << "EOF"
FROM php:7.4-fpm

ARG TZ=Asia/Tokyo
COPY php.ini /usr/local/etc/php/

# Composer
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

# System Setup
RUN set -xe; \
    apt-get update -yqq && \
    apt-get install -yqq --no-install-recommends apt-utils vim gettext git default-mysql-client libfreetype6-dev libjpeg62-turbo-dev libpng-dev libwebp-dev libxpm-dev libmagickwand-dev libzip-dev zip unzip libonig-dev

# PHP Extension
RUN docker-php-ext-install bcmath gettext mbstring mysqli pdo pdo_mysql zip 
RUN docker-php-ext-configure mbstring --disable-mbregex 
# RUN docker-php-ext-configure zip --with-libzip

# --> for gd
RUN docker-php-ext-install -j$(nproc) iconv 
RUN docker-php-ext-configure gd --with-freetype --with-jpeg 
RUN docker-php-ext-install -j$(nproc) gd

# --> for ImageMagick
RUN pecl install imagick docker-php-ext-enable imagick

# timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html
EOF

cat > ./workspace/php/php.ini << "EOF"
date.timezone = "Asia/Tokyo"
memory_limit = -1
EOF

cat > ./workspace/docker-compose.yml << "EOF"
version: '3'

services:
  web:
    image: nginx
    volumes:
      - /var/www/html:/var/www/html
      - /etc/nginx/conf.d:/etc/nginx/conf.d
      - /var/log/nginx:/var/log/nginx
      - /etc/nginx/ssl:/etc/nginx/ssl
    ports:
      - "80:80"
      - "443:443"
    depends_on:
      - mysql
      - php
      - redis
    working_dir: /var/www/html

  php:
    build:
      ./php
    volumes:
      - /var/www/html:/var/www/html
    working_dir: /var/www/html

  mysql:
    image: mysql:5.7
    volumes:
      - mysql_data:/var/lib/mysql
    command:
      mysqld --character-set-server=utf8 --collation-server=utf8_unicode_ci --sql-mode=NO_ENGINE_SUBSTITUTION
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: laravel
      MYSQL_USER: laravel
      MYSQL_PASSWORD: secret
    ports:
      - 3306:3306

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    environment:
      - PMA_ARBITRARY=1
      - PMA_HOST=mysql
      - PMA_USER=root
      - PMA_PASSWORD=root
    ports:
      - 8000:80

  redis:
    image: redis:latest
    ports:
      - 6379:6379
    volumes:
      - redis_data:/data
    command: redis-server

  node:
    image: node:lts
    tty: true
    volumes:
      - /var/www/html:/var/www/html
    working_dir: /var/www/html

volumes:
  mysql_data:
  redis_data:
EOF

IS_SAME_SSL=`cat /etc/nginx/ssl/subjectnames.txt | grep #{NW_HOST_NAME}`
if [ ${#IS_SAME_SSL} -eq 0 ]; then
echo "subjectAltName = DNS:#{NW_HOST_NAME}, IP:#{NW_IP}" > /etc/nginx/ssl/subjectnames.txt
openssl genrsa 2048 > /etc/nginx/ssl/server.key
openssl req -new -key /etc/nginx/ssl/server.key -subj "/C=JP/ST=Some-State/O=Some-Org/CN=#{NW_HOST_NAME}" > /etc/nginx/ssl/server.csr
openssl x509 -days 3650 -req -extfile /etc/nginx/ssl/subjectnames.txt -signkey /etc/nginx/ssl/server.key < /etc/nginx/ssl/server.csr > /etc/nginx/ssl/server.crt
openssl x509 -in /etc/nginx/ssl/server.crt -text -noout
else
echo "Since the same domain was specified, the certificate issuance will be skipped."
fi

cat > /etc/nginx/conf.d/server.conf << "EOF"
server {
  client_max_body_size 64M;

  listen 80;
  listen 443 ssl;

  server_name #{NW_HOST_NAME};

  ssl_certificate     /etc/nginx/ssl/server.crt; # SSL証明書
  ssl_certificate_key /etc/nginx/ssl/server.key; # 秘密鍵

  access_log  /var/log/nginx/access.log;
  error_log   /var/log/nginx/error.log;

  location / {
    root      /var/www/html/public;
    index     index.php index.html index.htm;
    try_files $uri $uri/ /index.php$is_args$args;
  }

  location ~ \.php$ {
    fastcgi_pass   php:9000;
    fastcgi_index  index.php;
    fastcgi_param  SCRIPT_FILENAME  /var/www/html/public/$fastcgi_script_name;
    include        fastcgi_params;
  }
}
EOF

cat >> /home/vagrant/.bashrc << "EOF"
alias php='docker exec workspace_php_1 php'
alias composer='docker exec workspace_php_1 composer'
alias node='docker exec workspace_node_1 node'
alias npm='docker exec workspace_node_1 npm'
alias mysql='docker exec workspace_mysql_1 mysql'
alias redis='docker exec workspace_redis_1 redis'

# current directory.
cd /var/www/html/
EOF

    cd ./workspace
    docker-compose up -d

  SHELL

if LARAVEL_INSTALL == true then
  config.vm.provision "shell", inline: <<-SHELL
    cd /var/www/html/
    composer create-project --prefer-dist laravel/laravel . "#{LARAVEL_VERSION}"
  SHELL
end

  config.vm.provision "shell", run: "always", inline: <<-SHELL
    cd /home/vagrant/workspace
    docker-compose restart

echo "***** NOTE ***********************************************************"
echo "セルフSSLを適用しています。"
echo "#{DIR_SYNC_DATA}/docker/web/ssl 配下に作成されている"
echo "server.crt をホストPCの信頼できる証明書として登録することで、"
echo "下記URLでのアクセスも可能です。"
echo ""
echo "https://#{NW_HOST_NAME} "
echo "**********************************************************************"
echo 
echo "***** NOTE ***********************************************************"
echo "npm の実行はローカル環境で行ったほうが確実です。"
echo "**********************************************************************"
  SHELL
end
