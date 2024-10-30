<x-app-layout xmlns:livewire="http://www.w3.org/1999/html">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">Заказ</h3>
                        <div class="ms-auto">
                            {{\Diglactic\Breadcrumbs\Breadcrumbs::render('order_complete')}}
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start shop cart-->
            <section class="py-4">
                <div class="container">
                    <div class="card py-3 mt-sm-3">
                        <div class="card-body text-center">
                            <h2 class="h4 pb-3">Спасибо за ваш заказ!</h2>
                            <p class="fs-sm mb-2">Ваш заказ размещен и будет обработан в ближайшее время.</p>
                            {{--<p class="fs-sm mb-2">Make sure you make note of your order number, which is <span class="fw-medium">34VB5540K83.</span>
                            </p>
                            <p class="fs-sm">You will be receiving an email shortly with confirmation of your order. <u>You can now:</u>--}}
                            </p>
                            <a wire:navigate class="btn btn-light rounded-0 mt-3 me-3" href="{{route('main')}}">Вернуться к покупкам</a>
                        </div>
                    </div>
                </div>
            </section>
            <!--end shop cart-->
        </div>
    </div>
    <!--end page wrapper -->
</x-app-layout>

