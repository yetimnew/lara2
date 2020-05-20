<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //Truck
            'truck deactivate',
            'truck create',
            'truck edit',
            'truck delete',
            'truck view',
            //Truck
            'truck_model create',
            'truck_model edit',
            'truck_model delete',
            'truck_model view',
            //Truck
            'driver create',
            'driver edit',
            'driver delete',
            'driver view',
            'driver deactivate',
            //OPERATION
            'operation create',
            'operation close',
            'operation open',
            'operation edit',
            'operation delete',
            'operation view',

            //OPERATION place
            'operation_place create',
            'operation_place edit',
            'operation_place delete',
            'operation_place view',
            //OPERATION region
            'operation_region create',
            'operation_region edit',
            'operation_region delete',
            'operation_region view',
            //OPERATION region
            'customer create',
            'customer edit',
            'customer delete',
            'customer view',
            //OPERATION Outsource
            'outsource create',
            'outsource edit',
            'outsource delete',
            'outsource view',
            //OPERATION Outsource PERFORMANCE
            'osperformance create',
            'osperformance edit',
            'osperformance delete',
            'osperformance view',
            //performance
            'performance create',
            'performance edit',
            'performance delete',
            'performance view',
            //status
            'status create',
            'status edit',
            'status delete',
            'status view',
            //status type
            'status_type create',
            'status_type edit',
            'status_type delete',
            'status_type view',
            //Truck Driver
            'truck_driver create',
            'truck_driver edit',
            'truck_driver delete',
            'truck_driver view',
            'truck_driver detach',


        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
