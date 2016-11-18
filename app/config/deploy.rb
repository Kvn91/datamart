set :application, "datamart"
set :domain,      "root@ns212345.ovh.net"
set :deploy_to,   "/home/kevin/datamart"

set :repository,       "git@github.com:Kvn91/datamart.git"
set :scm,              :git
set :deploy_via,       :copy

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :use_sudo,       false
set  :keep_releases,  3

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL