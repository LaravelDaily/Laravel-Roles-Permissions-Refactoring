<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CleanupOldRolesPermissions extends Migration
{
    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => 'SpatieRolesPermissionsSeeder',
            '--force' => true
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
            $table->dropColumn('role_id');
        });

        Schema::table('permission_role', function (Blueprint $table) {
            $table->dropForeign('permission_role_permission_id_foreign');
            $table->dropForeign('permission_role_role_id_foreign');
        });

        Schema::drop('permission_role');
        Schema::drop('roles');
        Schema::drop('permissions');
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}