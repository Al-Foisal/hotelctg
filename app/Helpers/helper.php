<?php


function uploadImage($folder, $file)
{

    if ($file) {

        $img_gen   = hexdec(uniqid());
        $image_url = 'images/' . $folder . '/';
        $image_ext = strtolower($file->getClientOriginalExtension());

        $img_name    = $img_gen . '.' . $image_ext;
        $file->move($image_url, $img_name);
        return $image_url . $img_gen . '.' . $image_ext;
    }


    return null;
}

function menuList()
{
    return [

        [
            'sideIcon'   => 'home',
            'title'      => 'Dashboard',
            'link'       => route('dashboard'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'dash_board',

        ],
        [
            'sideIcon'   => 'home',
            'title'      => 'System User',
            'link'       => route('systemUser.index'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'System_User',

        ],
        [
            'sideIcon'   => 'home',
            'title'      => 'Customer',
            'link'       => route('customer.index'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'Customer',

        ],
        [
            'sideIcon'   => 'home',
            'title'      => 'Reservation List',
            'link'       => route('roomReservation.index'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'Reservation_List',

        ],
        [
            'sideIcon'   => 'home',
            'title'      => 'Check In',
            'link'       => route('roomReservation.create'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'Check_In',

        ],


        [
            'sideIcon'   => 'home',
            'title'      => 'Room Category',
            'link'       => route('rrs.roomCategory.index'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'Room_Type',
        ],
        [
            'sideIcon'   => 'home',
            'title'      => 'Bed Type',
            'link'       => route('rrs.bedType.index'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'Bed_Type',
        ],
        [
            'sideIcon'   => 'home',
            'title'      => 'Floor Manage',
            'link'       => route('rrs.floor.index'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'Floor_Manage',
        ],
        [
            'sideIcon'   => 'home',
            'title'      => 'Facility Manage',
            'link'       => route('rrs.facility.index'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'Facility_Manage',
        ],
        [
            'sideIcon'   => 'home',
            'title'      => 'Promo Code',
            'link'       => route('promoCode.index'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'Promo_Code',
        ],
        [
            'sideIcon'   => 'home',
            'title'      => 'Room or Apartment Manage',
            'link'       => route('rrs.roa.index'),
            'hasSub'     => false,
            'subMenu'    => [],
            'permission' => 'Room_or_Apartment_Manage',
        ],

        // [
        //     'sideIcon'   => 'user',
        //     'title'      => 'Human Resource',
        //     'link'       => '',
        //     'hasSub'     => true,
        //     'permission' => 'Human_Resource',
        //     'subMenu'    => [
        //         [
        //             'sideIcon'   => '',
        //             'title'      => 'Designation',
        //             'link'       => route('rrs.desg.index'),
        //             'permission' => 'Designation',
        //         ],
        //         [
        //             'sideIcon'   => '',
        //             'title'      => 'Employee',
        //             'link'       => route('rrs.emp.index'),
        //             'permission' => 'Employee',
        //         ],
        //         [
        //             'sideIcon'   => '',
        //             'title'      => 'Payroll',
        //             'link'       => route('rrs.payroll.index'),
        //             'permission' => 'Payroll',
        //         ],

        //     ],

        // ],

        // [
        //     'sideIcon'   => 'thermometer',
        //     'title'      => 'Resturant Management',
        //     'link'       => '',
        //     'hasSub'     => true,
        //     'permission' => 'Resturant_Management',
        //     'subMenu'    => [
        //         [
        //             'sideIcon'   => '',
        //             'title'      => 'Billing',
        //             'link'       => route('resturantBilling.create'),
        //             'permission' => 'Resturant_Billing',
        //         ],
        //         [
        //             'sideIcon'   => '',
        //             'title'      => 'Menu Item',
        //             'link'       => route('resturant.menuItem.index'),
        //             'permission' => 'Menu_Item',
        //         ],
        //         [
        //             'sideIcon'   => '',
        //             'title'      => 'Menu Item Category',
        //             'link'       => route('resturant.menuItemCategory.index'),
        //             'permission' => 'Menu_Item_Category',
        //         ],
        //         [
        //             'sideIcon'   => '',
        //             'title'      => 'Table setup',
        //             'link'       => route('resturant.tableSetup.index'),
        //             'permission' => 'Table_setup',
        //         ],
        //     ],

        // ],
        // [
        //     'sideIcon'   => 'thermometer',
        //     'title'      => 'Inventory Setting',
        //     'link'       => '',
        //     'hasSub'     => true,
        //     'permission' => 'Inventory_Setting',
        //     'subMenu'    => [
        //         [
        //             'sideIcon'   => '',
        //             'title'      => 'Supplier',
        //             'link'       => route('is.supplier.index'),
        //             'permission' => 'Supplier',
        //         ],
        //         [
        //             'sideIcon'   => '',
        //             'title'      => 'Product Category',
        //             'link'       => route('is.productCategory.index'),
        //             'permission' => 'Product_Category',
        //         ],
        //         [
        //             'sideIcon'   => '',
        //             'title'      => 'Product',
        //             'link'       => route('product.index'),
        //             'permission' => 'Product',
        //         ],
        //     ],

        // ],

        // [
        //     'sideIcon'   => 'thermometer',
        //     'title'      => 'Inventory Management',
        //     'link'       => '',
        //     'hasSub'     => true,
        //     'permission' => 'Inventory_Management',
        //     'subMenu'    => [
        //         [
        //             'sideIcon'   => '',
        //             'title'      => 'Purchase',
        //             'link'       => route('purchase.index'),
        //             'permission' => 'Purchase',
        //         ],
        //         [
        //             'sideIcon'   => '',
        //             'title'      => 'Stock',
        //             'link'       => '',
        //             'permission' => 'Bed_Type',
        //         ],
        //     ],

        // ],
        [
            'sideIcon'   => 'thermometer',
            'title'      => 'Website Management',
            'link'       => '',
            'hasSub'     => true,
            'permission' => 'Website_Management',
            'subMenu'    => [
                [
                    'sideIcon'   => '',
                    'title'      => 'Website About',
                    'link'       => route('ws.about.index'),
                    'permission' => 'Website_About',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Website Testimonial',
                    'link'       => route('ws.testimonial.index'),
                    'permission' => 'Website_Testimonial',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Website Contact',
                    'link'       => route('ws.contact.index'),
                    'permission' => 'Website_Contact',
                ],
                [
                    'sideIcon'   => '',
                    'title'      => 'Website Setup',
                    'link'       => route('ws.setup.index'),
                    'permission' => 'Website_Setup',
                ],
            ],

        ],

    ];
}

function findMenu($targetArray)
{
    if (session('owner_id') == session('auth_id')) {
        return true;
    }
    if (array_key_exists($targetArray, session('single_permission'))) {
        if (is_array(session('single_permission')[$targetArray])) {
            return true;
        }
        return false;
    }
    return false;
}

function findSub($menu, $sub)
{
    if (session('owner_id') == session('auth_id')) {
        return true;
    }

    if (array_key_exists($menu, session('single_permission'))) {
        if (is_array(session('single_permission')[$menu])) {
            $result = session('single_permission')[$menu];
            if (array_key_exists($sub, $result)) {
                return true;
            }
        }
        return false;
    }
    return false;
}

function isOperator()
{
    if (auth()->user()->responsibility === 'Operator') {
        return true;
    } else {
        return false;
    }
}
