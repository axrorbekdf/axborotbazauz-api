<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $permissions = [
        //         // Role
        //        [
        //            "name" => "show_role",
        //            "permission_name" => "role",
        //            "category_name" => "Adminlar bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_role",
        //            "permission_name" => "role",
        //            "category_name" => "Adminlar bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_role",
        //            "permission_name" => "role",
        //            "category_name" => "Adminlar bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_role",
        //            "permission_name" => "role",
        //            "category_name" => "Adminlar bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_role",
        //            "permission_name" => "role",
        //            "category_name" => "Adminlar bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_role",
        //            "permission_name" => "role",
        //            "category_name" => "Adminlar bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //         // User
        //        [
        //            "name" => "show_user",
        //            "permission_name" => "user",
        //            "category_name" => "Adminlar bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_user",
        //            "permission_name" => "user",
        //            "category_name" => "Adminlar bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_user",
        //            "permission_name" => "user",
        //            "category_name" => "Adminlar bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_user",
        //            "permission_name" => "user",
        //            "category_name" => "Adminlar bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_user",
        //            "permission_name" => "user",
        //            "category_name" => "Adminlar bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_user",
        //            "permission_name" => "user",
        //            "category_name" => "Adminlar bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //         // Region
        //        [
        //            "name" => "show_region",
        //            "permission_name" => "region",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_region",
        //            "permission_name" => "region",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_region",
        //            "permission_name" => "region",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_region",
        //            "permission_name" => "region",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_region",
        //            "permission_name" => "region",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_region",
        //            "permission_name" => "region",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //         // Branch
        //        [
        //            "name" => "show_branch",
        //            "permission_name" => "branch",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_branch",
        //            "permission_name" => "branch",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_branch",
        //            "permission_name" => "branch",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_branch",
        //            "permission_name" => "branch",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_branch",
        //            "permission_name" => "branch",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_branch",
        //            "permission_name" => "branch",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //         // City
        //        [
        //            "name" => "show_city",
        //            "permission_name" => "city",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_city",
        //            "permission_name" => "city",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_city",
        //            "permission_name" => "city",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_city",
        //            "permission_name" => "city",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_city",
        //            "permission_name" => "city",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_city",
        //            "permission_name" => "city",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //         // District
        //        [
        //            "name" => "show_district",
        //            "permission_name" => "district",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_district",
        //            "permission_name" => "district",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_district",
        //            "permission_name" => "district",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_district",
        //            "permission_name" => "district",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_district",
        //            "permission_name" => "district",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_district",
        //            "permission_name" => "district",
        //            "category_name" => "Xududlar bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //         // Brand
        //        [
        //            "name" => "show_brand",
        //            "permission_name" => "brand",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_brand",
        //            "permission_name" => "brand",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_brand",
        //            "permission_name" => "brand",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_brand",
        //            "permission_name" => "brand",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_brand",
        //            "permission_name" => "brand",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_brand",
        //            "permission_name" => "brand",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //         // Category
        //        [
        //            "name" => "show_category",
        //            "permission_name" => "category",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_category",
        //            "permission_name" => "category",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_category",
        //            "permission_name" => "category",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_category",
        //            "permission_name" => "category",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_category",
        //            "permission_name" => "category",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_category",
        //            "permission_name" => "category",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //         // Inner_category
        //        [
        //            "name" => "show_inner_category",
        //            "permission_name" => "inner_category",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_inner_category",
        //            "permission_name" => "inner_category",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_inner_category",
        //            "permission_name" => "inner_category",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_inner_category",
        //            "permission_name" => "inner_category",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_inner_category",
        //            "permission_name" => "inner_category",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_inner_category",
        //            "permission_name" => "inner_category",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //         // Banner
        //        [
        //            "name" => "show_banner",
        //            "permission_name" => "banner",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_banner",
        //            "permission_name" => "banner",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_banner",
        //            "permission_name" => "banner",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_banner",
        //            "permission_name" => "banner",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_banner",
        //            "permission_name" => "banner",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_banner",
        //            "permission_name" => "banner",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //        [
        //             "name" => "visible_banner",
        //             "permission_name" => "banner",
        //             "category_name" => "Katalog bo'limi",
        //             "display_name" => "Ko'rinishini belgilash"
        //         ],
        //         // Basket
        //        [
        //            "name" => "show_basket",
        //            "permission_name" => "basket",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_basket",
        //            "permission_name" => "basket",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_basket",
        //            "permission_name" => "basket",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_basket",
        //            "permission_name" => "basket",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_basket",
        //            "permission_name" => "basket",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_basket",
        //            "permission_name" => "basket",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //         // Color
        //        [
        //            "name" => "show_color",
        //            "permission_name" => "color",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_color",
        //            "permission_name" => "color",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_color",
        //            "permission_name" => "color",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_color",
        //            "permission_name" => "color",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_color",
        //            "permission_name" => "color",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_color",
        //            "permission_name" => "color",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //         // Like
        //        [
        //            "name" => "show_like",
        //            "permission_name" => "like",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_like",
        //            "permission_name" => "like",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_like",
        //            "permission_name" => "like",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_like",
        //            "permission_name" => "like",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "O'chirish"
        //        ], 
        //        [
        //            "name" => "restore_delete_like",
        //            "permission_name" => "like",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_like",
        //            "permission_name" => "like",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //         // Product
        //        [
        //            "name" => "show_product",
        //            "permission_name" => "product",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_product",
        //            "permission_name" => "product",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_product",
        //            "permission_name" => "product",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_product",
        //            "permission_name" => "product",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_product",
        //            "permission_name" => "product",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_product",
        //            "permission_name" => "product",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //        [
        //             "name" => "visible_product",
        //             "permission_name" => "product",
        //             "category_name" => "Katalog bo'limi",
        //             "display_name" => "Ko'rinishini belgilash"
        //         ],
        //         [
        //             "name" => "add_image_product",
        //             "permission_name" => "product",
        //             "category_name" => "Katalog bo'limi",
        //             "display_name" => "Rasm qo'shish"
        //         ],
        //         [
        //             "name" => "uz_info_product",
        //             "permission_name" => "product",
        //             "category_name" => "Katalog bo'limi",
        //             "display_name" => "O'zbekcha ma'lumotlar qo'shish"
        //         ],
        //         [
        //             "name" => "ru_info_product",
        //             "permission_name" => "product",
        //             "category_name" => "Katalog bo'limi",
        //             "display_name" => "Ruscha ma'lumotlar qo'shish"
        //         ],

        //         // Product Property
        //        [
        //            "name" => "show_product_property",
        //            "permission_name" => "product_property",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_product_property",
        //            "permission_name" => "product_property",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_product_property",
        //            "permission_name" => "product_property",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_product_property",
        //            "permission_name" => "product_property",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_product_property",
        //            "permission_name" => "product_property",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_product_property",
        //            "permission_name" => "product_property",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ],
        //        // Product Inner Property
        //        [
        //             "name" => "show_product_inner_property",
        //             "permission_name" => "product_inner_property",
        //             "category_name" => "Katalog bo'limi",
        //             "display_name" => "Ko'rish"
        //         ],
        //         [
        //             "name" => "store_product_inner_property",
        //             "permission_name" => "product_inner_property",
        //             "category_name" => "Katalog bo'limi",
        //             "display_name" => "Qo'shish"
        //         ],
        //         [
        //             "name" => "update_product_inner_property",
        //             "permission_name" => "product_inner_property",
        //             "category_name" => "Katalog bo'limi",
        //             "display_name" => "Tahrirlash"
        //         ],
        //         [
        //             "name" => "delete_product_inner_property",
        //             "permission_name" => "product_inner_property",
        //             "category_name" => "Katalog bo'limi",
        //             "display_name" => "O'chirish"
        //         ],
        //         [
        //             "name" => "restore_delete_product_inner_property",
        //             "permission_name" => "product_inner_property",
        //             "category_name" => "Katalog bo'limi",
        //             "display_name" => "Qayta tiklash"
        //         ],
        //         [
        //             "name" => "force_delete_product_inner_property",
        //             "permission_name" => "product_inner_property",
        //             "category_name" => "Katalog bo'limi",
        //             "display_name" => "Qattiq o'chirish"
        //         ],
        //         //  Product Property Template
        //        [
        //            "name" => "show_product_property_template",
        //            "permission_name" => "product_property_template",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Ko'rish"
        //        ],
        //        [
        //            "name" => "store_product_property_template",
        //            "permission_name" => "product_property_template",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qo'shish"
        //        ],
        //        [
        //            "name" => "update_product_property_template",
        //            "permission_name" => "product_property_template",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Tahrirlash"
        //        ],
        //        [
        //            "name" => "delete_product_property_template",
        //            "permission_name" => "product_property_template",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "O'chirish"
        //        ],
        //        [
        //            "name" => "restore_delete_product_property_template",
        //            "permission_name" => "product_property_template",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qayta tiklash"
        //        ],
        //        [
        //            "name" => "force_delete_product_property_template",
        //            "permission_name" => "product_property_template",
        //            "category_name" => "Katalog bo'limi",
        //            "display_name" => "Qattiq o'chirish"
        //        ]
        // ];

        // foreach ($permissions as $val) {
        //     Permission::firstOrCreate([
        //         'name' => $val['name']
        //     ],[
        //         'name' => $val['name'],
        //         'permission_name' => $val['permission_name'],
        //         'category_name' => $val['category_name'],
        //         'display_name' => $val['display_name'],
        //     ]);
        // }

        // $role = Role::firstOrCreate([
        //     'name' => 'admin' 
        // ],['name' => 'admin']);
        // $role->givePermissionTo(Permission::all());

        $user = User::firstOrCreate([
            'phone' => "998999152409",
        ],[
            'name' => "Admin(Ahrorbek)",
            'phone' => "998999152409",
            'login' => null,
            'email' => null,
            'role' => 'admin',
            'password' => Hash::make("123456"),
            'responsible_worker' => "command:api"
        ]);

        $user = User::firstOrCreate([
            'phone' => "998997070780",
        ],[
            'name' => "Admin(Azizbek)",
            'phone' => "998997070780",
            'login' => null,
            'email' => null,
            'role' => 'admin',
            'password' => Hash::make("123456"),
            'responsible_worker' => "command:api"
        ]);

        // $user->assignRole($role);
    }
}
