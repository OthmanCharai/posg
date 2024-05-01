@servers(['web' => 'root@93.127.203.1'])

@setup
$repository = 'git@github.com:OthmanCharai/posg.git';
$releases_dir = '/var/www/html/posg/releases';
$app_dir = '/var/www/html/posg';
$release = date('YmdHis');
$new_release_dir = $releases_dir . '/' . $release;
$password = 'F5k&d8@w^W~#VgP>Sbs5';
@endsetup

@story('deploy')
clone_repository
run_docker
run_composer
npm_build
update_symlinks
@endstory

@task('clone_repository')
echo 'Cloning repository'
[ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
cd {{ $new_release_dir }}
git reset --hard {{ $commit }}
@endtask

@task('run_docker')
echo "Starting deployment ({{ $release }})"
cd {{ $new_release_dir }}
sudo docker-compose up -d
@endtask

@task('run_composer')
echo "Running Composer"
cd {{ $new_release_dir }}
sudo docker exec -it posg_laravel.test_1 composer install
@endtask

@task('npm_build')
echo "Running npm build"
cd {{ $new_release_dir }}
sudo docker exec -it posg_laravel.test_1 npm run build
@endtask

@task('update_symlinks')
echo 'Linking current release'
ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
echo "{{ $password }}" | sudo -S chmod 777 -R {{ $app_dir }}
@endtask
