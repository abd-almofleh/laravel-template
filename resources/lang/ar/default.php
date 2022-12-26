<?php

return [
  'yes'   => 'نعم',
  'no'    => 'لا',
  'table' => [
    'sl'                       => 'SL',
    'name'                     => 'الاسم',
    'name_ar'                  => 'الاسم العربي',
    'name_en'                  => 'الاسم الانكليزي',
    'code'                     => 'الرمز',
    'image'                    => 'الصورة',
    'category'                 => 'الصنف',
    'email'                    => 'البريد الالكتروني',
    'slug'                     => 'Slug',
    'title'                    => 'العنوان',
    'symbol'                   => 'الرمز',
    'action'                   => 'العمل',
    'mobile'                   => 'الهاتف المحمول',
    'role'                     => 'المنصب',
    'roles'                    => 'المناصب',
    'status'                   => 'الحالة',
    'edit'                     => 'تعديل',
    'delete'                   => 'حذف',
    'gender'                   => 'الحنس',
    'is_deleted'               => 'تم حذفه',
    'id'                       => 'المعرف',
    'type'                     => 'النوع',
    'contact_number'           => 'رقم التواصل',
    'no_category'              => 'لا نوع',
    'can_publish'              => 'يمكن نشرها؟',
    'author'                   => 'المؤلف',

  ],

  'form' => [
    'id'     => 'ID',
    'nid'    => 'NID',
    'gender' => 'الحنس',

    'officer_id'               => 'Officer ID',
    'confirm-password'         => 'Confirm Password',
    'image'                    => 'Image',
    'code'                     => 'Code',
    'title'                    => 'Title',
    'title_en'                 => 'Title (English)',
    'title_ar'                 => 'Title (Arabic)',
    'category'                 => 'Category',
    'description'              => 'التفاصيل والانجازات',
    'description_en'           => 'التفاصيل (English)',
    'description_ar'           => 'التفاصيل (Arabic)',
    'upload_image'             => 'Upload Image',
    'change_image'             => 'Change Image',
    'name'                     => 'Name',
    'name_ar'                  => 'Arabic Name',
    'name_en'                  => 'English Name',
    'email'                    => 'Email',
    'symbol'                   => 'Symbol',
    'currency'                 => 'Currency',
    'phone'                    => 'Phone',
    'slug'                     => 'Slug',
    'password'                 => 'Password',
    'mobile'                   => 'Mobile',
    'division'                 => 'Division',
    'district'                 => 'District',
    'sub_district'             => 'Upazila',
    'address'                  => 'Address',
    'password-confirm'         => 'Confirm Password',
    'role'                     => 'Role',
    'status'                   => 'Status',
    'role-current'             => 'Current Role',
    'add-button'               => 'Add New User',
    'save-button'              => 'Save',
    'edit-button'              => 'Edit',
    'view-button'              => 'View',
    'update-button'            => 'Update',
    'delete-button'            => 'Delete',
    'user-since'               => 'User Since',
    'last-update'              => 'Last Update',
    'action'                   => 'Action',
    'edit'                     => 'Edit',
    'delete'                   => 'Delete',
    'delete-message'           => 'Are you sure?',
    'active'                   => 'Active',
    'inactive'                 => 'Inactive',
    'draft'                    => 'Draft',
    'published'                => 'Published',
    'type'                     => 'النوع',
    'choose_horse_type'        => 'Choose Horse Type',
    'choose_birth_year'        => 'Choose Birth Year',
    'choose_horse_passport'    => 'Choose Horse Passport',
    'race'                     => 'السلاسة',
    'birth_year'               => 'تاريخ الميلاد',
    'passport'                 => 'جواز السفر',
    'height'                   => 'الطول',
    'color'                    => 'اللون',
    'health'                   => 'الصحة',
    'contact_number'           => 'رقم التواصل',
    'location'                 => 'العنوان',
    'father_name'              => 'اسم الأب',
    'mother_name'              => 'اسم الأم',
    'comma_suppurated'         => 'مفصولين ب فاصلة',
    'meter'                    => 'ساتنيمتر',
    'kg'                       => 'كليو غرام',
    'slug_ar'                  => 'عربي Slug',
    'slug_en'                  => 'انكليزي Slug',
    'photos'                   => 'صور',
    'photo'                    => 'صورة',
    'videos'                   => 'فيديوها',
    'error'                    => 'خطأ',
    'following_error_exits'    => 'الاخطاء التالية موجودة',
    'seo_information'          => 'Seo معلومات',

    'facebook'  => 'Facebook',
    'twitter'   => 'Twitter',
    'instagram' => 'Instagram',
    'linkedin'  => 'Linkedin',
    'github'    => 'Github',

    'website_title'            => 'Website Title',
    'website_logo_dark'        => 'Website Logo Dark',
    'website_logo_light'       => 'Website Logo Light',
    'website_logo_small'       => 'Website Logo Small',
    'website_favicon'          => 'Website Favicon',
    'meta_title'               => 'Meta Title',
    'meta_title_en'            => 'Meta Title (English)',
    'meta_title_ar'            => 'Meta Title (Arabic)',
    'meta_description'         => 'Meta Description',
    'meta_description_en'      => 'Meta Description (English)',
    'meta_description_ar'      => 'Meta Description (Arabic)',
    'meta_keywords'            => 'Meta Keywords',
    'meta_keywords_en'         => 'Meta Keywords (English)',
    'meta_keywords_ar'         => 'Meta Keywords (Arabic)',

    'validation' => [
      'password' => [
        'required' => 'The password field is required!',
        'same'     => 'The password and confirm-password must match.',
        'min'      => 'Password length must be greater than 5.',
      ],
      'name_ar' => [
        'required' => 'The arabic name field is required!',
        'unique'   => 'Arabic Name already exists!',
      ],
      'name_en' => [
        'required' => 'The english name field is required!',
        'unique'   => 'English Name already exists!',
      ],
      'nid' => [
        'required' => 'The NID field is required!',
        'unique'   => 'NID already exists!',
      ],
      'code' => [
        'required' => 'The code field is required!',
        'unique'   => 'Code already exists!',
      ],
      'slug' => [
        'required' => 'The slug field is required!',
        'unique'   => 'Slug already exists!',
      ],
      'symbol' => [
        'required' => 'The symbol field is required!',
        'unique'   => 'Symbol already exists!',
      ],
      'meta_title' => [
        'required' => 'The meta title field is required!',
      ],
      'description' => [
        'required' => 'The description field is required!',
      ],
      'meta_description' => [
        'required' => 'The meta description field is required!',
      ],
      'meta_keywords' => [
        'required' => 'The meta keywords field is required!',
      ],
      'category' => [
        'required' => 'The category field is required!',
      ],
      'status' => [
        'required' => 'The status field is required!',
      ],
      'permission' => [
        'required' => 'The permission field is required!',
      ],
      'email' => [
        'required' => 'The email field is required!',
        'email'    => 'Please your email format!',
        'unique'   => 'Email already exists!',
      ],
      'roles' => [
        'required' => 'The roles field is required!',
      ],
      'mobile' => [
        'required' => 'The mobile field is required!',
      ],
      'district' => [
        'required' => 'The district field is required!',
      ],
      'sub_district' => [
        'required' => 'The sub_district field is required!',
      ],
      'address' => [
        'required' => 'The address field is required!',
      ],
      'image' => [
        'required' => 'The image field is required!',
        'image'    => 'The uploaded file must be an image!',
        'mimes'    => 'Only jpeg,png,jpg formats are supported!',
        'max'      => 'File size must not be more than 10M!',
      ],
    ],
  ],

  'gender'=> [
    'stallion'  => 'فحل',
    'gelding'   => 'خصي',
    'mare'      => 'فرس',
    'no_gender' => 'لا يوجد جنس',
  ],

  'general' => [
    'success'                                => 'نجح',
    'no_image'                               => 'ليس هناك صورة',
    'author_ar'                              => 'الناشر',
    'category_ar'                            => 'النوع',
    'no_english_translation'                 => 'ليس هناك ترجمة انكليزية',
    'no_arabic_translation'                  => 'ليس هناك ترجمة عربية',
    'no_english_description'                 => 'ليس هناك تفاصيل انكليزية',
    'no_arabic_description'                  => 'ليس هناك تفاصيل عربية',
    'unauthorized_redirecting'               => 'Unauthorized, redirected to home',
    'phone_already_verified'                 => 'تم بالفعل التحقق من رقم الهاتف',
    'phone_number_changed'                   => 'رقم الهاتف قد تم تغييره و رمز التحقق قد تم ارساله إلى هاتفك',
    'phone_number_changed_with_phone_number' => 'Phone Number has been changed to ":new_phone_number" and an otp has been sent to your phone',
    'password_updated'                       => 'Your password has been updated successfully. You can login to you account now.',
    'view_details'                           => 'رؤية التفاصيل',
    'no_preview_images'                      => 'لا يوجد صور',
  ],
  'errors' => [
    'phone_number_is_not_verified'     => 'لم يتم التحقق من رقم الهاتف. تم ارسال رمز التحقق إلى هاتفك',
    'your_otp_has_been_expired'        => 'الـ OTP الخاص بك قد انتهت صلاحيتها',
    'phone_number_is_already_verified' => 'رقم الهاتف المحمول مؤكد بالفعل',
    'your_otp_is_not_correct'          => 'الـ OTP التي ادخلتها غير صحيحة',
    'Customer_not_found'               => 'العميل ليس موجود',
  ],
];
