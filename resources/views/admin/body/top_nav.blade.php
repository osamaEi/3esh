<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
    <!--begin::Menu wrapper-->
    <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
        <!--begin::Menu-->
        <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
            <!--begin:Menu item-->
                <!--begin:Menu link-->
              
                <!--end:Menu link-->
                <!--begin:Menu sub-->
         
            <!--end:Menu item-->

            <!--end:Menu item-->
            <!--begin:Menu item-->
        
            <!--end:Menu item-->
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">

            <div class="select">

                
                


            </div>
            
            </div>


            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">

                <div class="select">
    
                 
                    
                    
    
    
                </div>
                
                </div>
              


                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">

                    <div class="select">


                        <!--begin::Menu item-->
                      
                               
                        </div>


                        <div class="language-switcher">
                            <div class="language-options">
                              <a href="{{ route('lang.switch', 'en') }}" class="language-option {{ Session::get('locale') === 'en' ? 'active' : '' }}">
                                <span class="language-flag">🇺🇸</span>
                                <span class="language-name">English</span>
                              </a>
                              <div class="language-divider"></div>
                              <a href="{{ route('lang.switch', 'ar') }}" class="language-option {{ Session::get('locale') === 'ar' ? 'active' : '' }}">
                                <span class="language-flag">🇦🇪</span>
                                <span class="language-name">العربية</span>
                              </a>
                            </div>
                          </div>
                          
                          <style>
                          .language-switcher {
                            display: flex;
                            justify-content: center;
                            padding: 12px;
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                          }
                          
                          .language-options {
                            display: flex;
                            align-items: center;
                            background: rgba(12, 123, 226, 0.1);
                            backdrop-filter: blur(10px);
                            border-radius: 20px;
                            padding: 8px 16px;
                            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                            border: 1px solid rgba(23, 43, 219, 0.2);
                            transition: all 0.3s ease;
                          }
                          
                          .language-options:hover {
                            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
                            transform: translateY(-2px);
                          }
                          
                          .language-option {
                            display: flex;
                            align-items: center;
                            padding: 10px 16px;
                            color: #333;
                            text-decoration: none;
                            font-weight: 500;
                            transition: all 0.3s ease;
                            border-radius: 14px;
                          }
                          
                          .language-option:hover {
                            background: rgba(40, 102, 218, 0.2);
                          }
                          
                          .language-option.active {
                            background: rgba(43, 109, 185, 0.3);
                            font-weight: 700;
                            color: #000;
                          }
                          
                          .language-flag {
                            font-size: 1.4em;
                            margin-right: 8px;
                          }
                          
                          .language-name {
                            font-size: 14px;
                            letter-spacing: 0.5px;
                          }
                          
                          .language-divider {
                            height: 24px;
                            width: 1px;
                            background: rgba(0, 0, 0, 0.1);
                            margin: 0 8px;
                          }
                          
                          /* Dark mode support */
                          @media (prefers-color-scheme: dark) {
                            .language-options {
                              background: rgba(0, 0, 0, 0.4);
                              border-color: rgba(255, 255, 255, 0.1);
                            }
                            
                            .language-option {
                              color: #eee;
                            }
                            
                            .language-option.active {
                              background: rgba(255, 255, 255, 0.15);
                              color: #fff;
                            }
                            
                            .language-divider {
                              background: rgba(255, 255, 255, 0.2);
                            }
                          }
                          </style>
                        
                        
                        
        
        
                    </div>
                    
                    </div>




 
      
            <!--end:Menu item-->
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
    <!--begin::Navbar-->
    <div class="app-navbar flex-shrink-0">
        <!--begin::Search-->
        <div class="app-navbar-item align-items-stretch ms-1 ms-md-4">
            <!--begin::Search-->
            <div id="kt_header_search" class="header-search d-flex align-items-stretch" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-overflow="false" data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end">
                <!--begin::Search toggle-->
              
                <!--end::Search toggle-->
                <!--begin::Menu-->
              
                <!--end::Menu-->
            </div>
            <!--end::Search-->
        </div>
        <!--end::Search-->
  @include('admin.body.partials.notifcation')
        <!--end::My apps links-->
        
        <!--begin::User menu-->
 @include('admin.body.partials.user_nav')

        <!--end::User menu-->
        <!--begin::Header menu toggle-->
        <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
            <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_header_menu_toggle">
                <i class="ki-duotone ki-element-4 fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <!--end::Header menu toggle-->
        <!--begin::Aside toggle-->
        <!--end::Header menu toggle-->
    </div>
    <!--end::Navbar-->
</div>