#
# Cookbook Name:: comrad
# Recipe:: default
#
# Copyright 2012, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#

package "phpmyadmin"

execute "disable-default-site" do
  command "a2dissite default"
end

web_app "comrad" do
  application_name "comrad"
  docroot "/vagrant/cakephp"
end
