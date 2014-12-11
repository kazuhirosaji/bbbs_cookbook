#
# Cookbook Name:: directory
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
%w{
  /vagrant/app/tmp
  /vagrant/app/webroot
  /vagrant/app/tmp/cache/models/myapp_cake_model_default_bbbs_list
  /vagrant/app/tmp/cache/models/myapp_cake_model_default_bbbs_nations
  /vagrant/app/tmp/cache/models/myapp_cake_model_default_bbbs_products
}.each do |path|
  directory path do
  	owner 'www-data'
    mode '0777'
    action :create
#    only_if { ::File.exists?(file_path) }
  end
end