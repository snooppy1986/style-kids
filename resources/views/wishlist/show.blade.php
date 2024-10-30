<x-app-layout xmlns:livewire="http://www.w3.org/1999/html">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">{{__('Favourites')}}</h3>
                        <div class="ms-auto">
                            {{\Diglactic\Breadcrumbs\Breadcrumbs::render('wishlist')}}
                            {{--<nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i> Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:;">Wishlist</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                                </ol>
                            </nav>--}}
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <livewire:wishlist.wishlist-grid />
        </div>
    </div>
    <!--end page wrapper -->
</x-app-layout>


