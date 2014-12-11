#
# Cookbook Name:: php
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#

execute "1st apt-get update" do
  command "apt-get update"
end

%w{php5 php5-cli php5-common php5-dev php5-gd php5-mysql libapache2-mod-php5 php-pear php-apc}.each do |suffix|
  package suffix do
 	action :nothing
 	subscribes :install, "execute[1st apt-get update]", :immediately
  end
end

execute "2nd apt-get update" do
  command "apt-get update"
  action :nothing
  subscribes :run, "package[php-apc]"
  notifies :install, "package[python-software-properties]", :immediately
  notifies :upgrade, "package[python-software-properties]", :immediately
end

package "python-software-properties" do
  action :nothing
  notifies :run, "execute[add ppa:ondrej/php5-oldstable]", :immediately
end

execute "add ppa:ondrej/php5-oldstable" do
  action :nothing
  command "add-apt-repository ppa:ondrej/php5-oldstable"
  notifies :run, "execute[php-reinstall]", :immediately
end

execute "php-reinstall" do
  action :run
  command "apt-get update; apt-get -y install php5"
  notifies :run, "execute[phpunit-install]", :immediately
end

execute "phpunit-install" do
  action :nothing
  command "pear upgrade PEAR; pear config-set auto_discover 1; pear install pear.phpunit.de/PHPUnit-3.7.32"
  not_if { ::File.exists?("/usr/bin/phpunit")}
end
