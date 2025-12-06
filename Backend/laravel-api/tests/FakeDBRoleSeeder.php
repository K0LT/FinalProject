<?php

namespace Tests;
class  FakeDBRoleSeeder
{
    public function FakeDBRoleSeeder()
    {
    }

    public function RoleSeeder(): void
    {
        \DB::table('roles')->insert([
            ['name' => 'Admin', 'description' => 'AdminDescription'],
            ['name' => 'Funcionario', 'description' => 'FuncionarioDescription'],
            ['name' => 'Patient', 'description' => 'PatientDescription'],
        ]);
    }
}
