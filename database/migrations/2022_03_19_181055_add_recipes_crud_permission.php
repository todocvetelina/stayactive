<?php

use Illuminate\Database\Migrations\Migration;

class AddRecipesCrudPermission extends Migration
{
    private $permissions = [
        [
            'name' => 'recipes_crud',
            'display_name' => 'Управление на рецепти',
            'description' => 'Потребителят може да създава, редактира или изтрива рецепти.',
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
