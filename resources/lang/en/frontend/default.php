<?php

return [

  'form' => [
    'email'                     => 'Email Address',
    'name'                      => 'Name',
    'phone_number'              => 'Phone Number',
    'password'                  => 'Password',
    'new_password'              => 'New Password',
    'update'                    => 'Update',
    'update_password'           => 'Update Password',
    'new_password_confirmation' => 'Confirm New Password',
    'password_confirmation'     => 'Confirm Password',
    'delete_account'            => 'Delete Account',
    'birth_date'                => 'Birth Date',
    'birth_year'                => 'Birth Year',
    'height'                    => 'Height',
    'min'                       => 'Min',
    'max'                       => 'Max',
    'search'                    => 'Search',
    'otp'                       => 'One Time Password',

    'messages' => [
      'update' => [
        'success' => 'Successfully Updated',
      ],
      'delete' => [
        'success' => 'Successfully deleted',
        'failed'  => 'Failed to deleted',
      ],
      'phone_number' => [
        'verified' => 'Phone Number successfully verified',
        'sent'     => 'Otp sent to your phone ({0})',
      ],
      'reset_password' => [
        'sent'     => 'Otp sent to your phone (:phone_number)',
        'verified' => 'Phone Number successfully verified',
        'no_email' => 'Your session has ben expired please reenter the your email',
      ],
    ],
  ],

  'general' => [
    'title'                         => 'Page Title',
    'login'                         => 'Login',
    'logout'                        => 'Logout',
    'register'                      => 'Register with us',
    'profile_information'           => 'Profile Information',
    'profile_password'              => 'Profile Password',
    'delete_profile'                => 'Delete Profile',
    'forgot_your_password'          => 'Forgot your password?',
    'reset_password'                => 'Reset Password',
    'request_reset_password'        => 'Request Reset Password',
    'your_information'              => 'Your information',
    'read_more'                     => 'Read More',
    'all'                           => 'All',
    'verify_reset_password'         => 'Verify Reset password otp',
    'new_password'                  => 'New Password',
    'verify_phone_number'           => 'Verify Phone Number',
    'verify'                        => 'Verify',
    'categories'                    => 'Categories',
    'reset'                         => 'Reset',
    'change_phone_number'           => 'Change Phone Number',
    'change_phone_number_from'      => 'Change Phone Number from (:current_phone_number)',
    'resend_otp'                    => 'Resend OTP!',
    'update'                        => 'Update',
    'cancel'                        => 'Cancel',
    'recent_blogs'                  => 'Recent Blogs',

    'unauthorized_redirected'   => 'You are not authorized to access this route, redirecting to home',
  ],

  'layout' => [
    'subscribe'           => 'Subscribe',
    'newsletter'          => 'newsletter',
    'sign_up_for'         => 'sign up for',
    'all_rights_reserved' => 'All rights reserved',
    'horses'              => [
      'passport' => 'Passport',
      'type'     => 'Type',
    ],
  ],

  'pages_titles' => [
    'home'                    => 'Home',
    'login'                   => 'Login',
    'profile'                 => 'Profile',
    'forget_password'         => 'Reset Your Password',
    'signup'                  => 'Signup',
    'browse_horses'           => 'Browse Our Listed horses collection',
    'blogs'                   => [
      'list' => 'Blogs',
      'show' => 'Blog Article',
    ],
    'horses'            => [
      'list' => 'Horses',
      'show' => 'Horse Details',
    ],
  ],

];
