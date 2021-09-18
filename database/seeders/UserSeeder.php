<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::create(['name' => 'Super Admin']);

        $directorRole = Role::create(['name' => 'Director']);

        $viewOrchestraPermission = Permission::create(['name' => 'view_orchestra', 'display_name' => 'Ver Perfil de la Orquesta']);
        $editOrchestraPermission = Permission::create(['name' => 'edit_orchestra', 'display_name' => 'Modificar Perfil de la Orquesta']);

        $directorRole->givePermissionTo($viewOrchestraPermission);

        $superAdminRole->givePermissionTo($viewOrchestraPermission);
        $superAdminRole->givePermissionTo($editOrchestraPermission);

        $viewCategoriesPermission = Permission::create(['name' => 'view_categories', 'display_name' => 'Ver Categorías']);
        $createCategoriesPermission = Permission::create(['name' => 'create_categories', 'display_name' => 'Registrar Categorías']);
        $editCategoriesPermission = Permission::create(['name' => 'edit_categories', 'display_name' => 'Modificar Categorías']);
        $deleteCategoriesPermission = Permission::create(['name' => 'delete_categories', 'display_name' => 'Inhabilitar Categorías']);
        $restoreCategoriesPermission = Permission::create(['name' => 'restore_categories', 'display_name' => 'Habilitar Categorías']);

        $superAdminRole->givePermissionTo($viewCategoriesPermission);
        $superAdminRole->givePermissionTo($createCategoriesPermission);
        $superAdminRole->givePermissionTo($editCategoriesPermission);
        $superAdminRole->givePermissionTo($deleteCategoriesPermission);
        $superAdminRole->givePermissionTo($restoreCategoriesPermission);

        $viewUsersPermission = Permission::create(['name' => 'view_users', 'display_name' => 'Ver Usuarios']);
        $createUsersPermission = Permission::create(['name' => 'create_users', 'display_name' => 'Registrar Usuarios']);
        $editUsersPermission = Permission::create(['name' => 'edit_users', 'display_name' => 'Modificar Usuarios']);
        $deleteUsersPermission = Permission::create(['name' => 'delete_users', 'display_name' => 'Inhabilitar Usuarios']);
        $restoreUsersPermission = Permission::create(['name' => 'restore_users', 'display_name' => 'Habilitar Usuarios']);

        $superAdminRole->givePermissionTo($viewUsersPermission);
        $superAdminRole->givePermissionTo($createUsersPermission);
        $superAdminRole->givePermissionTo($editUsersPermission);
        $superAdminRole->givePermissionTo($deleteUsersPermission);
        $superAdminRole->givePermissionTo($restoreUsersPermission);

        $viewClassificationsPermission = Permission::create(['name' => 'view_classifications', 'display_name' => 'Ver Clasificaciones']);
        $createClassificationsPermission = Permission::create(['name' => 'create_classifications', 'display_name' => 'Registrar Clasificaciones']);
        $editClassificationsPermission = Permission::create(['name' => 'edit_classifications', 'display_name' => 'Modificar Clasificaciones']);
        $deleteClassificationsPermission = Permission::create(['name' => 'delete_classifications', 'display_name' => 'Inhabilitar Clasificaciones']);
        $restoreClassificationsPermission = Permission::create(['name' => 'restore_classifications', 'display_name' => 'Habilitar Clasificaciones']);

        $superAdminRole->givePermissionTo($viewClassificationsPermission);
        $superAdminRole->givePermissionTo($createClassificationsPermission);
        $superAdminRole->givePermissionTo($editClassificationsPermission);
        $superAdminRole->givePermissionTo($deleteClassificationsPermission);
        $superAdminRole->givePermissionTo($restoreClassificationsPermission);

        $viewInstrumentsPermission = Permission::create(['name' => 'view_instruments', 'display_name' => 'Ver Instrumentos']);
        $createInstrumentsPermission = Permission::create(['name' => 'create_instruments', 'display_name' => 'Registrar Instrumentos']);
        $editInstrumentsPermission = Permission::create(['name' => 'edit_instruments', 'display_name' => 'Modificar Instrumentos']);
        $deleteInstrumentsPermission = Permission::create(['name' => 'delete_instruments', 'display_name' => 'Inhabilitar Instrumentos']);
        $restoreInstrumentsPermission = Permission::create(['name' => 'restore_instruments', 'display_name' => 'Habilitar Instrumentos']);

        $superAdminRole->givePermissionTo($viewInstrumentsPermission);
        $superAdminRole->givePermissionTo($createInstrumentsPermission);
        $superAdminRole->givePermissionTo($editInstrumentsPermission);
        $superAdminRole->givePermissionTo($deleteInstrumentsPermission);
        $superAdminRole->givePermissionTo($restoreInstrumentsPermission);

        $viewServicesPermission = Permission::create(['name' => 'view_services', 'display_name' => 'Ver Servicios']);
        $createServicesPermission = Permission::create(['name' => 'create_services', 'display_name' => 'Registrar Servicios']);
        $editServicesPermission = Permission::create(['name' => 'edit_services', 'display_name' => 'Modificar Servicios']);
        $deleteServicesPermission = Permission::create(['name' => 'delete_services', 'display_name' => 'Inhabilitar Servicios']);
        $restoreServicesPermission = Permission::create(['name' => 'restore_services', 'display_name' => 'Habilitar Servicios']);

        $superAdminRole->givePermissionTo($viewServicesPermission);
        $superAdminRole->givePermissionTo($createServicesPermission);
        $superAdminRole->givePermissionTo($editServicesPermission);
        $superAdminRole->givePermissionTo($deleteServicesPermission);
        $superAdminRole->givePermissionTo($restoreServicesPermission);

        $viewPromotionsPermission = Permission::create(['name' => 'view_promotions', 'display_name' => 'Ver Promociones']);
        $createPromotionsPermission = Permission::create(['name' => 'create_promotions', 'display_name' => 'Registrar Promociones']);
        $editPromotionsPermission = Permission::create(['name' => 'edit_promotions', 'display_name' => 'Modificar Promociones']);
        $deletePromotionsPermission = Permission::create(['name' => 'delete_promotions', 'display_name' => 'Inhabilitar Promociones']);
        $restorePromotionsPermission = Permission::create(['name' => 'restore_promotions', 'display_name' => 'Habilitar Promociones']);

        $superAdminRole->givePermissionTo($viewPromotionsPermission);
        $superAdminRole->givePermissionTo($createPromotionsPermission);
        $superAdminRole->givePermissionTo($editPromotionsPermission);
        $superAdminRole->givePermissionTo($deletePromotionsPermission);
        $superAdminRole->givePermissionTo($restorePromotionsPermission);

        $viewTypesPermission = Permission::create(['name' => 'view_types', 'display_name' => 'Ver Tipos de Personas']);
        $createTypesPermission = Permission::create(['name' => 'create_types', 'display_name' => 'Registrar Tipos de Personas']);
        $editTypesPermission = Permission::create(['name' => 'edit_types', 'display_name' => 'Modificar Tipos de Personas']);
        $deleteTypesPermission = Permission::create(['name' => 'delete_types', 'display_name' => 'Inhabilitar Tipos de Personas']);
        $restoreTypesPermission = Permission::create(['name' => 'restore_types', 'display_name' => 'Habilitar Tipos de Personas']);

        $superAdminRole->givePermissionTo($viewTypesPermission);
        $superAdminRole->givePermissionTo($createTypesPermission);
        $superAdminRole->givePermissionTo($editTypesPermission);
        $superAdminRole->givePermissionTo($deleteTypesPermission);
        $superAdminRole->givePermissionTo($restoreTypesPermission);

        $viewPeoplePermission = Permission::create(['name' => 'view_people', 'display_name' => 'Ver Personas']);
        $createPeoplePermission = Permission::create(['name' => 'create_people', 'display_name' => 'Registrar Personas']);
        $editPeoplePermission = Permission::create(['name' => 'edit_people', 'display_name' => 'Modificar Personas']);
        $deletePeoplePermission = Permission::create(['name' => 'delete_people', 'display_name' => 'Inhabilitar Personas']);
        $restorePeoplePermission = Permission::create(['name' => 'restore_people', 'display_name' => 'Habilitar Personas']);

        $superAdminRole->givePermissionTo($viewPeoplePermission);
        $superAdminRole->givePermissionTo($createPeoplePermission);
        $superAdminRole->givePermissionTo($editPeoplePermission);
        $superAdminRole->givePermissionTo($deletePeoplePermission);
        $superAdminRole->givePermissionTo($restorePeoplePermission);

        $viewMembersPermission = Permission::create(['name' => 'view_members', 'display_name' => 'Ver Integrantes']);
        $createMembersPermission = Permission::create(['name' => 'create_members', 'display_name' => 'Registrar Integrantes']);
        $editMembersPermission = Permission::create(['name' => 'edit_members', 'display_name' => 'Modificar Integrantes']);
        $deleteMembersPermission = Permission::create(['name' => 'delete_members', 'display_name' => 'Inhabilitar Integrantes']);
        $restoreMembersPermission = Permission::create(['name' => 'restore_members', 'display_name' => 'Habilitar Integrantes']);

        $superAdminRole->givePermissionTo($viewMembersPermission);
        $superAdminRole->givePermissionTo($createMembersPermission);
        $superAdminRole->givePermissionTo($editMembersPermission);
        $superAdminRole->givePermissionTo($deleteMembersPermission);
        $superAdminRole->givePermissionTo($restoreMembersPermission);

        $viewEventsPermission = Permission::create(['name' => 'view_events', 'display_name' => 'Ver Eventos']);
        $createEventsPermission = Permission::create(['name' => 'create_events', 'display_name' => 'Registrar Eventos']);
        $editEventsPermission = Permission::create(['name' => 'edit_events', 'display_name' => 'Modificar Eventos']);
        $deleteEventsPermission = Permission::create(['name' => 'delete_events', 'display_name' => 'Inhabilitar Eventos']);
        $restoreEventsPermission = Permission::create(['name' => 'restore_events', 'display_name' => 'Habilitar Eventos']);

        $superAdminRole->givePermissionTo($viewEventsPermission);
        $superAdminRole->givePermissionTo($createEventsPermission);
        $superAdminRole->givePermissionTo($editEventsPermission);
        $superAdminRole->givePermissionTo($deleteEventsPermission);
        $superAdminRole->givePermissionTo($restoreEventsPermission);

        $viewPointsPermission = Permission::create(['name' => 'view_points', 'display_name' => 'Ver Puntos de Ventas']);
        $createPointsPermission = Permission::create(['name' => 'create_points', 'display_name' => 'Registrar Puntos de Ventas']);
        $editPointsPermission = Permission::create(['name' => 'edit_points', 'display_name' => 'Modificar Puntos de Ventas']);
        $deletePointsPermission = Permission::create(['name' => 'delete_points', 'display_name' => 'Inhabilitar Puntos de Ventas']);
        $restorePointsPermission = Permission::create(['name' => 'restore_points', 'display_name' => 'Habilitar Puntos de Ventas']);

        $superAdminRole->givePermissionTo($viewPointsPermission);
        $superAdminRole->givePermissionTo($createPointsPermission);
        $superAdminRole->givePermissionTo($editPointsPermission);
        $superAdminRole->givePermissionTo($deletePointsPermission);
        $superAdminRole->givePermissionTo($restorePointsPermission);



        $viewRolesPermission = Permission::create(['name' => 'view_roles', 'display_name' => 'Ver Roles']);
        $createRolesPermission = Permission::create(['name' => 'create_roles', 'display_name' => 'Registrar Roles']);
        $editRolesPermission = Permission::create(['name' => 'edit_roles', 'display_name' => 'Modificar Roles']);
        $deleteRolesPermission = Permission::create(['name' => 'delete_roles', 'display_name' => 'Inhabilitar Roles']);
        $restoreRolesPermission = Permission::create(['name' => 'restore_roles', 'display_name' => 'Habilitar Roles']);

        $superAdminRole->givePermissionTo($viewRolesPermission);
        $superAdminRole->givePermissionTo($createRolesPermission);
        $superAdminRole->givePermissionTo($editRolesPermission);
        $superAdminRole->givePermissionTo($deleteRolesPermission);
        $superAdminRole->givePermissionTo($restoreRolesPermission);

        $viewPermissionsPermission = Permission::create(['name' => 'view_permissions', 'display_name' => 'Ver Permisos']);

        $superAdminRole->givePermissionTo($viewPermissionsPermission);

        $personAdmin = new Person;
        $personAdmin->name = 'Miguel A.';
        $personAdmin->surnames = 'Choque R.';
        $personAdmin->profile_photo_path = null;
        $personAdmin->status = 1;
        $personAdmin->type_id = 1;
        $personAdmin->save();

        $superAdmin = new User;
        $superAdmin->email = 'm.choque.ramirez@hotmail.com';
        $superAdmin->password = 'password'; // $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
        $superAdmin->remember_token = Str::random(10);
        $superAdmin->status = 1;
        $superAdmin->person_id = 1;
        $superAdmin->save();

        $personDirector = new Person;
        $personDirector->name = 'Franz.';
        $personDirector->surnames = 'Condori.';
        $personDirector->profile_photo_path = null;
        $personDirector->status = 1;
        $personDirector->type_id = 2;
        $personDirector->save();

        $director = new User;
        $director->email = 'franz.condori@hotmail.com';
        $director->password = 'password'; // $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
        $director->remember_token = Str::random(10);
        $director->status = 1;
        $director->person_id = 2;
        $director->save();

        $superAdmin->assignRole($superAdminRole);
        $director->assignRole($directorRole);
    }
}
