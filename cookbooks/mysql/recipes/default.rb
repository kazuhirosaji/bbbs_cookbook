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


package "make" do
  action :install
end

package "libmysqld-dev" do
  action :nothing
  subscribes :install, "package[make]", :immediately
end

chef_gem "mysql" do
  action :nothing
  subscribes :install, "package[libmysqld-dev]", :immediately
#  notifies :run, "execute[mysql-create-database]", :immediately
end

execute "mysql-create-database" do
  command "/usr/bin/mysqladmin -u root create #{node['mysql']['db']['database']}"
  not_if do
    require 'rubygems'
    Gem.clear_paths
    require 'mysql'
    m = Mysql.new(node['mysql']['db']['host'], "root", node['mysql']['db']['rootpass'])
    m.list_dbs.include?(node['mysql']['db']['database'])
  end
end

execute "mysql-create-tables" do
  command "/usr/bin/mysql -u root #{node['mysql']['db']['database']} < /tmp/tables.sql"
  action :nothing
  only_if do
  	require 'rubygems'
  	Gem.clear_paths
  	require 'mysql'
  	m = Mysql.new(node['mysql']['db']['host'], "root", node['mysql']['db']['rootpass'])
    begin
      m.select_db(node['mysql']['db']['database'])
      m.list_tables.empty?
    rescue Mysql::Error
      return false
    end
  end
end

cookbook_file "tmp/tables.sql" do
  owner "root"
  group "root"
  mode "0600"
  notifies :run, "execute[mysql-create-tables]", :immediately
end
