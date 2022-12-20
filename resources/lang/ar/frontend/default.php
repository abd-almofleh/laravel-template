<?php

return [

  'form' => [
    'email'                     => 'البريد الإلكتروني',
    'name'                      => 'الأسم',
    'phone_number'              => 'الهاتف المحمول',
    'password'                  => 'كلمة السر',
    'new_password'              => 'كلمة السر الجديدة',
    'update'                    => 'تعديل',
    'update_password'           => 'تعديل كلمة السر',
    'new_password_confirmation' => 'تأكيد كلمة السر الجديدة',
    'password_confirmation'     => 'تأكيد كلمة السر',
    'delete_account'            => 'حذف الحساب',
    'birth_date'                => 'تاريخ الميلاد',
    'birth_year'                => 'عام الميلاد',
    'height'                    => 'الطول',
    'min'                       => 'الأقل',
    'max'                       => 'الأكثر',
    'search'                    => 'البحث',
    'otp'                       => 'كلمة السر لمرة واحدة',

    'messages' => [
      'update' => [
        'success' => 'تم التحديث بنجاح',
      ],
      'delete' => [
        'success' => 'تم الحذف بنجاح',
        'failed'  => 'فشل الحذف',
      ],
      'phone_number' => [
        'verified' => 'تم تأكيد رقم الهاتف المحمول بنجاح',
        'sent'     => 'تم إرسال كلمة السر الؤقتة إلى الهاتفك ({0})',
      ],
      'reset_password' => [
        'sent'     => 'تم إرسال كلمة السر الؤقتة إلى الهاتفك (:phone_number)',
        'verified' => 'تم تأكيد رقم الهاتف المحمول بنجاح',
        'no_email' => 'جلستك قد انتهت. الرجاء اعد العملية',
      ],
    ],
  ],

  'general' => [
    'title'                            => 'عنوان الصفحة',
    'login'                            => 'تسجيل الدخول',
    'logout'                           => 'Logout',
    'register'                         => 'سجل معنا',
    'profile_information'              => 'معلومات الحساب',
    'profile_password'                 => 'كلمة سر الحساب',
    'delete_profile'                   => 'حذف الحساب',
    'forgot_your_password'             => 'نسيت كلمة سرك؟',
    'reset_password'                   => 'اعادة تعيين كلمة السر',
    'request_reset_password'           => 'طلب اعادة تعيين كلمة السر',
    'your_information'                 => 'معلوماتك',
    'read_more'                        => 'اقرأ المزيد',
    'all'                              => 'الكل',
    'categories'                       => 'الاصناف',
    'verify_reset_password'            => 'تحقق من ال OTP لتعيين كلمة السر',
    'new_password'                     => 'كلمة السر الجديدة',
    'verify_phone_number'              => 'تحقق من الرقم الهاتف المحمول',
    'verify'                           => 'تحقق',
    'reset'                            => 'إعادة التعيين',
    'change_phone_number'              => 'تغيير كلمة السر',
    'change_phone_number_from'         => 'تغيير كلمة السر من (:current_phone_number)',
    'resend_otp'                       => 'إعادة ارسال الـ OTP',
    'update'                           => 'تحديث',
    'cancel'                           => 'الغاء',
    'recent_blogs'                     => 'أحدث المقالات',
    'unauthorized_redirected'          => 'ليس لديك الصلاحية لدخول هذا الرابط, سيتم اعادة توجيهك الى الصفحة الرئيسية',
  ],

  'layout' => [
    'subscribe'           => 'اشترك',
    'newsletter'          => 'رسائل الأخبار',
    'sign_up_for'         => 'اشترك من اجل',
    'all_rights_reserved' => 'كل الحقوق محفوظة',
    'horses'              => [
      'passport' => 'جواز السفر',
      'type'     => 'النوع',
    ],
  ],

  'pages_titles' => [
    'home'                    => 'الرئيسية',
    'login'                   => 'تسجيل الدخول',
    'profile'                 => 'الحساب',
    'forget_password'         => 'اعادة تعيين كلمة السر',
    'signup'                  => 'انشاء حساب',
    'browse_horses'           => 'تصفح مجموعة خيولنا المعروضة للبيع',
    'blogs'                   => [
      'list' => 'المقالات',
      'show' => 'مقالة',
    ],
    'horses' => [
      'list' => 'الأحصنة',
      'show' => 'معلومات حصان',
    ],
  ],

];
