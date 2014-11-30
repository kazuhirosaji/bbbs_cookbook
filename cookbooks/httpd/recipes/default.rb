#
# Cookbook Name:: httpd
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
execute "apt-get update" do
  command "apt-get update"
end

package "apache2" do
  action :install
end

bash "rewrite" do
  code <<-EOC
    sudo a2enmod rewrite
  EOC
end

template "/etc/apache2/sites-available/default" do
  source "default.erb"
  owner "root"
  group "root"
  mode 0644
end

template "/etc/apache2/httpd.conf" do
  source "httpd.conf.erb"
  owner "root"
  group "root"
  mode 0644
end

service "apache2" do
  supports :status => true, :restart => true, :reload => true
  action [:enable, :start]
end
