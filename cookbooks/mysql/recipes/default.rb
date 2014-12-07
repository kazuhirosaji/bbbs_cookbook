#
# Cookbook Name:: mysql
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
# execute "setpassword" do
#   # command "/usr/bin/mysqladmin -u root password root"
#   # action :nothing
#   notifies :run, "execute[mysql-create-user]", :immediately
# end

package "mysql-server" do
  action :install
end

service "mysql" do
  action [ :enable, :start]
  # notifies :run, resources(:execute => "setpassword")
end

template "tmp/grants.sql" do
  source "grants.sql.erb"
  owner "root"
  group "root"
  mode "0600"
  variables(
  	:user     => node['mysql']['db']['user'],
  	:password => node['mysql']['db']['pass'],
  	:database => node['mysql']['db']['database']
  )
  p "call mysql-create-user"
  notifies :run, "execute[mysql-create-user]", :immediately
end

execute "mysql-create-user" do
  p "mysql-create-user !!"
  command "mysql -u root --password=\"#{node['mysql']['db']['rootpass']}\"  < /tmp/grants.sql"
end
