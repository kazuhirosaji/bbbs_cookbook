#
# Cookbook Name:: group
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
group "www-data" do
  action :modify
  members ['vagrant']
  append true
end