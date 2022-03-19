<?php

use Illuminate\Database\Migrations\Migration;

class AddWorkoutsCrudPermission extends Migration
{
    private $permissions = [
        [
            'name' => 'workouts_crud',
            'display_name' => 'Управление на тренировки',
            'description' => 'Потребителят може да създава, изтрива или да редактира тренировки.',
        ],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->permissions as $permission) {
            $permission['created_at'] = date('Y-m-d H:i:s');
            $permission['updated_at'] = date('Y-m-d H:i:s');
            DB::table('permissions')->insert($permission);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->permissions as $permission) {
            DB::table('permissions')->where('name', $permission['name'])->delete();
        }
    }
}
