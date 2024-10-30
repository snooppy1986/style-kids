<x-app-layout xmlns:livewire="http://www.w3.org/1999/html">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">Все категории</h3>
                        <div class="ms-auto">
                            {{\Diglactic\Breadcrumbs\Breadcrumbs::render('all_categories')}}
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start shop categories-->
            <section class="py-4">
                <div class="container">
                    <div class="product-categories">
                        <div class="row row-cols-1 row-cols-lg-4 g-4">
                            @foreach($categories as $category)
                                <x-category-card-item :category="$category"/>
                            @endforeach
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </section>
            <!--end shop categories-->
        </div>
    </div>
    <!--end page wrapper -->
</x-app-layout>
