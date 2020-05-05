<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'my_project');
set('http_user', 'root');
set('writable_mode', 'chmod');
set('allow_anonymous_stats', false);

// Project repository
set('repository', 'https://github.com/tayron/laravel-crud-constance-teste.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false); 

// Path to deploy
set('deploy_path', '/var/www/html');    
    
// Tasks
task('build', function () {
   run('cd {{release_path}} && build');
});

desc('Rollback to previous release');
task('rollback', function () {
    $releases = get('releases_list');

    if (isset($releases[1])) {
        $releaseDir = "{{deploy_path}}/releases/{$releases[1]}";

        // Symlink to old release.
        run("cd {{deploy_path}} && {{bin/symlink}} $releaseDir current");

        // Remove release
        run("rm -rf {{deploy_path}}/releases/{$releases[0]}/");


        writeln("<info>rollback</info> to {$releases[1]} release was <success>successful</success>");
    } else {
        writeln("<error>no more releases you can revert to</error>");
    }
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

