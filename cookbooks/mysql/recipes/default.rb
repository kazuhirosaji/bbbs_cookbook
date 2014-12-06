#
# Cookbook Name:: mysql
# Recipe:: default
#
# Copyright 2014, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
execute "setpassword" do
	update = "UPDATE user SET Password='' WHERE Host='localhost' and User='root';"
	command "sudo /etc/init.d/mysql stop"
	command "sudo killall mysqld"
	command "sudo /usr/bin/mysqld_safe -u root --skip-grant-tables &"
	command "mysqladmin -e #{update}"
	command "mysqladmin -e FLUSH PRIVILEGES;"
	command "/usr/bin/mysqladmin -u root password root"
	action :nothing
end

package "mysql-server" do
  action :install
end

service "mysql" do
  action [ :enable, :start]
  notifies :run, resources(:execute => "setpassword")
end