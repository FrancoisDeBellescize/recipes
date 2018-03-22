set :stage, :prod

set :ssh_user, 'ec2-user'
server '34.243.214.82', user: fetch(:ssh_user), roles: %w{web app db}

set :branch, 'master'
#path for the deploy
set :deploy_to, '/var/www/recipes'
