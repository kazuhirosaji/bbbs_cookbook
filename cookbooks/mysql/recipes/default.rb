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

# execute "mysql-create-user" do
#   command "mysql -u root --password=\"#{node['example']['db']['rootpass']}\"  < /tmp/grants.sql"
#  # /tmp/vagrant-chef-1/chef-solo-1/cookbooks/mysql/templates/default/grants.sql.erb 
# end

# template "tmp/grants.sql" do
#   owner "root"
#   group "root"
#   mode "0600"
#   variables(
#   	:user     => node['example']['db']['user'],
#   	:password => node['example']['db']['pass'],
#   	:database => node['example']['db']['database']
#   )
#   notifies :run, "execute[mysql-create-user]", :immediately
# end

package "mysql-server" do
  action :install
end

service "mysql" do
  action [ :enable, :start]
  notifies :run, resources(:execute => "setpassword")
end